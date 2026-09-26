<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicalGuideline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicalGuidelineController extends Controller
{
    public function index()
    {
        $guidelines = ClinicalGuideline::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.guidelines.index', compact('guidelines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'guideline_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'action_type'    => 'required|string',
        ]);

        $data = [
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'status'      => $request->action_type === 'publish' ? 2 : 1,
            'created_by'  => Auth::id(),
        ];

        if ($request->hasFile('guideline_file')) {
            $data['guideline_file'] = $this->storeFile($request->file('guideline_file'));
        }

        ClinicalGuideline::create($data);

        return redirect()->back()->with('success', 'Clinical guideline saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $guideline = ClinicalGuideline::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'category'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'guideline_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $data = [
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'updated_by'  => Auth::id(),
        ];

        if ($request->hasFile('guideline_file')) {
            $this->deleteFileIfExists($guideline->guideline_file);
            $data['guideline_file'] = $this->storeFile($request->file('guideline_file'));
        }

        $guideline->update($data);

        return redirect()->back()->with('success', 'Clinical guideline updated successfully!');
    }

    public function publishDirect($id)
    {
        $guideline = ClinicalGuideline::findOrFail($id);
        $guideline->update([
            'status'     => 2,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Clinical guideline is now live on the public page!');
    }

    public function destroy($id)
    {
        $guideline = ClinicalGuideline::findOrFail($id);
        $guideline->delete();

        return redirect()->back()->with('success', 'Clinical guideline removed.');
    }

    private function storeFile($file): string
    {
        $filename = 'guideline_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = public_path('uploads/guidelines');

        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file->move($uploadPath, $filename);

        return 'uploads/guidelines/' . $filename;
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
