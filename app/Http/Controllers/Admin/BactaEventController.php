<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BactaEventController extends Controller
{
    public function index()
    {
        $events = BactaEvent::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'venue'       => 'nullable|string|max:255',
            'event_date'  => 'nullable|date',
            'media_file'  => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240', // ম্যাক্স ১০ এমবি ফিল্টার
            'status_gate' => 'required|string|in:live,draft'
        ]);

        $event = new BactaEvent();
        $event->title = $request->title;
        $event->venue = $request->venue;
        $event->event_date = $request->event_date;

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $filename = time() . '_event_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $event->event_banner = 'uploads/events/' . $filename;
        }

        $event->status = ($request->status_gate === 'live') ? 2 : 1;
        $event->created_by = Auth::id();
        $event->save();

        return redirect()->back()->with('success', 'Scientific Event logged successfully with zero-symlink direct public path!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'venue'       => 'nullable|string|max:255',
            'event_date'  => 'nullable|date',
            'media_file'  => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $event = BactaEvent::findOrFail($id);
        $event->title = $request->title;
        $event->venue = $request->venue;
        $event->event_date = $request->event_date;

        if ($request->hasFile('media_file')) {
            if ($event->event_banner && file_exists(public_path($event->event_banner))) {
                @unlink(public_path($event->event_banner));
            }
            
            $file = $request->file('media_file');
            $filename = time() . '_event_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $event->event_banner = 'uploads/events/' . $filename;
        }

        $event->updated_by = Auth::id();
        $event->save();

        return redirect()->back()->with('success', 'Scientific Event log updated successfully!');
    }

    public function destroy($id)
    {
        $event = BactaEvent::findOrFail($id);

        if ($event->event_banner && file_exists(public_path($event->event_banner))) {
            @unlink(public_path($event->event_banner));
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event log and its respective physical files permanently purged from server!');
    }
        
    public function publishDirect($id)
    {
        $event = BactaEvent::findOrFail($id);
        $event->status = 2;
        $event->updated_by = Auth::id();
        $event->save();

        return redirect()->back()->with('success', 'Event status successfully pushed live to public catalog!');
    }

}
