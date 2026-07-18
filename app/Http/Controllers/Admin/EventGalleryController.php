<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventGalleryController extends Controller
{
    public function index()
    {
        $records = EventGallery::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.gallery.index', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|integer|in:1,2,3',
            'media_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,mp4,mov,avi,wmv|max:51200',
            'video_url'   => 'nullable|url',
            'venue'       => 'nullable|string|max:255',
            'event_date'  => 'nullable|date',
            'action_type' => 'required|string'
        ]);

        $hub = new EventGallery();
        $hub->title = $request->title;
        $hub->type = $request->type;
        $hub->venue = $request->venue;
        $hub->event_date = $request->event_date;
        $hub->video_url = $request->video_url;

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            if ($request->type == 3) {
                $path = $file->storeAs('gallery_videos', $filename, 'public');
            } else {
                $path = $file->storeAs('gallery_photos', $filename, 'public');
            }
            $hub->media_file = $path;
        }

        if ($request->action_type === 'publish') {
            $hub->status = 2;
        } else {
            $hub->status = 1;
        }

        $hub->created_by = Auth::id();
        $hub->save();

        return redirect()->back()->with('success', 'Registry asset logged and processed successfully!');
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
        // 🎯 🔒 আপনার মেগা ফিক্স ১: এডিট ফর্মে টাইপ চেঞ্জ ইনপুট সাবমিটের জন্য 'type' ভ্যালিডেশন নোড অ্যাড করা হলো ভাই
        $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|integer|in:1,2,3',
            'media_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,mp4,mov,avi,wmv|max:51200',
            'video_url'  => 'nullable|url',
            'venue'      => 'nullable|string|max:255',
            'event_date' => 'nullable|date'
        ]);

        $hub = EventGallery::findOrFail($id);
        $hub->title = $request->title;
        
        // 🎯 🔒 আপনার মেগা ফিক্স ২: এডিট মোডে 'type' চেঞ্জ করলে ডাটাবেজেও যেন ওটি পারফেক্টলি আপডেট হয় ভাই
        $hub->type = $request->type;
        
        $hub->venue = $request->venue;
        $hub->event_date = $request->event_date;
        $hub->video_url = $request->video_url;

        if ($request->hasFile('media_file')) {
            if ($hub->media_file && Storage::disk('public')->exists($hub->media_file)) {
                Storage::disk('public')->delete($hub->media_file);
            }
            $file = $request->file('media_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            if ($request->type == 3) {
                $path = $file->storeAs('gallery_videos', $filename, 'public');
            } else {
                $path = $file->storeAs('gallery_photos', $filename, 'public');
            }
            $hub->media_file = $path;
        }

        $hub->updated_by = Auth::id();
        $hub->save();

        return redirect()->back()->with('success', 'Central gallery asset updated successfully!');
    }

    public function destroy($id)
    {
        $hub = EventGallery::findOrFail($id);

        if ($hub->media_file && Storage::disk('public')->exists($hub->media_file)) {
            Storage::disk('public')->delete($hub->media_file);
        }

        $hub->delete();

        return redirect()->back()->with('success', 'Asset log and its respective physical files permanently purged!');
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
