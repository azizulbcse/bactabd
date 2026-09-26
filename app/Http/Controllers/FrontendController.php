<?php
namespace App\Http\Controllers;
use App\Models\Hospital;
use App\Models\SurgeryType;
use App\Models\HospitalSurgeryRecord;
use App\Models\CongenitalSurgeryRecord;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ValvularSurgeryRecord;

class FrontendController extends Controller
{
    public function cardiacSurgeryStats()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $surgeryTypes = SurgeryType::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $years = HospitalSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $allRecords = HospitalSurgeryRecord::get()->groupBy(['year', 'hospital_id', 'surgery_type_id']);

        return view('frontend.surgery_stats', compact('hospitals', 'surgeryTypes', 'years', 'allRecords'));
    }

    public function congenitalSurgeryStats()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $years = CongenitalSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $allRecords = CongenitalSurgeryRecord::get()->groupBy(['year', 'hospital_id']);

        return view('frontend.congenital_stats', compact('hospitals', 'years', 'allRecords'));
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

    public function membershipApplyPage()
    {
        $designations = \App\Models\MedicalDesignation::where('status', 1)->orderBy('title')->get();
        return view('frontend.membership_apply', compact('designations'));
    }

    public function membershipApplyStore(Request $request)
    {
        if ($request->filled('bacta_security_verification_field')) {
            return abort(422, 'Spam request detected and blocked.');
        }

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'mobile_no'    => 'required|regex:/^01[3-9]\d{8}$/',
            'bmdc_reg_no'  => 'required|string|max:100',
            'designation'  => 'required|string|max:255',
            'member_type'  => 'required|string|in:Lifetime,Active',
            'message'      => 'nullable|string|max:2000',
        ]);

        \App\Models\MembershipApplication::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'mobile_no'   => $request->mobile_no,
            'bmdc_reg_no' => $request->bmdc_reg_no,
            'designation' => $request->designation,
            'member_type' => $request->member_type,
            'message'     => $request->message,
            'status'      => 1,
        ]);

        return redirect()->back()->with('success', 'Your membership application has been submitted! Our team will review it and contact you soon.');
    }

    public function guidelinesArchive()
    {
        $guidelines = \App\Models\ClinicalGuideline::where('status', 2)
                                                    ->orderBy('id', 'desc')
                                                    ->get();

        return view('frontend.clinical_guidelines', compact('guidelines'));
    }

    public function minutesArchive()
    {
        $minutes = \App\Models\ExecutiveMinute::where('status', 2)
                                              ->orderBy('id', 'desc')
                                              ->get();
        return view('frontend.executive_minutes', compact('minutes'));
    }
        
        /**
     * 👑 ১. সম্পূর্ণ আলাদা ডেডিকেটেড ইভেন্টস ফ্রন্টএন্ড মেথড ভাই
     */
    public function eventsPage()
    {
        $events = \App\Models\BactaEvent::where('status', 2)
                                        ->orderBy('id', 'desc')
                                        ->get();

        return view('frontend.events', compact('events'));
    }

    public function galleryPage()
    {
        $galleries = \App\Models\BactaGallery::where('status', 2)
                                            ->orderBy('id', 'desc')
                                            ->get();

        return view('frontend.gallery', compact('galleries'));
    }

    public function journalsPage()
    {
        $journals = \App\Models\BactaJournal::where('status', 2)
                                            ->orderBy('id', 'desc')
                                            ->get();
        return view('frontend.journals', compact('journals'));
    }
        
    public function valvularSurgeryStats()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $years = ValvularSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $allRecords = ValvularSurgeryRecord::get()->groupBy(['year', 'hospital_id']);

        return view('frontend.valvular_stats', compact('hospitals', 'years', 'allRecords'));
    }

    public function historyOfBacta()
    {
        return view('frontend.history_bacta');
    }
    public function cardiology()
{
    return view('frontend.cardiology');
}
public function educationResearch()
{
    return view('frontend.education_research');
}
    public function ttePage()
    {
        return view('frontend.tte');
    }

    public function toePage()
    {
        return view('frontend.toe');
    }
    
    public function preAnesthesiaPage()
    {
        return view('frontend.pre_anesthesia');
    }

    public function anesthesiaPage()
    {
        return view('frontend.anesthesia');
    }

    public function icuPage()
    {
        return view('frontend.icu');
    }
}
