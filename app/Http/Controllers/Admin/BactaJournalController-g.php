<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaJournal;
use App\Models\JournalArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BactaJournalController extends Controller
{
    public function index()
    {
        $journals = BactaJournal::with(['articles' => function($query) {
                        $query->where('status', 2);
                    }, 'creator'])
                    ->orderBy('id', 'desc')
                    ->get();
                                
        return view('admin.journals.index', compact('journals'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title'        => 'required|string|max:255',
        'author_name'  => 'required|string|max:255',
        'volume_issue' => 'required|string|max:255',
        'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        'journal_file' => 'required|file|mimes:zip|max:40960', 
        'action_type'  => 'required|string'
    ]);

    $journal = new BactaJournal();
    $journal->title = $request->title;
    $journal->author_name = $request->author_name;
    $journal->volume_issue = $request->volume_issue;
    $journal->publishing_date = now()->format('F, Y');
    $journal->journal_file = 'uploads/journals/pending_' . time();

    if ($request->hasFile('cover_image')) {
        $image = $request->file('cover_image');
        $imageName = time() . '_cover_' . rand(100, 999) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/journals/covers'), $imageName);
        $journal->cover_image = 'uploads/journals/covers/' . $imageName;
    }

    $journal->status = ($request->action_type === 'publish') ? 2 : 1;
    $journal->created_by = Auth::id();
    $journal->save(); 

    if ($request->hasFile('journal_file')) {
        $zipFile = $request->file('journal_file');
        $folderName = 'vol_' . $journal->id . '_' . time();
        $destinationPath = public_path('uploads/journals/' . $folderName);
        
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }

        $zip = new \ZipArchive;
        if ($zip->open($zipFile->getRealPath()) === TRUE) {
            
            // ১. জিপ ফাইলটি প্রথমে ফিজিক্যালি সার্ভারে সম্পূর্ণ আনপ্যাক হবে ভাই
            $zip->extractTo($destinationPath);

            // 👑 ২. ম্যাজিক মেগা-লুপ ড্রাইভার: লিনাক্স-উইন্ডোজ নির্বিশেষে জিপের ভেতরের সব রিয়েল ফাইল ট্র্যাক করার গ্যারান্টেড নোড ভাই
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filenameWithSub = $zip->getNameIndex($i);
                
                // শুধুমাত্র জেনুইন পিডিএফ ফাইল এবং কোনো হিডেন সিস্টেম ডিরেক্টরি বাদে ট্র্যাকিং ভাই
                if (strtolower(pathinfo($filenameWithSub, PATHINFO_EXTENSION)) === 'pdf' && !str_contains($filenameWithSub, '__MACOSX')) {
                    
                    $cleanFilenameWithSub = str_replace('\\', '/', $filenameWithSub);
                    $finalDatabasePath = 'uploads/journals/' . $folderName . '/' . ltrim($cleanFilenameWithSub, '/');
                    
                    $cleanTitle = pathinfo($filenameWithSub, PATHINFO_FILENAME);
                    $cleanTitle = str_replace(['_', '-'], ' ', $cleanTitle); 

                    // 👑 ৩. ডাইনামিক কুয়েরি ইনজেকশন: যা মেমোরি ক্যাশ ব্লক না করে প্রতিটা ফাইলের জন্য আলাদা রো আলাদাভাবে গেঁথে দেবে ভাই
                    \Illuminate\Support\Facades\DB::table('journal_articles')->insert([
                        'bacta_journal_id' => $journal->id,
                        'article_title'    => ucwords($cleanTitle), 
                        'author_name'      => $request->author_name, 
                        'pdf_file'         => $finalDatabasePath, 
                        'status'           => 2,
                        'created_at'       => now(),
                        'updated_at'       => now()
                    ]);
                }
            }

            $zip->close();

            $journal->journal_file = 'uploads/journals/' . $folderName;
            $journal->save();
        } else {
            $journal->delete();
            return redirect()->back()->withErrors(['journal_file' => 'Failed to extract ZIP asset archive.']);
        }
    }

    return redirect()->back()->with('success', 'Grand Journal ZIP unpacked successfully! All multi-layer nested articles auto-indexed live on server.');
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
            'journal_file' => 'nullable|file|mimes:pdf|max:20480'
        ]);

        $journal = BactaJournal::findOrFail($id);
        $journal->title = $request->title;
        $journal->author_name = $request->author_name;
        $journal->volume_issue = $request->volume_issue;

        if ($request->hasFile('journal_file')) {
            if ($journal->journal_file && file_exists(public_path($journal->journal_file))) {
                @unlink(public_path($journal->journal_file));
            }
            
            $file = $request->file('journal_file');
            $filename = time() . '_' . rand(100, 999) . '_' . $file->getClientOriginalName();
            
            $file->move(public_path('uploads/journals'), $filename);
            $journal->journal_file = 'uploads/journals/' . $filename;
        }

        $journal->updated_by = Auth::id();
        $journal->save();

        return redirect()->back()->with('success', 'Journal registry log updated successfully!');
    }

    public function destroy($id)
    {
        $journal = BactaJournal::findOrFail($id);

        if (!empty($journal->cover_image) && file_exists(public_path($journal->cover_image))) {
            @unlink(public_path($journal->cover_image));
        }

        if ($journal->journal_file && file_exists(public_path($journal->journal_file))) {
            $dir = public_path($journal->journal_file);
            
            if (is_dir($dir)) {
                $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
                $files = new \RecursiveIteratorIterator($it, \RecursiveDirectoryIterator::CHILD_FIRST);
                foreach($files as $file) {
                    if ($file->isDir()){
                        @rmdir($file->getRealPath());
                    } else {
                        @unlink($file->getRealPath());
                    }
                }
                @rmdir($dir); 
            }
        }

        $journal->delete();

        return redirect()->back()->with('success', 'Journal volume permanently wiped from server!');
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'bacta_journal_id' => 'required|exists:bacta_journals,id',
            'article_title'    => 'required|string|max:255',
            'author_name'      => 'required|string|max:255',
            'pdf_file'         => 'required|file|max:51200', 
        ]);

        $article = new JournalArticle();
        $article->bacta_journal_id = $request->bacta_journal_id;
        $article->article_title    = $request->article_title;
        $article->author_name      = $request->author_name;
        $article->status           = 2; // Default Active/Live

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_article_' . rand(100, 999) . '_' . $file->getClientOriginalName();
            
            $file->move(public_path('uploads/articles'), $filename);
            $article->pdf_file = 'uploads/articles/' . $filename;
        }

        $article->save();

        return redirect()->back()->with('success', 'Scientific research paper/article successfully attached to the master journal volume!');
    }

}
