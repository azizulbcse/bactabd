<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventGalleryController extends Controller
{
    public function index()
    {
        $galleries = EventGallery::with(['creator', 'updater'])
                                ->orderBy('id', 'desc')
                                ->get();
                                
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_type' => 'required|string|in:IMAGE,VIDEO',
            'media_file'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_source_url' => 'nullable|url',
            'venue'         => 'nullable|string|max:255',
            'event_date'    => 'nullable|date',
            'status_gate'   => 'required|string|in:live,draft'
        ]);

        $hub = new EventGallery();
        $hub->title = $request->title;
        $hub->venue = $request->venue;
        $hub->event_date = $request->event_date;

        if ($request->category_type === 'IMAGE') {
            $hub->type = 2;
            $hub->video_url = null;

            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $filename = time() . '_event_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery/photos'), $filename);
                $hub->media_file = 'uploads/gallery/photos/' . $filename;
            }
        } else {
            $hub->type = 3;
            $hub->media_file = null;
            $hub->video_url = $request->media_source_url;
        }

        $hub->status = ($request->status_gate === 'live') ? 2 : 1;
        $hub->created_by = Auth::id();
        $hub->save();

        return redirect()->back()->with('success', 'Registry asset logged and processed successfully with zero-symlink direct public path!');
    }

    public function publishDirect($id)
    {
        $hub = EventGallery::findOrFail($id);
        $hub->status = 2;
        $hub->updated_by = Auth::id();
        $hub->save();

        return redirect()->back()->with('success', 'Asset status successfully updated to live public display!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_type' => 'required|string|in:IMAGE,VIDEO',
            'media_file'    => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media_source_url' => 'nullable|url',
            'venue'         => 'nullable|string|max:255',
            'event_date'    => 'nullable|date'
        ]);

        $hub = EventGallery::findOrFail($id);
        $hub->title = $request->title;
        $hub->venue = $request->venue;
        $hub->event_date = $request->event_date;

        if ($request->category_type === 'IMAGE') {
            $hub->type = 2;
            $hub->video_url = null;

            if ($request->hasFile('media_file')) {
                if ($hub->media_file && file_exists(public_path($hub->media_file))) {
                    @unlink(public_path($hub->media_file));
                }
                
                $file = $request->file('media_file');
                $filename = time() . '_event_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery/photos'), $filename);
                $hub->media_file = 'uploads/gallery/photos/' . $filename;
            }
        } else {
            $hub->type = 3;
            if ($hub->media_file && file_exists(public_path($hub->media_file))) {
                @unlink(public_path($hub->media_file));
            }
            $hub->media_file = null;
            $hub->video_url = $request->media_source_url;
        }

        $hub->updated_by = Auth::id();
        $hub->save();

        return redirect()->back()->with('success', 'Central gallery asset updated successfully!');
    }

    public function destroy($id)
    {
        $hub = EventGallery::findOrFail($id);

        if ($hub->media_file && file_exists(public_path($hub->media_file))) {
            @unlink(public_path($hub->media_file));
        }

        $hub->delete();

        return redirect()->back()->with('success', 'Asset log and its respective physical files permanently purged from storage!');
    }

    public function galleryStream(Request $request)
    {
        $query = EventGallery::where('status', 2);

        if ($request->type === 'photos') {
            $query->where('type', 2);
        } elseif ($request->type === 'videos') {
            $query->where('type', 3);
        }

        return response()->json(
            $query->orderBy('id', 'desc')->paginate(9)
        );
    }
}
