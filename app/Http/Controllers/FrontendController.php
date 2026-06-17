<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function executiveCommittee()
    {
        $executives = CommitteeMember::with(['hospital', 'medicalDesignation', 'bactaDesignation'])
                                      ->where('member_category', 'Executive')
                                      ->where('status', 1)
                                      ->orderBy('sort_order', 'asc')
                                      ->get();

        return view('frontend.executive_committee', compact('executives'));
    }

    public function lifetimeFellows()
    {
        $fellows = CommitteeMember::with(['hospital', 'medicalDesignation', 'bactaDesignation'])
                                    ->where('member_category', 'Lifetime')
                                    ->where('status', 1)
                                    ->orderBy('sort_order', 'asc')
                                    ->get();

        return view('frontend.lifetime_fellows', compact('fellows'));
    }

    public function activeMembers()
    {
        $activeMembers = CommitteeMember::with(['hospital', 'medicalDesignation', 'bactaDesignation'])
                                         ->where('member_category', 'Active')
                                         ->where('status', 1)
                                         ->orderBy('name', 'asc')
                                         ->get();

        return view('frontend.active_members', compact('activeMembers'));
    }

    public function presidentMessage()
    {
        return view('frontend.president_message');
    }

}
