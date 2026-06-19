<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'action_type' => 'required|string' 
        ]);

        $notice = new Notice();
        $notice->title = $request->title;

        if ($request->hasFile('notice_file')) {
            $file = $request->file('notice_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('notices', $filename, 'public'); 
            $notice->notice_file = $path;
        }

        if ($request->action_type === 'publish') {
            $notice->status = 2; 
        } else {
            $notice->status = 1; 
        }

        $notice->created_by = Auth::id();
        $notice->save();

        return redirect()->back()->with('success', 'Notice processed successfully!');
    }

    // 🚀 ৪. ওয়ান-ক্লিক লাইভ পাবলিশ মেথড ইঞ্জিন (আপনার রিকোয়ারমেন্ট অনুযায়ী ভাই)
    public function publishDirect($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->status = 2; // স্ট্যাটাস ১ থেকে বদলে ২ (Live Published) হয়ে গেল ভাই
        $notice->updated_by = Auth::id(); // অডিট লগ ট্র্যাক হলো
        $notice->save();

        return redirect()->back()->with('success', 'Notice has been successfully published live to the frontend portal!');
    }

    // 🚀 ৫. পপআপ মডাল থেকে আসা এডিট ডাটাবেজে সেভ করার মেথড ইঞ্জিন
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $notice = Notice::findOrFail($id);
        $notice->title = $request->title;

        if ($request->hasFile('notice_file')) {
            if ($notice->notice_file && Storage::disk('public')->exists($notice->notice_file)) {
                Storage::disk('public')->delete($notice->notice_file);
            }
            $file = $request->file('notice_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('notices', $filename, 'public');
            $notice->notice_file = $path;
        }

        $notice->updated_by = Auth::id();
        $notice->save();

        return redirect()->back()->with('success', 'Draft announcement updated successfully!');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        if ($notice->notice_file && Storage::disk('public')->exists($notice->notice_file)) {
            Storage::disk('public')->delete($notice->notice_file);
        }

        $notice->delete();

        return redirect()->back()->with('success', 'Notice and official file permanently deleted!');
    }
}
