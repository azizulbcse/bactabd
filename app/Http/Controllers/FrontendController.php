<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function noticeArchive()
    {
        $notices = \App\Models\Notice::where('status', 2)
                                     ->orderBy('id', 'desc')
                                     ->get();
        return view('frontend.notice_archive', compact('notices'));
    }

    public function contactPage()
    {
        return view('frontend.contact');
    }

    public function contactStore(Request $request) 
    {
        if ($request->filled('bacta_security_verification_field')) {
            return abort(422, 'Spam request detected and blocked.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^01[3-9]\d{8}$/',
            'message' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
        ];

        \App\Models\ContactMessage::create($data);

        try {
            \Illuminate\Support\Facades\Mail::to('info@bactabd.org')->send(new \App\Mail\ContactNotificationMail($data));
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('success', 'Your message has been securely saved and transmitted via email dispatch gateway!');
    }

    public function minutesArchive()
    {
        $minutes = \App\Models\ExecutiveMinute::where('status', 2)
                                              ->orderBy('id', 'desc')
                                              ->get();
        return view('frontend.executive_minutes', compact('minutes'));
    }
        
    public function eventsGalleryPage()
    {
        $records = \App\Models\EventGallery::where('status', 2)
                                           ->orderBy('id', 'desc')
                                           ->get();
        return view('frontend.events_gallery', compact('records'));
    }

    public function journalsPage()
    {
        $journals = \App\Models\BactaJournal::where('status', 2)
                                            ->orderBy('id', 'desc')
                                            ->get();
        return view('frontend.journals', compact('journals'));
    }
}
