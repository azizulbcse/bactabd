<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PopupBannerController extends Controller
{
    public function index()
    {
        $popups = PopupBanner::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.popups.index', compact('popups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:2048',
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        PopupBanner::where('is_active', true)->update(['is_active' => false]);

        $file = $request->file('image');
        $filename = 'popup_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = public_path('uploads/popups');

        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file->move($uploadPath, $filename);
        $path = 'uploads/popups/' . $filename;

        PopupBanner::create([
            'title'      => $request->title,
            'link_url'   => $request->link_url,
            'image'      => $path,
            'is_active'  => true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Popup banner uploaded and set as active!');
    }

    public function activate($id)
    {
        $popup = PopupBanner::findOrFail($id);

        PopupBanner::where('is_active', true)->update(['is_active' => false]);

        $popup->update([
            'is_active'  => true,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Popup banner activated!');
    }

    public function deactivate($id)
    {
        $popup = PopupBanner::findOrFail($id);
        $popup->update([
            'is_active'  => false,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Popup banner deactivated.');
    }

    public function destroy($id)
    {
        $popup = PopupBanner::findOrFail($id);
        $popup->delete();

        return redirect()->back()->with('success', 'Popup banner removed.');
    }
}
