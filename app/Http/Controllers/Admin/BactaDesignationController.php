<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaDesignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BactaDesignationController extends Controller
{
    public function index()
    {
        $bactaDesignations = BactaDesignation::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.bacta_designations_index', compact('bactaDesignations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = trim($request->title);
        $lowerTitle = strtolower($title);

        $existingActive = BactaDesignation::whereRaw('LOWER(title) = ?', [$lowerTitle])
                                           ->where('status', 1)
                                           ->first();
                                           
        if ($existingActive) {
            return redirect()->back()->withErrors(['title' => 'This BACTA constitutional designation is already active in the master panel.']);
        }

        $existingDeleted = BactaDesignation::whereRaw('LOWER(title) = ?', [$lowerTitle])
                                            ->where('status', 0)
                                            ->first();
                                            
        if ($existingDeleted) {
            $existingDeleted->update([
                'status' => 1,
                'title' => $title,
                'updated_by' => Auth::id(),
                'deleted_by' => null,
                'deleted_at' => null
            ]);
            return redirect()->back()->with('success', 'The constitutional designation has been successfully restored and re-activated.');
        }

        BactaDesignation::create([
            'title' => $title,
            'status' => 1,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'New BACTA board designation registered successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $designation = BactaDesignation::findOrFail($id);
        $designation->update([
            'title' => trim($request->title),
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Constitutional designation updated successfully.');
    }

    public function destroy($id)
    {
        $designation = BactaDesignation::findOrFail($id);
        $designation->update([
            'status' => 0,
            'deleted_by' => Auth::id(),
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Constitutional designation archived successfully.');
    }
}
