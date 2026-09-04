<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExecutiveMinute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExecutiveMinuteController extends Controller
{
    public function index()
    {
        $minutes = ExecutiveMinute::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.minutes.index', compact('minutes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'minute_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'action_type' => 'required|string' 
        ]);

        $minute = new ExecutiveMinute();
        $minute->title = $request->title;

        if ($request->hasFile('minute_file')) {
            $file = $request->file('minute_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('minutes', $filename, 'public');
            $minute->minute_file = $path;
        }

        if ($request->action_type === 'publish') {
            $minute->status = 2; 
        } else {
            $minute->status = 1; 
        }

        $minute->created_by = Auth::id();
        $minute->save();

        return redirect()->back()->with('success', 'Executive Minute processed successfully!');
    }

    public function publishDirect($id)
    {
        $minute = ExecutiveMinute::findOrFail($id);
        $minute->status = 2;
        $minute->updated_by = Auth::id(); 
        $minute->save();

        return redirect()->back()->with('success', 'Executive Minute has been successfully published live to the member portal!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'minute_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $minute = ExecutiveMinute::findOrFail($id);
        $minute->title = $request->title;

        if ($request->hasFile('minute_file')) {
            if ($minute->minute_file && Storage::disk('public')->exists($minute->minute_file)) {
                Storage::disk('public')->delete($minute->minute_file);
            }
            $file = $request->file('minute_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('minutes', $filename, 'public');
            $minute->minute_file = $path;
        }

        $minute->updated_by = Auth::id();
        $minute->save();

        return redirect()->back()->with('success', 'Executive Minute updated successfully!');
    }

    public function destroy($id)
    {
        $minute = ExecutiveMinute::findOrFail($id);

        if ($minute->minute_file && Storage::disk('public')->exists($minute->minute_file)) {
            Storage::disk('public')->delete($minute->minute_file);
        }

        $minute->delete(); 

        return redirect()->back()->with('success', 'Executive Minute and official file permanently deleted!');
    }
}
