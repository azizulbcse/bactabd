<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BactaJournal;
use Illuminate\Http\Request;

class BactaJournalFrontController extends Controller
{
    public function index()
    {
        $allLiveJournals = BactaJournal::with(['articles' => function($query) {
                                $query->where('status', 2);
                            }])
                            ->where('status', 2)
                            ->orderBy('id', 'desc')
                            ->get();

        $latestJournal = $allLiveJournals->first(); 
        
        $archivedJournals = $allLiveJournals->skip(1); 

        return view('frontend.journals', compact('latestJournal', 'archivedJournals'));
    }
}
