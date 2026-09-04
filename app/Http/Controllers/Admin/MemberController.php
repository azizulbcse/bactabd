<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function adminList()
    {
        $records = User::where('id', '!=', 1)
                       ->where('status', 2)
                       ->orderBy('id', 'desc')
                       ->get();
                       
        return view('admin.members.index', compact('records')); 
    }

    public function pendingList()
    {
        $pendingMembers = User::where('id', '!=', 1)
                            ->where('status', 1)
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return view('admin.members.pending', compact('pendingMembers'));
    }

    public function approve($id)
    {
        if ((int) $id === 1) {
            abort(403, 'সুপার অ্যাডমিন অ্যাকাউন্ট পরিবর্তন করা যাবে না।');
        }

        $user = User::findOrFail($id);

        $user->update([
            'status' => 2,                      
            'approved_by' => Auth::id(),       
            'approved_at' => now(),             
        ]);

        return redirect()->back()->with('success', 'Doctor account approved successfully and tracked.');
    }

    public function ajaxStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8',
            'mobile_no'   => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'member_type' => 'nullable|string|max:50',
            // 🔒 এখন শুধু আসল ছবির ফাইল (jpg/jpeg/png/webp) সর্বোচ্চ 2MB পর্যন্ত অনুমোদিত
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'mobile_no', 'designation', 'member_type']);
        $data['password'] = bcrypt($request->password);
        $data['status'] = 2;
        // এই ফর্মটা শুধু trusted admin-ই ব্যবহার করতে পারেন (route এখন 'admin' middleware দিয়ে গার্ড করা),
        // তাই এখান থেকে যোগ করা staff-কে সরাসরি is_admin = true দেওয়া হচ্ছে — আগের আচরণের সাথে সামঞ্জস্যপূর্ণ।
        $data['is_admin'] = true;

        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $this->storeProfilePic($request->file('profile_pic'));
        }

        $user = User::create($data);

        return response()->json([
            'success' => 'New staff clinical profile indexed and saved successfully!',
            'id'      => $user->id,
        ]);
    }

    public function ajaxUpdate(Request $request, $id)
    {
        if ((int) $id === 1 && (int) Auth::id() !== 1) {
            abort(403, 'সুপার অ্যাডমিন অ্যাকাউন্ট পরিবর্তন করার অনুমতি নেই।');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|min:8',
            'mobile_no'   => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'member_type' => 'nullable|string|max:50',
            // 🔒 আপডেটেও একই ভ্যালিডেশন - না হলে যেকোনো ফাইল আপলোড হয়ে যেতে পারতো
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'mobile_no', 'designation', 'member_type']);
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            // পুরনো ছবি থাকলে প্রথমে সেটা ক্লিনআপ করে নেওয়া হচ্ছে
            $this->deleteProfilePicIfExists($user->profile_pic);

            $data['profile_pic'] = $this->storeProfilePic($request->file('profile_pic'));
        }

        $user->update($data);

        return response()->json(['success' => 'Staff profile changes successfully synchronized live!']);
    }

    public function destroy($id)
    {
        if ((int) $id === 1) {
            abort(403, 'সুপার অ্যাডমিন অ্যাকাউন্ট ডিলিট করা যাবে না।');
        }

        if ((int) $id === (int) Auth::id()) {
            abort(403, 'আপনি নিজের অ্যাকাউন্ট নিজে ডিলিট করতে পারবেন না।');
        }

        $user = User::findOrFail($id);

        if ($user->is_admin && User::where('is_admin', true)->count() <= 1) {
            abort(403, 'শেষ অ্যাডমিন অ্যাকাউন্ট ডিলিট করা যাবে না।');
        }

        $this->deleteProfilePicIfExists($user->profile_pic);

        $user->delete();

        return response()->json(['success' => 'Staff registry asset permanently purged from live storage!']);
    }

    private function storeProfilePic($file): string
    {
        $filename = uniqid('staff_', true) . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('uploads/profile_pics'), $filename);

        return 'uploads/profile_pics/' . $filename;
    }

    private function deleteProfilePicIfExists(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}