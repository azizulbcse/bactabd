<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'notice_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // ১০ মেগাবাইট পর্যন্ত প্রো-সেফটি লক
            'action_type' => 'required|string' 
        ]);

        $notice = new Notice();
        $notice->title = filter_var($request->title, FILTER_SANITIZE_STRING);

        if ($request->hasFile('notice_file')) {
            $file = $request->file('notice_file');
            
            $filename = 'bacta_notice_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/notices');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            
            $notice->notice_file = 'uploads/notices/' . $filename;
        }

        if ($request->action_type === 'publish') {
            $notice->status = 2; 
        } else {
            $notice->status = 1; 
        }

        $notice->created_by = Auth::id();
        $notice->save();

        return redirect()->back()->with('success', 'Official announcement successfully processed and secured in registry block!');
    }

    public function publishDirect($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->status = 2; // Draft (1) থেকে ডাইরেক্ট Live (2) এ কনভার্ট ভাই
        $notice->updated_by = Auth::id();
        $notice->save();

        return redirect()->back()->with('success', 'Notice has been successfully published live to the frontend portal!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'notice_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'
        ]);

        $notice = Notice::findOrFail($id);
        $notice->title = filter_var($request->title, FILTER_SANITIZE_STRING);

        if ($request->hasFile('notice_file')) {
            if ($notice->notice_file && file_exists(public_path($notice->notice_file))) {
                @unlink(public_path($notice->notice_file));
            }

            $file = $request->file('notice_file');
            $filename = 'bacta_notice_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/notices');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $notice->notice_file = 'uploads/notices/' . $filename;
        }

        $notice->updated_by = Auth::id();
        $notice->save();

        return redirect()->back()->with('success', 'Draft announcement updated successfully!');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        if ($notice->notice_file && file_exists(public_path($notice->notice_file))) {
            @unlink(public_path($notice->notice_file));
        }

        $notice->delete();

        return redirect()->back()->with('success', 'Official announcement and corresponding file permanently removed!');
    }
}
