<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalDesignationController extends Controller
{
    public function index()
    {
        $designations = MedicalDesignation::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.medical_designations_index', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = trim($request->title);

        $existingActive = MedicalDesignation::where('title', $title)->where('status', 1)->first();
        if ($existingActive) {
            return redirect()->back()->withErrors(['title' => 'This medical title designation already exists and holds active compliance status.']);
        }

        $existingDeleted = MedicalDesignation::where('title', $title)->where('status', 0)->first();
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'updated_by' => Auth::id()
            ]);
            return redirect()->back()->with('success', 'The requested medical designation has been successfully restored from archives.');
        }

        MedicalDesignation::create([
            'title' => $title,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'New professional medical designation configured successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $designation = MedicalDesignation::findOrFail($id);
        $designation->update([
            'title' => trim($request->title),
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Medical designation title updated successfully.');
    }

    public function destroy($id)
    {
        $designation = MedicalDesignation::findOrFail($id);
        $designation->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Medical designation title archived successfully.');
    }
}
