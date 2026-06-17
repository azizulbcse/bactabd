<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * ১. পেন্ডিং মেম্বারদের তালিকা দেখানো (Status = 1)
     */
    public function pendingList()
    {
        $pendingMembers = User::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.members.pending', compact('pendingMembers'));
    }

    /**
     * ২. মেম্বার এপ্রুভ করার স্মার্ট লজিক (Status = 2 + Tracking)
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'status' => 2,                      
            'approved_by' => Auth::id(),       
            'approved_at' => now(),             
        ]);

        return redirect()->back()->with('success', 'Doctor account approved successfully and tracked.');
    }

    /**
     * ৩. মেম্বার বা স্টাফ চিরতরে ডাটাবেজ থেকে মুছে ফেলা (Permanent Delete)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // ছবি থাকলে সার্ভার স্টোরেজ থেকে চিরতরে আনলিঙ্ক/ডিলিট করার মেকানিজম
        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $user->delete(); 

        return response()->json(['success' => 'Staff profile and image deleted permanently.']);
    }

    /**
     * ৪. সিকিউর অ্যাডমিন ও স্টাফ ডিরেক্টরি পেজ লোড লজিক (DataTables)
     */
    public function adminList()
    {
        $currentUserId = Auth::id();
        $currentUserEmail = Auth::user()->email;

        // লজিক: বর্তমান লগইন করা ইউজার যদি আপনি নিজে হন, তবে ১ নম্বর আইডি সহ অ্যাক্টিভ সব মেম্বার দেখাবে।
        if ($currentUserId === 1 || $currentUserEmail === 'azizulbcse@gmail.com') {
            $admins = User::where('status', 2)
                          ->orderBy('id', 'asc')
                          ->get();
        } else {
            // অন্য কেউ লগইন করলে ১ নম্বর আইডির রো-টি (আপনি) সম্পূর্ণ হাইড হয়ে যাবে
            $admins = User::where('status', 2)
                          ->where('id', '!=', 1)
                          ->where('email', '!=', 'azizulbcse@gmail.com')
                          ->orderBy('id', 'asc')
                          ->get();
        }

        return view('admin.members.admin_list', compact('admins'));
    }

    // =========================================================================
    // 🚀 NEW FIXED AJAX METHODS (আপনার ফাইলে এই ৩টি ফাংশন মিসিং ছিল ভাই)
    // =========================================================================

    /**
     * ৫. AJAX মেথড: নতুন স্টাফ ডাটাবেজে সেভ এবং ছবি আপলোড
     */
    public function ajaxStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'mobile_no' => 'nullable|string',
            'designation' => 'nullable|string',
            'member_type' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'email', 'mobile_no', 'designation', 'member_type']);
        $data['password'] = bcrypt($request->password);
        $data['status'] = 2; // সরাসরি একটিভ স্টাফ হিসেবে সেভ হবে

        // ছবি আপলোড এবং রিয়েল পাথ ট্র্যাকিং লজিক
        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        User::create($data);
        return response()->json(['success' => 'New staff profile created and saved successfully!']);
    }

    /**
     * ৬. AJAX মেথড: এডিট করার জন্য সিঙ্গেল স্টাফের ডাটা পপআপে পাঠানো
     */
    public function ajaxEdit($id)
    {
        // রুট সুপার এডমিন প্রোটেকশন গেট লক
        if ($id == 1 && Auth::id() !== 1 && Auth::user()->email !== 'azizulbcse@gmail.com') {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * ৭. AJAX মেথড: স্টাফের তথ্য আপডেট এবং পুরোনো ছবি আনলিঙ্ক/ডিলিট করা
     */
    public function ajaxUpdate(Request $request, $id)
    {
        // রুট সুপার এডমিন প্রোটেকশন গেট লক
        if ($id == 1 && Auth::id() !== 1 && Auth::user()->email !== 'azizulbcse@gmail.com') {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_no' => 'nullable|string',
            'designation' => 'nullable|string',
            'member_type' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'email', 'mobile_no', 'designation', 'member_type']);

        // পাসওয়ার্ড চেঞ্জ ফিল্ড পূরণ করলে শুধু আপডেট হবে
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // নতুন ছবি দিলে পুরোনো ছবি সার্ভার স্টোরেজ থেকে ডিলিট হয়ে নতুনটি সেভ হবে
        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                Storage::disk('public')->delete($user->profile_pic);
            }
            $data['profile_pic'] = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $user->update($data);
        return response()->json(['success' => 'Staff profile updated and synced successfully!']);
    }
}
