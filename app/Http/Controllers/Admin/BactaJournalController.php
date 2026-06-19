<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BactaJournalController extends Controller
{
    public function index()
    {
        $journals = BactaJournal::with(['creator', 'updater'])->orderBy('id', 'desc')->get();
        return view('admin.journals.index', compact('journals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'author_name'  => 'required|string|max:255',
            'volume_issue' => 'required|string|max:255',
            'journal_file' => 'required|file|mimes:pdf|max:10240',
            'action_type'  => 'required|string'
        ]);

        $journal = new BactaJournal();
        $journal->title = $request->title;
        $journal->author_name = $request->author_name;
        $journal->volume_issue = $request->volume_issue;

        if ($request->hasFile('journal_file')) {
            $file = $request->file('journal_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('journals', $filename, 'public');
            $journal->journal_file = $path;
        }

        if ($request->action_type === 'publish') {
            $journal->status = 2;
        } else {
            $journal->status = 1;
        }

        $journal->created_by = Auth::id();
        $journal->save();

        return redirect()->back()->with('success', 'Medical Journal asset processed successfully!');
    }

    public function publishDirect($id)
    {
        $journal = BactaJournal::findOrFail($id);
        $journal->status = 2;
        $journal->updated_by = Auth::id();
        $journal->save();

        return redirect()->back()->with('success', 'Journal has been successfully published live to the digital catalog!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'author_name'  => 'required|string|max:255',
            'volume_issue' => 'required|string|max:255',
            'journal_file' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $journal = BactaJournal::findOrFail($id);
        $journal->title = $request->title;
        $journal->author_name = $request->author_name;
        $journal->volume_issue = $request->volume_issue;

        if ($request->hasFile('journal_file')) {
            if ($journal->journal_file && Storage::disk('public')->exists($journal->journal_file)) {
                Storage::disk('public')->delete($journal->journal_file);
            }
            $file = $request->file('journal_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('journals', $filename, 'public');
            $journal->journal_file = $path;
        }

        $journal->updated_by = Auth::id();
        $journal->save();

        return redirect()->back()->with('success', 'Journal registry log updated successfully!');
    }

    public function destroy($id)
    {
        $journal = BactaJournal::findOrFail($id);

        if ($journal->journal_file && Storage::disk('public')->exists($journal->journal_file)) {
            Storage::disk('public')->delete($journal->journal_file);
        }

        $journal->delete();

        return redirect()->back()->with('success', 'Journal and its respective PDF file permanently wiped from database!');
    }
}
