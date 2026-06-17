<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\MedicalDesignation;
use App\Models\BactaDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterSetupController extends Controller
{
    // =========================================================================
    // 🚀 NEW: INDEX VIEW METHODS (এই ৩টি ফাংশন কন্ট্রোলারে মিসিং থাকায় এরর আসছিল ভাই)
    // =========================================================================

    /**
     * A1. হসপিটাল মাস্টার ডিরেক্টরি পেজ ভিউ (Active status = 1)
     */
    public function indexHospitals()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.hospitals_index', compact('hospitals'));
    }

    /**
     * B1. মেডিকেল ডেজিগনেশন পেজ ভিউ (Active status = 1)
     */
    public function indexMedicalDesignations()
    {
        $designations = MedicalDesignation::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.medical_designations_index', compact('designations'));
    }

    /**
     * C1. BACTA কমিটির পদবি পেজ ভিউ (Active status = 1)
     */
    public function indexBactaDesignations()
    {
        $bactaDesignations = BactaDesignation::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.bacta_designations_index', compact('bactaDesignations'));
    }

    // =========================================================================
    // ১. DYNAMIC HOSPITAL MANAGEMENT LAYER (AJAX & Auto-Restore Mechanism)
    // =========================================================================

    /**
     * হসপিটাল ডাটা সেভ ও অটো-রিস্টোর লজিক
     */
    public function storeHospital(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
        ]);

        $name = trim($request->name);

        $existingActive = Hospital::where('name', $name)->where('status', 1)->first();
        if ($existingActive) {
            return response()->json([
                'error' => 'This hospital record is already active in the central registry system.'
            ], 422);
        }

        $existingDeleted = Hospital::where('name', $name)->where('status', 0)->first();
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'short_name' => $request->short_name ?? $existingDeleted->short_name,
                'updated_by' => Auth::id()
            ]);
            return response()->json(['success' => 'Previously archived hospital record has been successfully restored and activated.']);
        }

        Hospital::create([
            'name' => $name,
            'short_name' => $request->short_name,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return response()->json(['success' => 'New hospital institution registered successfully into the master matrix.']);
    }

    /**
     * হসপিটাল সফট ডিলিট মেকানিজম
     */
    public function deleteHospital($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return response()->json(['success' => 'Hospital record deactivated and archived successfully.']);
    }

    // =========================================================================
    // ২. MEDICAL DESIGNATION MANAGEMENT LAYER (AJAX & Auto-Restore Mechanism)
    // =========================================================================

    /**
     * মেডিকেল ডেজিগনেশন সেভ ও অটো-রিস্টোর লজিক
     */
    public function storeMedicalDesignation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = trim($request->title);

        $existingActive = MedicalDesignation::where('title', $title)->where('status', 1)->first();
        if ($existingActive) {
            return response()->json([
                'error' => 'This medical title designation already exists and holds active compliance status.'
            ], 422);
        }

        $existingDeleted = MedicalDesignation::where('title', $title)->where('status', 0)->first();
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'updated_by' => Auth::id()
            ]);
            return response()->json(['success' => 'The requested medical designation has been successfully restored from archives.']);
        }

        MedicalDesignation::create([
            'title' => $title,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return response()->json(['success' => 'New professional medical designation configured successfully.']);
    }

    /**
     * মেডিকেল ডেজিগনেশন সফট ডিলিট মেকানিজম
     */
    public function deleteMedicalDesignation($id)
    {
        $designation = MedicalDesignation::findOrFail($id);
        $designation->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return response()->json(['success' => 'Medical designation title archived successfully.']);
    }

    // =========================================================================
    // ৩. BACTA DESIGNATION MANAGEMENT LAYER (AJAX & Auto-Restore Mechanism)
    // =========================================================================

    /**
     * BACTA কমিটির পদবি সেভ ও অটো-রিস্টোর লজিক
     */
    public function storeBactaDesignation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = trim($request->title);

        $existingActive = BactaDesignation::where('title', $title)->where('status', 1)->first();
        if ($existingActive) {
            return response()->json([
                'error' => 'This BACTA constitutional designation is already active in the master panel.'
            ], 422);
        }

        $existingDeleted = BactaDesignation::where('title', $title)->where('status', 0)->first();
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'updated_by' => Auth::id()
            ]);
            return response()->json(['success' => 'The constitutional designation has been successfully restored and re-activated.']);
        }

        BactaDesignation::create([
            'title' => $title,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return response()->json(['success' => 'New BACTA board designation registered successfully.']);
    }

    /**
     * BACTA কমিটির পদবি সফট ডিলিট মেকানিজম
     */
    public function deleteBactaDesignation($id)
    {
        $designation = BactaDesignation::findOrFail($id);
        $designation->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return response()->json(['success' => 'Constitutional designation archived successfully.']);
    }
}
