<?php

namespace App\Http\Controllers;

// 🎯 👑 ক্লাসের বাইরে একদম ফাইলের মাথায় সঠিক মডেল নেমস্পেস লিংক লকড ভাই (পুরো ওয়েবসাইট লাইভ হবে)
use App\Models\Hospital;
use App\Models\SurgeryType;
use App\Models\HospitalSurgeryRecord;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * 👑 বিএসিটিএ অফিশিয়াল: কার্ডিয়াক সার্জারি পাবলিক স্ট্যাটিস্টিকস পোর্টাল ইঞ্জিন ভাই
     */
    public function cardiacSurgeryStats()
    {
        // 🎯 লজিক ১: শুধুমাত্র একটিভ হাসপাতালগুলো নামের ক্রমানুসারে (A to Z) সাজানো হবে ভাই
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        
        // 🎯 🔒 লজিক ২: শুধুমাত্র একটিভ সার্জারি কলামের টাইপগুলো সিরিয়াল অনুযায়ী ফ্রন্টএন্ড গ্রিডে যাবে
        $surgeryTypes = SurgeryType::where('status', 1)->orderBy('sort_order', 'asc')->get();
        
        // ডাটাবেজে এন্ট্রি থাকা সব সালের ইউনিক তালিকা ড্রপডাউনের জন্য
        $years = HospitalSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        // ⚡ রকেট স্পিড অপটিমাইজেশন: ইগার লোডিং (Eager Loading) দিয়ে এক চান্সে সব রেকর্ড মেমরিতে রিড ভাই
        $allRecords = HospitalSurgeryRecord::get()->groupBy(['year', 'hospital_id', 'surgery_type_id']);

        return view('frontend.surgery_stats', compact('hospitals', 'surgeryTypes', 'years', 'allRecords'));
    }

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
