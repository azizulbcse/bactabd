<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.hospitals_index', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
        ]);

        $name = trim($request->name);

        $existingActive = Hospital::where('name', $name)->where('status', 1)->first();
        if ($existingActive) {
            return redirect()->back()->withErrors(['name' => 'This hospital record is already active in the registry system.']);
        }

        $existingDeleted = Hospital::where('name', $name)->where('status', 0)->first();
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'short_name' => $request->short_name ?? $existingDeleted->short_name,
                'updated_by' => Auth::id()
            ]);
            return redirect()->back()->with('success', 'Previously archived hospital record has been successfully restored and activated.');
        }

        // ৩. ফ্রেশ নতুন এন্ট্রি সেভ
        Hospital::create([
            'name' => $name,
            'short_name' => $request->short_name,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'New hospital institution registered successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:50',
        ]);

        $hospital = Hospital::findOrFail($id);
        $hospital->update([
            'name' => trim($request->name),
            'short_name' => $request->short_name,
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Hospital configuration updated successfully.');
    }

    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Hospital record deactivated and archived successfully.');
    }
}
