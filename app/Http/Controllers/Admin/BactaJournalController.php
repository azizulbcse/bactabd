<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BactaJournal;
use App\Models\JournalArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BactaJournalController extends Controller
{
    public function index()
    {
        $journals = BactaJournal::with(['articles', 'creator'])
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
            $journal->cover_image = $this->storeCoverImage($request->file('cover_image'));
        }

        $journal->status = $request->action_type === 'publish' ? 2 : 1;
        $journal->created_by = Auth::id();
        $journal->save();

        $extraction = $this->extractJournalZip($request->file('journal_file'), $journal->id);

        if (! $extraction['success']) {
            $journal->delete();
            return redirect()->back()->withErrors(['journal_file' => $extraction['error']]);
        }

        $journal->journal_file = $extraction['folder'];
        $journal->save();

        $this->createArticlesFromFolder($journal, $extraction['destinationPath'], $extraction['folder'], $request->author_name);

        return redirect()->back()->with('success', 'Grand Journal ZIP and Cover Page uploaded successfully!');
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
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $journal = BactaJournal::findOrFail($id);
        $journal->title = $request->title;
        $journal->author_name = $request->author_name;
        $journal->volume_issue = $request->volume_issue;

        if ($request->hasFile('cover_image')) {
            if ($journal->cover_image && file_exists(public_path($journal->cover_image))) {
                @unlink(public_path($journal->cover_image));
            }
            $journal->cover_image = $this->storeCoverImage($request->file('cover_image'));
        }

        $journal->updated_by = Auth::id();
        $journal->save();

        return redirect()->back()->with('success', 'Journal registry log updated successfully!');
    }

    public function destroy($id)
    {
        $journal = BactaJournal::findOrFail($id);

        $this->cleanupJournalFile($journal->journal_file);

        // 🔧 fix: আগে cover_image কখনো cleanup হতো না, journal ডিলিট হয়ে গেলেও orphaned
        // ছবি ফাইল সার্ভারে চিরকাল পড়ে থাকতো।
        if ($journal->cover_image && file_exists(public_path($journal->cover_image))) {
            @unlink(public_path($journal->cover_image));
        }

        $journal->delete(); // journal_articles টেবিলের ফরেন কি cascadeOnDelete দিয়ে সংযুক্ত, তাই article রেকর্ডও DB-লেভেলে auto মুছে যাবে

        return redirect()->back()->with('success', 'Journal volume and all its extracted PDF assets permanently wiped from server!');
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'bacta_journal_id' => 'required|exists:bacta_journals,id',
            'article_title'    => 'required|string|max:255',
            'author_name'      => 'required|string|max:255',
            'pdf_file'         => 'required|file|mimes:pdf|max:10240',
            'start_page'       => 'nullable|string|max:50',
            'end_page'         => 'nullable|string|max:50',
        ]);

        $article = new JournalArticle();
        $article->bacta_journal_id = $request->bacta_journal_id;
        $article->article_title    = $request->article_title;
        $article->author_name      = $request->author_name;
        $article->start_page       = $request->start_page;
        $article->end_page         = $request->end_page;
        $article->status           = 2;

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            // 🔧 fix: আগে getClientOriginalName() সরাসরি ব্যবহার হতো (unsafe), এখন র‍্যান্ডম নিরাপদ নাম
            $filename = uniqid('article_', true) . '.pdf';
            $file->move(public_path('uploads/articles'), $filename);
            $article->pdf_file = 'uploads/articles/' . $filename;
        }

        $article->save();

        return redirect()->back()->with('success', 'Scientific research paper/article successfully attached to the master journal volume!');
    }

    /**
     * 🆕 একটা নির্দিষ্ট আর্টিকেলের title/author/page range এডিট করার জন্য (ZIP থেকে auto-generated
     * টাইটেল ভুল/অগোছালো এলে ঠিক করার একমাত্র উপায় এটাই - পুরো journal মুছে re-upload করা লাগবে না)
     */
    public function updateArticle(Request $request, $id)
    {
        $request->validate([
            'article_title' => 'required|string|max:255',
            'author_name'   => 'required|string|max:255',
            'start_page'    => 'nullable|string|max:50',
            'end_page'      => 'nullable|string|max:50',
        ]);

        $article = JournalArticle::findOrFail($id);
        $article->article_title = $request->article_title;
        $article->author_name   = $request->author_name;
        $article->start_page    = $request->start_page;
        $article->end_page      = $request->end_page;
        $article->save();

        return redirect()->back()->with('success', 'Article details updated successfully!');
    }

    /**
     * 🆕 একটা নির্দিষ্ট আর্টিকেল শুধু সেটাই মুছে ফেলার জন্য (পুরো journal মোছার দরকার নেই)
     */
    public function destroyArticle($id)
    {
        $article = JournalArticle::findOrFail($id);

        if ($article->pdf_file && file_exists(public_path($article->pdf_file))) {
            @unlink(public_path($article->pdf_file));
        }

        $article->delete();

        return redirect()->back()->with('success', 'Article removed from the journal volume.');
    }

    /**
     * কভার ইমেজটা নিরাপদ, র‍্যান্ডম নাম দিয়ে সেভ করে রিলেটিভ পাথ রিটার্ন করে।
     */
    private function storeCoverImage($image): string
    {
        $imageName = uniqid('cover_', true) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/journals/covers'), $imageName);
        return 'uploads/journals/covers/' . $imageName;
    }

    /**
     * আপলোড হওয়া ZIP ফাইলটা এক্সট্র্যাক্ট করে - সফল/ব্যর্থ দুই ক্ষেত্রেই বিস্তারিত ফলাফল রিটার্ন করে।
     */
    private function extractJournalZip($zipFile, int $journalId): array
    {
        $folderName = 'vol_' . $journalId . '_' . time();
        $destinationPath = public_path('uploads/journals/' . $folderName);

        $zip = new \ZipArchive;
        if ($zip->open($zipFile->getRealPath()) !== true) {
            return ['success' => false, 'error' => 'Failed to extract the journal ZIP file. Please ensure it is a valid compressed archive.'];
        }

        // 🔧 zip bomb / অস্বাভাবিক বড় আর্কাইভ থেকে বাঁচার সিম্পল সেফটি-নেট
        if ($zip->numFiles > 500) {
            $zip->close();
            return ['success' => false, 'error' => 'This ZIP archive contains too many files (max 500 allowed).'];
        }

        $zip->extractTo($destinationPath);
        $zip->close();

        return [
            'success'         => true,
            'folder'          => 'uploads/journals/' . $folderName,
            'destinationPath' => $destinationPath,
        ];
    }

    /**
     * এক্সট্র্যাক্ট হওয়া ফোল্ডারের ভেতরের (সাবফোল্ডার সহ) প্রতিটা বৈধ PDF ফাইলের জন্য একটা করে
     * JournalArticle রেকর্ড তৈরি করে, natural (human-readable) ক্রমে।
     */
    private function createArticlesFromFolder(BactaJournal $journal, string $destinationPath, string $relativeFolder, string $defaultAuthor): void
    {
        $directoryIterator = new \RecursiveDirectoryIterator($destinationPath, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directoryIterator);

        $pdfFiles = [];
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && strtolower($fileInfo->getExtension()) === 'pdf') {
                $pdfFiles[] = $fileInfo->getRealPath();
            }
        }

        // 🔧 fix: filesystem iteration order OS-dependent, তাই natural sort করে
        // ১, ২, ৩ ... ১০ - এই সঠিক human-readable ক্রমে আনা হচ্ছে
        natsort($pdfFiles);

        foreach ($pdfFiles as $fullPath) {
            // 🔧 fix: শুধু extension না, ফাইলের আসল কনটেন্ট PDF কিনা (%PDF ম্যাজিক বাইট) যাচাই
            $handle = fopen($fullPath, 'rb');
            $header = $handle ? fread($handle, 4) : '';
            if ($handle) {
                fclose($handle);
            }
            if ($header !== '%PDF') {
                continue;
            }

            $cleanDestPath = rtrim($destinationPath, DIRECTORY_SEPARATOR);
            $subPathWithFile = ltrim(str_replace($cleanDestPath, '', $fullPath), DIRECTORY_SEPARATOR);
            $relativePath = str_replace('\\', '/', $relativeFolder . '/' . $subPathWithFile);

            $cleanTitle = pathinfo($fullPath, PATHINFO_FILENAME);
            $cleanTitle = str_replace(['_', '-'], ' ', $cleanTitle);

            JournalArticle::create([
                'bacta_journal_id' => $journal->id,
                'article_title'    => ucwords($cleanTitle),
                'author_name'      => $defaultAuthor,
                'pdf_file'         => $relativePath,
                'status'           => 2,
            ]);
        }
    }

    /**
     * journal_file এ যা-ই থাকুক (ফোল্ডার অথবা কখনো একটা প্লেইন ফাইল) - নিরাপদে মুছে ফেলে।
     */
    private function cleanupJournalFile(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $path = public_path($relativePath);

        if (is_dir($path)) {
            File::deleteDirectory($path);
        } elseif (is_file($path)) {
            @unlink($path);
        }
    }
}
