<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MasterSetupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// ১. পাবলিক ফ্রন্টএন্ড এবং কাস্টম স্ট্যাটিক পেজ রাউটস
// ==========================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about-bacta', function () { 
    return view('about'); 
})->name('about');

Route::get('/executive-committee', function () { 
    return "Executive Committee Page Coming Soon"; 
})->name('committee');

Route::get('/members/lifetime-fellows', function () { 
    return "Lifetime Fellows Page Coming Soon"; 
})->name('members.lifetime');

Route::get('/members/active-directory', function () { 
    return "Active Members Directory Coming Soon"; 
})->name('members.active');


// ==========================================
// ২. সেন্ট্রাল গেটওয়ে রাউট (স্মার্ট রোল বেসড রিডাইরেকশন লজিক)
// ==========================================
Route::get('/dashboard', function () {
    if (Auth::user()->status !== 2) {
        $status = Auth::user()->status;
        Auth::logout();
        if ($status == 1) {
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is currently pending approval. Please wait for BACTA Admin team to approve.',
            ]);
        } else {
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been suspended or deleted. Please contact support.',
            ]);
        }
    }

    if (Auth::user()->email === 'admin@bactabd.org' || Auth::id() === 1 || Auth::user()->email === 'azizulbcse@gmail.com') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// ৩. সুপার অ্যাডমিন প্যানেল রাউট গ্রুপ (সর্বোচ্চ সুরক্ষিত জোন)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // অ্যাডমিন ড্যাশবোর্ড কোর হোমপেজ
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // বিএসিটিএ মেম্বারশিপ ওয়ান-ক্লিক এপ্রুভাল ট্র্যাকিং রাউটস
    Route::get('/members/pending', [MemberController::class, 'pendingList'])->name('admin.members.pending');
    Route::post('/members/approve/{id}', [MemberController::class, 'approve'])->name('admin.members.approve');
    Route::delete('/members/delete/{id}', [MemberController::class, 'destroy'])->name('admin.members.delete');

    // অ্যাডমিন ও স্টাফ ডিরেক্টরি এবং ওয়ান-ক্লিক AJAX অপারেশন রাউটস
    Route::get('/staff-directory', [MemberController::class, 'adminList'])->name('admin.staff.list');
    Route::post('/members/ajax-store', [MemberController::class, 'ajaxStore'])->name('admin.members.ajax.store');
    Route::get('/members/ajax-edit/{id}', [MemberController::class, 'ajaxEdit'])->name('admin.members.ajax.edit');
    Route::post('/members/ajax-update/{id}', [MemberController::class, 'ajaxUpdate'])->name('admin.members.ajax.update');

    // =========================================================================
    // 🚀 MASTER CONTROL HUB ROUTES (সাইডবার মেনুর সাথে ১০০% মিল রেখে ফিক্সড)
    // =========================================================================
    
    // A. Hospitals Master Engine (পেজ ভিউ + AJAX সেভ ও ডিলিট)
    Route::get('/hospitals', [MasterSetupController::class, 'indexHospitals'])->name('admin.hospitals.index');
    Route::post('/hospitals/store', [MasterSetupController::class, 'storeHospital'])->name('admin.hospitals.store');
    Route::delete('/hospitals/delete/{id}', [MasterSetupController::class, 'deleteHospital'])->name('admin.hospitals.delete');

    // B. Medical Designations Master Engine (পেজ ভিউ + AJAX সেভ ও ডিলিট)
    Route::get('/medical-designations', [MasterSetupController::class, 'indexMedicalDesignations'])->name('admin.med_desig.index');
    Route::post('/medical-designations/store', [MasterSetupController::class, 'storeMedicalDesignation'])->name('admin.med_desig.store');
    Route::delete('/medical-designations/delete/{id}', [MasterSetupController::class, 'deleteMedicalDesignation'])->name('admin.med_desig.delete');

    // C. BACTA Board Designations Master Engine (পেজ ভিউ + AJAX সেভ ও ডিলিট)
    Route::get('/bacta-designations', [MasterSetupController::class, 'indexBactaDesignations'])->name('admin.bacta_desig.index');
    Route::post('/bacta-designations/store', [MasterSetupController::class, 'storeBactaDesignation'])->name('admin.bacta_desig.store');
    Route::delete('/bacta-designations/delete/{id}', [MasterSetupController::class, 'deleteBactaDesignation'])->name('admin.bacta_desig.delete');
});


// ==========================================
// ৪. গ্লোবাল মেম্বার প্রোফাইল সেটিংস রাউট গ্রুপ
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
