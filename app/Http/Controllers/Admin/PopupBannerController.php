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
            'file'     => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
        ]);

        PopupBanner::where('is_active', true)->update(['is_active' => false]);

        $data = [
            'title'      => $request->title,
            'link_url'   => $request->link_url,
            'image'      => null,
            'pdf_file'   => null,
            'is_active'  => true,
            'created_by' => Auth::id(),
        ];

        $this->assignUploadedFile($data, $request->file('file'));

        PopupBanner::create($data);

        return redirect()->back()->with('success', 'Popup banner uploaded and set as active!');
    }

    public function update(Request $request, $id)
    {
        $popup = PopupBanner::findOrFail($id);

        $request->validate([
            'title'    => 'nullable|string|max:255',
            'link_url' => 'nullable|url|max:2048',
            'file'     => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
        ]);

        $data = [
            'title'      => $request->title,
            'link_url'   => $request->link_url,
            'updated_by' => Auth::id(),
        ];

        if ($request->hasFile('file')) {
            $this->deletePopupFile($popup->image);
            $this->deletePopupFile($popup->pdf_file);
            $data['image'] = null;
            $data['pdf_file'] = null;
            $this->assignUploadedFile($data, $request->file('file'));
        }

        $popup->update($data);

        return redirect()->back()->with('success', 'Popup banner updated successfully!');
    }

    private function assignUploadedFile(array &$data, $file): void
    {
        if (strtolower($file->getClientOriginalExtension()) === 'pdf') {
            $data['pdf_file'] = $this->storePopupFile($file, 'popup_pdf');
        } else {
            $data['image'] = $this->storePopupFile($file, 'popup');
        }
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
