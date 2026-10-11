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
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        PopupBanner::where('is_active', true)->update(['is_active' => false]);

        $path = $this->storePopupFile($request->file('image'), 'popup');

        $data = [
            'title'      => $request->title,
            'link_url'   => $request->link_url,
            'image'      => $path,
            'is_active'  => true,
            'created_by' => Auth::id(),
        ];

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $this->storePopupFile($request->file('pdf_file'), 'popup_pdf');
        }

        PopupBanner::create($data);

        return redirect()->back()->with('success', 'Popup banner uploaded and set as active!');
    }

    public function update(Request $request, $id)
    {
        $popup = PopupBanner::findOrFail($id);

        $request->validate([
            'title'    => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:2048',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'title'      => $request->title,
            'link_url'   => $request->link_url,
            'updated_by' => Auth::id(),
        ];

        if ($request->hasFile('image')) {
            $this->deletePopupFile($popup->image);
            $data['image'] = $this->storePopupFile($request->file('image'), 'popup');
        }

        if ($request->hasFile('pdf_file')) {
            $this->deletePopupFile($popup->pdf_file);
            $data['pdf_file'] = $this->storePopupFile($request->file('pdf_file'), 'popup_pdf');
        }

        $popup->update($data);

        return redirect()->back()->with('success', 'Popup banner updated successfully!');
    }

    private function storePopupFile($file, string $prefix): string
    {
        $filename = $prefix . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $uploadPath = public_path('uploads/popups');

        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file->move($uploadPath, $filename);

        return 'uploads/popups/' . $filename;
    }

    private function deletePopupFile(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
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
