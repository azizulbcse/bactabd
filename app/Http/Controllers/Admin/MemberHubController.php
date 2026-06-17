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

class MemberHubController extends Controller
{
    public function index()
    {
        $members = CommitteeMember::with(['hospital', 'medicalDesignation', 'bactaDesignation'])
                                   ->where('status', 1)
                                   ->orderBy('sort_order', 'asc')
                                   ->get();

        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $medicalDesignations = MedicalDesignation::where('status', 1)->orderBy('title', 'asc')->get();
        $bactaDesignations = BactaDesignation::where('status', 1)->orderBy('title', 'asc')->get();

        return view('admin.members_hub_index', compact('members', 'hospitals', 'medicalDesignations', 'bactaDesignations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'member_category' => 'required|in:Executive,Lifetime,Active',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_designation_id' => 'required|exists:medical_designations,id',
            'bacta_designation_id' => 'required|exists:bacta_designations,id',
            'sort_order' => 'required|integer',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $name = trim($request->name);
        $lowerName = strtolower($name);

        $existingActive = CommitteeMember::whereRaw('LOWER(name) = ?', [$lowerName])
                                         ->where('member_category', $request->member_category)
                                         ->where('status', 1)
                                         ->first();
                                         
        if ($existingActive) {
            return redirect()->back()->withErrors(['name' => 'This doctor is already active under the selected membership category.']);
        }

        $existingDeleted = CommitteeMember::whereRaw('LOWER(name) = ?', [$lowerName])
                                          ->where('member_category', $request->member_category)
                                          ->where('status', 0)
                                          ->first();
                                          
        if ($existingDeleted) {
            $picPath = $existingDeleted->member_pic;
            if ($request->hasFile('member_pic')) {
                $picPath = $request->file('member_pic')->store('committee_pics', 'public');
            }

            $existingDeleted->update([
                'status' => 1,
                'name' => $name,
                'hospital_id' => $request->hospital_id,
                'medical_designation_id' => $request->medical_designation_id,
                'bacta_designation_id' => $request->bacta_designation_id,
                'sort_order' => $request->sort_order,
                'member_pic' => $picPath,
                'updated_by' => Auth::id(),
                'deleted_by' => null,
                'deleted_at' => null
            ]);
            return redirect()->back()->with('success', 'Previously archived member record has been successfully restored and activated.');
        }

        $data = $request->only(['name', 'member_category', 'hospital_id', 'medical_designation_id', 'bacta_designation_id', 'sort_order']);
        $data['status'] = 1;
        $data['created_by'] = Auth::id();

        if ($request->hasFile('member_pic')) {
            $data['member_pic'] = $request->file('member_pic')->store('committee_pics', 'public');
        }

        CommitteeMember::create($data);
        return redirect()->back()->with('success', 'New member profile registered successfully into the central registry.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'member_category' => 'required|in:Executive,Lifetime,Active',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_designation_id' => 'required|exists:medical_designations,id',
            'bacta_designation_id' => 'required|exists:bacta_designations,id',
            'sort_order' => 'required|integer',
            'member_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = CommitteeMember::findOrFail($id);
        $data = $request->only(['name', 'member_category', 'hospital_id', 'medical_designation_id', 'bacta_designation_id', 'sort_order']);
        $data['updated_by'] = Auth::id();

        if ($request->hasFile('member_pic')) {
            if ($member->member_pic && Storage::disk('public')->exists($member->member_pic)) {
                Storage::disk('public')->delete($member->member_pic);
            }
            $data['member_pic'] = $request->file('member_pic')->store('committee_pics', 'public');
        }

        $member->update($data);
        return redirect()->back()->with('success', 'Member configuration updated successfully.');
    }

    public function destroy($id)
    {
        $member = CommitteeMember::findOrFail($id);
        $member->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Member profile archived successfully.');
    }
}
