<?php
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\MedicalDesignationController;
use App\Http\Controllers\Admin\BactaDesignationController;
use App\Http\Controllers\Admin\CommitteeMemberController;
use App\Http\Controllers\Admin\MemberHubController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ExecutiveMinuteController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\EventGalleryController;
use App\Http\Controllers\Admin\BactaJournalController;
use App\Http\Controllers\Admin\HospitalSurgeryController; 
use App\Http\Controllers\Admin\SurgeryTypeController;
use App\Http\Controllers\Admin\CongenitalSurgeryController;
use App\Http\Controllers\Admin\ValvularSurgeryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about-bacta', function () { return view('about'); })->name('about');
Route::get('/executive-committee', [FrontendController::class, 'executiveCommittee'])->name('committee');
Route::get('/members/lifetime-fellows', [FrontendController::class, 'lifetimeFellows'])->name('members.lifetime');
Route::get('/members/active-directory', [FrontendController::class, 'activeMembers'])->name('members.active');
Route::get('/president-message', [FrontendController::class, 'presidentMessage'])->name('president.message');
Route::get('/announcements', [FrontendController::class, 'noticeArchive'])->name('notice.archive');
Route::get('/executive-minutes', [FrontendController::class, 'minutesArchive'])->middleware(['auth'])->name('minutes.list');
Route::get('/events-gallery', [FrontendController::class, 'eventsGalleryPage'])->name('admin.gallery.index');
Route::get('/bacta-journals', [FrontendController::class, 'journalsPage'])->name('journals.archive');
Route::get('/contact-us', [FrontendController::class, 'contactPage'])->name('contact.archive');
Route::post('/contact/store', [FrontendController::class, 'contactStore'])->name('contact.store');
Route::get('/cardiac-surgery-statistics', [FrontendController::class, 'cardiacSurgeryStats'])->name('frontend.surgeries.stats');
Route::get('/congenital-surgery-statistics', [FrontendController::class, 'congenitalSurgeryStats'])->name('frontend.congenital.stats');
Route::get('/valvular-surgery-statistics', [FrontendController::class, 'valvularSurgeryStats'])->name('frontend.valvular.stats');
Route::get('/history-of-bacta', [FrontendController::class, 'historyOfBacta'])->name('frontend.history.bacta');
Route::get('/cardiology', [FrontendController::class, 'cardiology'])->name('frontend.cardiology');

Route::get('/dashboard', function () {
    if (Auth::user()->status !== 2) {
        $status = Auth::user()->status; Auth::logout();
        if ($status == 1) { return redirect()->route('login')->withErrors(['email' => 'Your account is currently pending approval. Please wait for BACTA Admin team to approve.']); } 
        else { return redirect()->route('login')->withErrors(['email' => 'Your account has been suspended or deleted. Please contact support.']); }
    }
    if (Auth::user()->email === 'azizulbcse@gmail.com' || Auth::id() === 1) { return redirect()->route('admin.dashboard'); }
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->group(function () {  
    Route::get('/dashboard', function () {
        $counts = [
            'pending_apps'  => \App\Models\CommitteeMember::where('status', 0)->count(),
            'lifetime_fel'  => \App\Models\CommitteeMember::where('member_category', 'Lifetime')->count(),
            'active_mems'   => \App\Models\CommitteeMember::where('member_category', 'Active')->count(),
            'hospitals'     => \App\Models\Hospital::count(),
            'designations'  => \App\Models\MedicalDesignation::count() + \App\Models\BactaDesignation::count(),
            'notices'       => \App\Models\Notice::where('status', 2)->count(),
            'minutes'       => \App\Models\ExecutiveMinute::count(),
            'journals_mail' => \App\Models\BactaJournal::count() + \App\Models\ContactMessage::count(),
        ];
        return view('admin.dashboard', compact('counts'));
    })->name('admin.dashboard');

    Route::get('/members/pending', [MemberController::class, 'pendingList'])->name('admin.members.pending');
    Route::post('/members/approve/{id}', [MemberController::class, 'approve'])->name('admin.members.approve');
    Route::delete('/members/delete/{id}', [MemberController::class, 'destroy'])->name('admin.members.delete');
    Route::get('/staff-directory', [MemberController::class, 'adminList'])->name('admin.staff.list');
    Route::post('/members/ajax-store', [MemberController::class, 'ajaxStore'])->name('admin.members.ajax.store');
    Route::post('/members/ajax-update/{id}', [MemberController::class, 'ajaxUpdate'])->name('admin.members.ajax.update');
    Route::get('/hospitals', [HospitalController::class, 'index'])->name('admin.hospitals.index');
    Route::post('/hospitals/store', [HospitalController::class, 'store'])->name('admin.hospitals.store');
    Route::post('/hospitals/{id}/update', [HospitalController::class, 'update'])->name('admin.hospitals.update');
    Route::delete('/hospitals/{id}/destroy', [HospitalController::class, 'destroy'])->name('admin.hospitals.delete');
    
    Route::get('/medical-designations', [MedicalDesignationController::class, 'index'])->name('admin.med_desig.index');
    Route::post('/medical-designations/store', [MedicalDesignationController::class, 'store'])->name('admin.med_desig.store');
    Route::post('/medical-designations/{id}/update', [MedicalDesignationController::class, 'update'])->name('admin.med_desig.update');
    Route::delete('/medical-designations/{id}/destroy', [MedicalDesignationController::class, 'destroy'])->name('admin.med_desig.delete');
    
    Route::get('/bacta-designations', [BactaDesignationController::class, 'index'])->name('admin.bacta_desig.index');
    Route::post('/bacta-designations/store', [BactaDesignationController::class, 'store'])->name('admin.bacta_desig.store');
    Route::post('/bacta-designations/{id}/update', [BactaDesignationController::class, 'update'])->name('admin.bacta_desig.update');
    Route::delete('/bacta-designations/{id}/destroy', [BactaDesignationController::class, 'destroy'])->name('admin.bacta_desig.delete');
    
    Route::get('/committee-members', [CommitteeMemberController::class, 'index'])->name('admin.committee.index');
    Route::post('/committee-members/store', [CommitteeMemberController::class, 'store'])->name('admin.committee.store');
    Route::post('/committee-members/{id}/update', [CommitteeMemberController::class, 'update'])->name('admin.committee.update');
    Route::delete('/committee-members/{id}/destroy', [CommitteeMemberController::class, 'destroy'])->name('admin.committee.delete');

    Route::get('/members-hub', [MemberHubController::class, 'index'])->name('admin.members.index');
    Route::post('/members-hub/store', [MemberHubController::class, 'store'])->name('admin.members.store');
    Route::post('/members-hub/{id}/update', [MemberHubController::class, 'update'])->name('admin.members.update');
    Route::delete('/members-hub/{id}/destroy', [MemberHubController::class, 'destroy'])->name('admin.members.delete');
    
    Route::get('/notices', [NoticeController::class, 'index'])->name('admin.notices.index');
    Route::post('/notices/store', [NoticeController::class, 'store'])->name('admin.notices.store');
    Route::post('/notices/update/{id}', [NoticeController::class, 'update'])->name('admin.notices.update');
    Route::delete('/notices/delete/{id}', [NoticeController::class, 'destroy'])->name('admin.notices.delete');
    Route::post('/notices/publish-direct/{id}', [NoticeController::class, 'publishDirect'])->name('admin.notices.publish_direct');

    Route::get('/minutes', [ExecutiveMinuteController::class, 'index'])->name('admin.minutes.index');
    Route::post('/minutes/store', [ExecutiveMinuteController::class, 'store'])->name('admin.minutes.store');
    Route::post('/minutes/update/{id}', [ExecutiveMinuteController::class, 'update'])->name('admin.minutes.update');
    Route::delete('/minutes/delete/{id}', [ExecutiveMinuteController::class, 'destroy'])->name('admin.minutes.delete');
    Route::post('/minutes/publish-direct/{id}', [ExecutiveMinuteController::class, 'publishDirect'])->name('admin.minutes.publish_direct');

    // =========================================================================
    // 👑 🔒 বিএসিটিএ স্পেশাল কোড গেটওয়ে: ৩-মেগা ডাইনামিক সার্জারি ডাটা এন্ট্রি রাউট হাব ভাই
    // =========================================================================
    
    // মডিউল ১: ওরিজিনাল সামগ্রিক কার্ডিয়াক সার্জারি মেমোফাইল রাউট
    Route::prefix('cardiac-surgeries')->name('admin.surgeries.')->group(function () {
        Route::get('/', [HospitalSurgeryController::class, 'index'])->name('index');
        Route::get('/fetch', [HospitalSurgeryController::class, 'fetchMatrix'])->name('fetch');
        Route::post('/store', [HospitalSurgeryController::class, 'storeOrUpdate'])->name('store');
    });

    // মডিউল ২: কাস্টম জন্মগত হৃদরোগ (Congenital - ASD, VSD, TOF, PDA) রাউট হাব ভাই
    Route::prefix('congenital-surgeries')->name('admin.congenital.')->group(function () {
        Route::get('/', [CongenitalSurgeryController::class, 'index'])->name('index');
        Route::get('/fetch', [CongenitalSurgeryController::class, 'fetchMatrix'])->name('fetch');
        Route::post('/store', [CongenitalSurgeryController::class, 'storeOrUpdate'])->name('store');
    });

    // মডিউল ৩: সমাপনী ভাল্বুলার শল্যচিকিৎসা (Valvular - MVR, AVR, DVR) মেগা রাউট হাব ভাই
    Route::prefix('valvular-surgeries')->name('admin.valvular.')->group(function () {
        Route::get('/', [ValvularSurgeryController::class, 'index'])->name('index');
        Route::get('/fetch', [ValvularSurgeryController::class, 'fetchMatrix'])->name('fetch');
        Route::post('/store', [ValvularSurgeryController::class, 'storeOrUpdate'])->name('store');
    });
    // =========================================================================
    // 📸 বিএসিটিএ অফিসিয়াল: গ্যালারি হাব, জার্নালস এবং কন্টাক্ট ইনবক্স ডিরেক্টরি ভাই
    // =========================================================================
    Route::get('/gallery-hub', [EventGalleryController::class, 'index'])->name('admin.gallery.hub_index');
    Route::post('/gallery-hub/store', [EventGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::post('/gallery-hub/update/{id}', [EventGalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery-hub/delete/{id}', [EventGalleryController::class, 'destroy'])->name('admin.gallery.delete');
    Route::post('/gallery-hub/publish-direct/{id}', [EventGalleryController::class, 'publishDirect'])->name('admin.gallery.publish_direct');

    Route::get('/journals', [BactaJournalController::class, 'index'])->name('admin.journals.index');
    Route::post('/journals/store', [BactaJournalController::class, 'store'])->name('admin.journals.store');
    Route::post('/journals/update/{id}', [BactaJournalController::class, 'update'])->name('admin.journals.update');
    Route::delete('/journals/delete/{id}', [BactaJournalController::class, 'destroy'])->name('admin.journals.delete');
    Route::post('/journals/publish-direct/{id}', [BactaJournalController::class, 'publishDirect'])->name('admin.journals.publish_direct');

    Route::get('/contacts', [ContactMessageController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/delete/{id}', [ContactMessageController::class, 'destroy'])->name('admin.contacts.delete');

    // =========================================================================
    // 👑 🔒 ৩-মেগা ডাইনামিক সার্জারি ডাটা এন্ট্রি রাউট হাব (নিখুঁত ব্র্যাকেট ও পাথ ফিক্সড ভাই)
    // =========================================================================
    
    // মডিউল ১: ওরিজিনাল সামগ্রিক কার্ডিয়াক সার্জারি মেমোফাইল রাউট নোড
    Route::get('/cardiac-surgeries', [HospitalSurgeryController::class, 'index'])->name('admin.surgeries.index');
    Route::get('/cardiac-surgeries/fetch-matrix', [HospitalSurgeryController::class, 'fetchMatrix'])->name('admin.surgeries.fetch');
    Route::post('/cardiac-surgeries/bulk-store', [HospitalSurgeryController::class, 'storeOrUpdate'])->name('admin.surgeries.store');

    // মডিউল ২: কাস্টম জন্মগত হৃদরোগ (Congenital) ফিক্সড রাউট গ্রুপ ভাই
    Route::prefix('/congenital-surgeries')->name('admin.congenital.')->group(function () {
        Route::get('/', [CongenitalSurgeryController::class, 'index'])->name('index');
        Route::get('/fetch', [CongenitalSurgeryController::class, 'fetchMatrix'])->name('fetch');
        Route::post('/store', [CongenitalSurgeryController::class, 'storeOrUpdate'])->name('store');
    }); // 🎯 সেফ ক্লোজিং লকিং নোড

    // Mডিউল ৩: সমাপনী ভাল্বুলার শল্যচিকিৎসা (Valvular) মেগা রাউট গ্রুপ ভাই
    Route::prefix('/valvular-surgeries')->name('admin.valvular.')->group(function () {
        Route::get('/', [ValvularSurgeryController::class, 'index'])->name('index');
        Route::get('/fetch', [ValvularSurgeryController::class, 'fetchMatrix'])->name('fetch');
        Route::post('/store', [ValvularSurgeryController::class, 'storeOrUpdate'])->name('store');
    }); // 🎯 সেফ ক্লোজিং লকিং নোড
    
    // মাস্টার সেটিংস কনফিগারেশন রুট গেটওয়ে ভাই
    Route::get('/surgery-types-config', [SurgeryTypeController::class, 'index'])->name('admin.surgery_types.index');
    Route::post('/surgery-types-config/store', [SurgeryTypeController::class, 'store'])->name('admin.surgery_types.store');
    Route::post('/surgery-types-config/update/{id}', [SurgeryTypeController::class, 'update'])->name('admin.surgery_types.update');
    Route::delete('/surgery-types-config/delete/{id}', [SurgeryTypeController::class, 'destroy'])->name('admin.surgery_types.delete');
}); // 🎯 🔒 মেগা মেইন অ্যাডমিন প্রিফিক্স গ্রুপের ওরিজিনাল শেষ ব্র্যাকেট ক্লোজিং এখানে লকড ভাই!

// =========================================================================
// 🔒 লেয়ার ৪: গ্লোবাল মেম্বার প্রোফাইল এডিট এবং সিকিউরড লগ-আউট ড্রাইভার ভাই
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::match(['get', 'post'], '/logout', function () { Auth::logout(); request()->session()->invalidate(); request()->session()->regenerateToken(); return redirect('/'); })->name('logout');
});

require __DIR__.'/auth.php';
