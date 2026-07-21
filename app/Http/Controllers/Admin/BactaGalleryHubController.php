<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BactaGalleryHubController extends Controller
{
    public function index()
    {
        $galleries = BactaGallery::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_type' => 'required|string|in:IMAGE,VIDEO',
            'media_file'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_source_url' => 'nullable|url',
            'status_gate'   => 'required|string|in:live,draft'
        ]);

        $gallery = new BactaGallery();
        $gallery->title = $request->title;
        $gallery->category_type = $request->category_type;

        if ($request->category_type === 'IMAGE') {
            $gallery->video_url = null;
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $filename = time() . '_gallery_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $filename);
                $gallery->media_file = 'uploads/gallery/' . $filename;
            }
        } else {
            $gallery->media_file = null;
            $gallery->video_url = filter_var($request->media_source_url, FILTER_SANITIZE_URL);
        }

        $gallery->status = ($request->status_gate === 'live') ? 2 : 1;
        $gallery->created_by = Auth::id();
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery asset loaded successfully with zero-symlink direct public path!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_type' => 'required|string|in:IMAGE,VIDEO',
            'media_file'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_source_url' => 'nullable|url'
        ]);

        $gallery = BactaGallery::findOrFail($id);
        $gallery->title = $request->title;
        $gallery->category_type = $request->category_type;

        if ($request->category_type === 'IMAGE') {
            $gallery->video_url = null;
            if ($request->hasFile('media_file')) {
                if ($gallery->media_file && file_exists(public_path($gallery->media_file))) {
                    @unlink(public_path($gallery->media_file));
                }
                
                $file = $request->file('media_file');
                $filename = time() . '_gallery_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $filename);
                $gallery->media_file = 'uploads/gallery/' . $filename;
            }
        } else {
            if ($gallery->media_file && file_exists(public_path($gallery->media_file))) {
                @unlink(public_path($gallery->media_file));
            }
            $gallery->media_file = null;
            $gallery->video_url = filter_var($request->media_source_url, FILTER_SANITIZE_URL);
        }

        $gallery->updated_by = Auth::id();
        $gallery->save();

        return redirect()->back()->with('success', 'Central gallery asset updated successfully!');
    }

    public function destroy($id)
    {
        $gallery = BactaGallery::findOrFail($id);

        if ($gallery->media_file && file_exists(public_path($gallery->media_file))) {
            @unlink(public_path($gallery->media_file));
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery asset and its respective physical files permanently purged from storage!');
    }
    
    public function publishDirect($id)
    {
        $gallery = BactaGallery::findOrFail($id);
        $gallery->status = 2;
        $gallery->updated_by = Auth::id();
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery asset successfully pushed live to public portal!');
    }

}
