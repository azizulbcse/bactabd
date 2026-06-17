<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use App\Models\Hospital;
use App\Models\MedicalDesignation;
use App\Models\BactaDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommitteeMemberController extends Controller
{
    /**
     * ১. কমিটি মেম্বার ডিরেক্টরি পেজ ভিউ এবং ড্রপডাউন ডেটা রেন্ডারিং
     */
    public function index()
    {
        // মূল তালিকায় শুধু একটিভ (status = 1) কমিটি ডাক্তারদের দেখাবে
        $committeeMembers = CommitteeMember::with(['hospital', 'medicalDesignation', 'bactaDesignation'])
                                            ->where('status', 1)
                                            ->orderBy('sort_order', 'asc')
                                            ->get();

        // ফর্মের ড্রপডাউনে দেখানোর জন্য ৩টি মাস্টার টেবিল থেকে শুধু একটিভ ডাটা লোড করা হলো
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $medicalDesignations = MedicalDesignation::where('status', 1)->orderBy('title', 'asc')->get();
        $bactaDesignations = BactaDesignation::where('status', 1)->orderBy('title', 'asc')->get();

        return view('admin.committee_members_index', compact('committeeMembers', 'hospitals', 'medicalDesignations', 'bactaDesignations'));
    }

    /**
     * ২. নতুন মেম্বার ডাটা সেভ এবং ছবি আপলোড মেকানিজম
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_designation_id' => 'required|exists:medical_designations,id',
            'bacta_designation_id' => 'required|exists:bacta_designations,id',
            'sort_order' => 'required|integer',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'hospital_id', 'medical_designation_id', 'bacta_designation_id', 'sort_order']);
        $data['status'] = 1;
        $data['created_by'] = Auth::id();

        // প্রোফাইল ছবি আপলোড ট্র্যাকিং লজিক
        if ($request->hasFile('member_pic')) {
            $data['member_pic'] = $request->file('member_pic')->store('committee_pics', 'public');
        }

        CommitteeMember::create($data);

        return redirect()->back()->with('success', 'New executive committee member registered successfully.');
    }
    /**
     * ৩. কমিটি মেম্বার ডাটা আপডেট এবং পুরোনো ছবি রিমুভ লজিক
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_designation_id' => 'required|exists:medical_designations,id',
            'bacta_designation_id' => 'required|exists:bacta_designations,id',
            'sort_order' => 'required|integer',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = CommitteeMember::findOrFail($id);
        $data = $request->only(['name', 'hospital_id', 'medical_designation_id', 'bacta_designation_id', 'sort_order']);
        $data['updated_by'] = Auth::id();

        // নতুন ছবি আপলোড হলে পুরোনো ছবি সার্ভার স্টোরেজ থেকে চিরতরে ডিলিট করার সিকিউর লজিক
        if ($request->hasFile('member_pic')) {
            if ($member->member_pic && Storage::disk('public')->exists($member->member_pic)) {
                Storage::disk('public')->delete($member->member_pic);
            }
            $data['member_pic'] = $request->file('member_pic')->store('committee_pics', 'public');
        }

        $member->update($data);

        return redirect()->back()->with('success', 'Committee member configuration updated successfully.');
    }

    /**
     * ৪. কমিটি মেম্বার সফট ডিলিট মেকানিজম (স্ট্যাটাস ০ লক)
     */
    public function destroy($id)
    {
        $member = CommitteeMember::findOrFail($id);
        
        // স্ট্যাটাস ০ করে মেম্বারকে মেইন লিস্ট থেকে safely আর্কাইভ বা হাইড করা হলো
        $member->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Committee member archived successfully.');
    }
}
