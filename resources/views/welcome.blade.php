@extends('layouts.app')

@section('title', 'Home | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
    /* ===== FLOAT ANIMATION ===== */
    @keyframes floatCard {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    @keyframes floatCardSlow {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-7px); }
        100% { transform: translateY(0px); }
    }
    @keyframes floatCardDelay {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-12px); }
        100% { transform: translateY(0px); }
    }
    .float-card-1 { animation: floatCard 4s ease-in-out infinite; }
    .float-card-2 { animation: floatCardSlow 5s ease-in-out infinite 0.5s; }
    .float-card-3 { animation: floatCard 4.5s ease-in-out infinite 1s; }
    .float-card-4 { animation: floatCardDelay 5.5s ease-in-out infinite 1.5s; }

    /* ===== CARD BORDER FADE GLOW ===== */
    .glow-card {
        position: relative;
        border: 1px solid transparent;
        background-clip: padding-box;
        transition: all 0.5s ease;
    }
    .glow-card::before {
        content: '';
        position: absolute;
        inset: -1px;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, rgba(2,132,199,0.3), rgba(220,38,38,0.2), rgba(2,132,199,0.1));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0.4;
        transition: opacity 0.4s ease;
    }
    .glow-card:hover::before {
        opacity: 1;
        background: linear-gradient(135deg, rgba(2,132,199,0.8), rgba(220,38,38,0.6), rgba(124,58,237,0.5));
    }
    .glow-card:hover {
        box-shadow: 0 20px 60px rgba(2,132,199,0.15), 0 8px 25px rgba(0,0,0,0.08);
    }

    /* ===== BEAUTIFUL PAGE BACKGROUND ===== */
    .bacta-page-bg {
        background-color: #f0f7ff;
        background-image:
            radial-gradient(ellipse at 20% 20%, rgba(186,230,255,0.5) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 10%, rgba(196,255,214,0.4) 0%, transparent 40%),
            radial-gradient(ellipse at 60% 80%, rgba(221,214,254,0.35) 0%, transparent 45%),
            radial-gradient(ellipse at 10% 80%, rgba(186,230,255,0.3) 0%, transparent 40%),
            linear-gradient(160deg, #eaf6ff 0%, #f0fff4 50%, #f5f3ff 100%);
    }

    /* ===== SECTION BACKGROUNDS ===== */
    .section-light {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.8);
    }

    /* ===== PARTNER SECTION ===== */
    .partner-section-bg {
        background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f0fff4 100%);
        border-top: 1px solid rgba(226,232,240,0.8);
        border-bottom: 1px solid rgba(226,232,240,0.8);
    }

    /* ===== HERO SLIDER SMOOTH CROSSFADE ===== */
    .bacta-img-slide {
        transform: scale(1.03);
        transition: opacity 1.5s ease-in-out, transform 6s ease-out;
        will-change: opacity, transform;
    }
    .bacta-img-slide.opacity-100 {
        transform: scale(1);
        z-index: 1;
    }
    .bacta-img-slide.opacity-0 {
        z-index: 0;
    }

    /* ===== MARQUEE ===== */
    .marquee-slider-container:hover .marquee-slider-track { animation-play-state: paused !important; }
    @keyframes marqueeInfiniteLoopTracker {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
    }
</style>

    <header class="relative bg-slate-950 overflow-hidden w-full" style="aspect-ratio: 2 / 1; max-height: 650px;">
        <div id="bacta-image-track" class="absolute inset-0 w-full h-full z-0">
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-100 transition-opacity duration-[1500ms] ease-in-out" style="background-image: url('{{ asset('images/banner1.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-[1500ms] ease-in-out" style="background-image: url('{{ asset('images/banner2.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover opacity-0 transition-opacity duration-[1500ms] ease-in-out" style="background-image: url('{{ asset('images/banner3.jpg') }}'); background-position: center 20%;"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover opacity-0 transition-opacity duration-[1500ms] ease-in-out" style="background-image: url('{{ asset('images/banner4.jpg') }}'); background-position: center 20%;"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-[1500ms] ease-in-out" style="background-image: url('{{ asset('images/banner5.jpg') }}');"></div>
        </div>

        <div class="absolute inset-0 bg-slate-950/30 z-10"></div>

        {{-- Arrow buttons --}}
        <button type="button" onclick="navigateBactaDynamicSlide(-1)"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-black/40 border border-white/20 text-white flex items-center justify-center hover:bg-[#DC2626] hover:border-[#DC2626] transition-all duration-300 focus:outline-none backdrop-blur-sm">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
        <button type="button" onclick="navigateBactaDynamicSlide(1)"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-10 h-10 rounded-full bg-black/40 border border-white/20 text-white flex items-center justify-center hover:bg-[#DC2626] hover:border-[#DC2626] transition-all duration-300 focus:outline-none backdrop-blur-sm">
            <i class="fas fa-chevron-right text-sm"></i>
        </button>

        {{-- Dot navigation - bottom center --}}
<div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2">
    <button onclick="changeBactaDynamicSlide(0)" class="bacta-dot w-8 h-2 rounded-full bg-[#DC2626] transition-all duration-300"></button>

    <button onclick="changeBactaDynamicSlide(1)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300"></button>

    <button onclick="changeBactaDynamicSlide(2)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300"></button>

    <button onclick="changeBactaDynamicSlide(3)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300"></button>

    <button onclick="changeBactaDynamicSlide(4)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300"></button>
</div>

        {{-- President Card - bottom right overlay (desktop) --}}
        <!--<div class="absolute bottom-6 right-6 lg:right-10 z-30 w-64 hidden sm:block">
            <div class="bg-[#0F172A]/75 backdrop-blur-xl rounded-2xl border border-slate-700/60 p-3.5 shadow-2xl relative overflow-hidden group hover:bg-[#0F172A]/90 transition-all duration-300">
                <div class="absolute -top-8 -right-8 w-24 h-24 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex items-center justify-between mb-2.5 pb-2.5 border-b border-slate-800/80">
                    <span class="text-[9px] font-black tracking-[0.15em] text-[#DC2626] uppercase">President's Desk</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#DC2626] animate-pulse flex-shrink-0"></span>
                </div>
                <a href="{{ route('president.message') }}" class="flex items-center gap-2.5 no-underline group/link">
                    <div class="w-11 h-11 rounded-lg border border-slate-700 overflow-hidden flex-shrink-0 shadow-md">
                        <img src="{{ asset('storage/committee_pics/president.jpg') }}"
                             alt="Prof. A. T. M. Khalilur Rahman"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\' fill=\'%231e293b\'/>';">
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xs font-bold text-white leading-snug truncate group-hover/link:text-[#0284C7] transition-colors">Prof. A. T. M. Khalilur Rahman</h3>
                        <p class="text-[9px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">President, BACTA</p>
                    </div>
                </a>
            </div>
        </div>-->

        {{-- Mobile: small badge bottom-left --}}
        <div class="absolute bottom-14 left-4 z-30 sm:hidden">
            <div class="flex items-center gap-2 bg-[#0F172A]/90 backdrop-blur-md rounded-xl px-3 py-2 border border-slate-700/60 shadow-lg">
                <div class="w-8 h-8 rounded-lg border border-slate-700 overflow-hidden flex-shrink-0">
                    <img src="{{ asset('storage/committee_pics/president.jpg') }}" alt="President" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-[9px] font-black text-[#DC2626] uppercase tracking-wider">President's Message</p>
                    <p class="text-[9px] text-slate-300 font-medium">Prof. A. T. M. Khalilur Rahman</p>
                </div>
            </div>
        </div>

    </header>


<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 relative z-30 font-sans">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#0284C7] to-[#0369A1] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">01</div>
                <i class="fa-solid fa-file-medical text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#0284C7] transition-colors">Clinical Guidelines</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Download official perioperative protocols, echo standards, and medical PDFs.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('frontend.gallery.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] no-underline hover:underline">Browse Library &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#0284C7] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#00ADB5] to-[#0F8B8D] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">02</div>
                <i class="fa-solid fa-user-doctor text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#00ADB5] transition-colors">Membership Portal</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Join the national elite network of thoracic and cardiac anesthesia veterans.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('contact.archive') }}" class="inline-flex items-center text-xs font-bold text-[#00ADB5] no-underline hover:underline">Contact for Membership &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#00ADB5] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#0EA5E9] to-[#0369A1] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">03</div>
                <i class="fa-solid fa-calendar-check text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#0284C7] transition-colors">CME & Events</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Access upcoming advanced workshops, scientific webinars, and annual congress.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('frontend.events.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] no-underline hover:underline">View Calendar &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#0284C7] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#3B7DC4] to-[#1A4B84] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">04</div>
                <i class="fa-solid fa-book-journal-whills text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#1A4B84] transition-colors">BJCTA Journals</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Explore groundbreaking research, academic articles, and global case studies.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('frontend.journals.index') }}" class="inline-flex items-center text-xs font-bold text-[#1A4B84] no-underline hover:underline">Read Research &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#1A4B84] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="w-full bg-gradient-to-r from-slate-50 via-white to-slate-50 border-y border-slate-200 py-10 mt-16 overflow-hidden font-sans">

    <!-- Heading -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <h4 class="text-center font-bold text-sm md:text-base uppercase tracking-[0.30em] text-emerald-600">
            With Thanks To Our Annual Partners
        </h4>
    </div>

    <!-- Slider -->
    <div class="marquee-slider-container relative overflow-hidden">

        <!-- Left Fade -->
        <div class="absolute left-0 top-0 w-24 h-full bg-gradient-to-r from-white via-white/90 to-transparent z-10 pointer-events-none"></div>

        <!-- Right Fade -->
        <div class="absolute right-0 top-0 w-24 h-full bg-gradient-to-l from-white via-white/90 to-transparent z-10 pointer-events-none"></div>

        <div class="marquee-slider-track">

            <!-- First Set -->

            <div class="partner-logo ge">GE HealthCare</div>
            <div class="partner-logo philips">PHILIPS</div>
            <div class="partner-logo pfizer">Pfizer</div>
            <div class="partner-logo siemens">SIEMENS</div>
            <div class="partner-logo msd">MSD</div>
            <div class="partner-logo astra">AstraZeneca</div>

            <!-- Duplicate -->

            <div class="partner-logo ge">GE HealthCare</div>
            <div class="partner-logo philips">PHILIPS</div>
            <div class="partner-logo pfizer">Pfizer</div>
            <div class="partner-logo siemens">SIEMENS</div>
            <div class="partner-logo msd">MSD</div>
            <div class="partner-logo astra">AstraZeneca</div>

        </div>

    </div>

</section>

<style>

.marquee-slider-track{
    display:flex;
    align-items:center;
    gap:80px;
    width:max-content;
    animation:marquee 24s linear infinite;
}

.marquee-slider-container:hover .marquee-slider-track{
    animation-play-state:paused;
}

.partner-logo{

    font-size:clamp(22px,2vw,34px);
    font-weight:900;
    letter-spacing:-0.5px;

    cursor:pointer;

    padding:12px 18px;

    border-radius:14px;

    transition:all .35s ease;

    white-space:nowrap;

    text-shadow:
        0 2px 10px rgba(0,0,0,.08);

}

/* Brand Colors */

.ge{
    color:#0F62FE;
}

.philips{
    color:#0070C9;
}

.pfizer{
    color:#1D4ED8;
}

.siemens{
    color:#009999;
}

.msd{
    color:#16A34A;
}

.astra{
    color:#7C3AED;
}

/* Hover */

.partner-logo:hover{

    transform:translateY(-6px) scale(1.08);

    background:white;

    box-shadow:
        0 15px 35px rgba(0,0,0,.12);

    filter:brightness(1.15);

}

/* Infinite Animation */

@keyframes marquee{

    from{
        transform:translateX(0);
    }

    to{
        transform:translateX(-50%);
    }

}

/* Mobile */

@media(max-width:768px){

    .marquee-slider-track{

        gap:45px;

        animation-duration:18s;

    }

    .partner-logo{

        font-size:22px;
        padding:8px 10px;

    }

}

</style>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-8">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">Upcoming Scientific Sessions</h2>
                    <p class="text-xs text-slate-500 mt-1">Global and national medical knowledge sharing timelines</p>
                </div>
                {{-- fix: age eta bhulbhabe admin route (admin.events.index) e point korto, ekhon shothik public route --}}
                <a href="{{ route('frontend.events.index') }}" class="text-xs font-bold text-[#0284C7] no-underline hover:underline">View All Events</a>
            </div>
            
            @php
                // 👑 ফিক্সড টেবিল নোড: ওল্ড গ্যালারি টেবিল বদলে সরাসরি ডেডিকেটেড 'bacta_events' টেবিল থেকে ডেটা ফেচ ভাই
                $liveUpcomingEvents = \DB::table('bacta_events')
                                        ->where('status', 2)
                                        ->orderBy('id', 'desc')
                                        ->take(2)
                                        ->get();
            @endphp

            @forelse($liveUpcomingEvents as $eRow)
                @php
                    $eventCarbonDate = $eRow->event_date ? \Carbon\Carbon::parse($eRow->event_date) : null;
                    $eventDay = $eventCarbonDate ? $eventCarbonDate->format('d') : date('d');
                    $eventMonth = $eventCarbonDate ? $eventCarbonDate->format('M') : date('M');
                    // 🆕 defensive: exact column name na jene o kaj korar jonno kayekta shombhabbo field name try kora hocche
                    $eventFile = $eRow->banner_image ?? $eRow->event_image ?? $eRow->attachment ?? $eRow->poster ?? $eRow->attachment_file ?? $eRow->file ?? null;
                    $eventFileExists = $eventFile && file_exists(public_path($eventFile));
                @endphp
                
                <a href="{{ $eventFileExists ? asset($eventFile) : route('frontend.events.index') }}"
                   @if($eventFileExists) target="_blank" @endif
                   class="flex gap-6 bg-white p-5 rounded-2xl border border-slate-200/50 hover:shadow-md transition-all duration-300 group no-underline">
                    <div class="flex-none w-16 h-20 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center text-center transition-colors group-hover:border-[#0284C7] group-hover:bg-sky-50/20 shadow-sm">
                        <span class="text-[10px] text-slate-400 uppercase font-black tracking-wider">{{ $eventMonth }}</span>
                        <span class="text-2xl font-black text-slate-800 -mt-0.5">{{ $eventDay }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="text-[10px] font-black uppercase tracking-wider text-[#0284C7]">BACTA Official Session</span>
                        <h3 class="text-base font-bold text-slate-900 mt-1 group-hover:text-[#0284C7] transition-colors leading-snug">
                            {{ $eRow->title }}
                        </h3>
                        @if($eRow->venue)
                            <p class="text-xs text-slate-500 mt-2 flex items-start gap-1 font-medium leading-relaxed">
                                <i class="fa-solid fa-location-dot text-[#DC2626] mt-0.5" style="font-size: 11px;"></i>
                                <span>{{ $eRow->venue }}</span>
                            </p>
                        @endif
                        @if($eventFileExists)
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 mt-2"><i class="fa-solid fa-paperclip"></i> View Attachment</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center text-center p-8 bg-slate-50 border border-dashed border-slate-200 rounded-2xl">
                    <i class="fas fa-calendar-times text-slate-300 text-2xl mb-2"></i>
                    <h4 class="text-xs font-bold text-slate-700">No Upcoming Scientific Seminars Scheduled</h4>
                    <p class="text-[11px] text-slate-400 mt-1 max-w-sm">The official calendar for cardiovascular perioperative academic workshops is currently being updated by the board registries.</p>
                </div>
            @endforelse
        </div>

        <div class="space-y-8 overflow-hidden relative">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">Latest Journals</h2>
                    <p class="text-xs text-slate-500 mt-1">Live research database dispatch feed</p>
                </div>
                <div class="flex gap-1.5 mb-0.5">
                    <button type="button" onclick="slideBactaJournalStream(-1)" class="w-6 h-6 rounded-full bg-slate-100 hover:bg-[#0F172A] hover:text-white flex items-center justify-center text-[10px] transition-colors focus:outline-none"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" onclick="slideBactaJournalStream(1)" class="w-6 h-6 rounded-full bg-slate-100 hover:bg-[#0F172A] hover:text-white flex items-center justify-center text-[10px] transition-colors focus:outline-none"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="relative w-full h-[320px] overflow-hidden">
                @php 
                    $liveFeedJournals = \DB::table('bacta_journals')->where('status', 2)->orderBy('id', 'desc')->get(); 
                @endphp
                
                @forelse($liveFeedJournals as $jKey => $jRow)
                    <div class="bacta-journal-slide-card absolute inset-0 w-full flex flex-col justify-between transition-all duration-500 {{ $jKey == 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full pointer-events-none' }}">
                        <a href="{{ route('frontend.journals.index') }}" class="group cursor-pointer no-underline block">
                            {{-- কভার ইমেজ আপলোড করা থাকলে সেটা preview দেখাবে, না থাকলে আগের মতো PDF-icon fallback --}}
                            @if(!empty($jRow->cover_image) && file_exists(public_path($jRow->cover_image)))
                                <div class="aspect-[16/10] bg-[#0F172A] rounded-2xl overflow-hidden border border-slate-800 relative shadow-inner shadow-black/40">
                                    <img src="{{ asset($jRow->cover_image) }}" alt="{{ $jRow->title }} cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-3">
                                        <span class="text-[10px] uppercase text-white/90 tracking-widest font-black block">{{ $jRow->volume_issue }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="aspect-[16/10] bg-[#0F172A] rounded-2xl overflow-hidden border border-slate-800 flex flex-col items-center justify-center p-6 text-center relative shadow-inner shadow-black/40">
                                    <div class="absolute inset-0 opacity-5 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:14px_14px]"></div>
                                    <i class="far fa-file-pdf text-red-500 text-3xl mb-2 animate-bounce"></i>
                                    <span class="text-[10px] uppercase text-slate-400 tracking-widest font-black block">{{ $jRow->volume_issue }}</span>
                                </div>
                            @endif
                            <div class="mt-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider"><i class="fas fa-user-graduate text-[#0284C7] mr-1"></i> {{ $jRow->author_name }}</span>
                                <h4 class="text-sm font-bold text-slate-900 mt-1.5 group-hover:text-[#0284C7] transition-colors leading-snug line-clamp-2">
                                    {{ $jRow->title }}
                                </h4>
                            </div>
                        </a>
                        
                        <div class="flex gap-2 pt-3 border-t border-slate-100 mt-auto">
                            {{-- fix: raw journal_file link kore direct file/folder open korar bodole, /bacta-journals archive page e niye jawa hocche - shekhane already merged-PDF/article-list dutoi shothik bhabe handle kora ache --}}
                            <a href="{{ route('frontend.journals.index') }}" class="flex-1 text-center bg-slate-50 hover:bg-sky-50 text-slate-700 hover:text-[#0284C7] border border-slate-200 py-2 rounded-xl text-xs font-bold no-underline transition-colors"><i class="fas fa-eye mr-1"></i> View</a>
                            <a href="{{ route('frontend.journals.index') }}" class="flex-1 text-center bg-[#0F172A] hover:bg-[#DC2626] text-white py-2 rounded-xl text-xs font-bold no-underline transition-colors shadow-sm"><i class="fas fa-download mr-1"></i> Download</a>
                        </div>
                    </div>
                @empty
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-slate-50 border border-dashed border-slate-200 rounded-2xl">
                        <i class="fas fa-book-medical text-slate-300 text-2xl mb-2"></i>
                        <h4 class="text-xs font-bold text-slate-700">No Active Journals Indexed</h4>
                        <p class="text-[11px] text-slate-400 mt-1 max-w-[200px]">Peer-reviewed scientific repository logs are currently empty.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
    
    <script>
        let currentBactaSlideIdx = 0;
        const imgSlides = document.querySelectorAll('.bacta-img-slide');
        const sliderDots = document.querySelectorAll('.bacta-dot');

        function changeBactaDynamicSlide(slideIndex) {
            if (imgSlides.length === 0) return;
            imgSlides[currentBactaSlideIdx].classList.replace('opacity-100', 'opacity-0');
            sliderDots[currentBactaSlideIdx].classList.replace('w-8', 'w-2.5');
            sliderDots[currentBactaSlideIdx].classList.replace('bg-[#DC2626]', 'bg-white/40');

            currentBactaSlideIdx = slideIndex;

            imgSlides[currentBactaSlideIdx].classList.replace('opacity-0', 'opacity-100');
            sliderDots[currentBactaSlideIdx].classList.replace('w-2.5', 'w-8');
            sliderDots[currentBactaSlideIdx].classList.replace('bg-white/40', 'bg-[#DC2626]');
        }

        function navigateBactaDynamicSlide(directionSteps) {
            if (imgSlides.length === 0) return;
            let nextIdx = currentBactaSlideIdx + directionSteps;
            if (nextIdx >= imgSlides.length) { nextIdx = 0; }
            else if (nextIdx < 0) { nextIdx = imgSlides.length - 1; }
            changeBactaDynamicSlide(nextIdx);
        }

        let currentJournalSlideIdx = 0;
        const journalCardsArray = document.querySelectorAll('.bacta-journal-slide-card');

        function slideBactaJournalStream(directionSteps) {
            if (journalCardsArray.length <= 1) return;

            journalCardsArray[currentJournalSlideIdx].classList.replace('opacity-100', 'opacity-0');
            journalCardsArray[currentJournalSlideIdx].classList.replace('translate-x-0', 'translate-x-full');
            journalCardsArray[currentJournalSlideIdx].classList.add('pointer-events-none');

            currentJournalSlideIdx += directionSteps;
            if (currentJournalSlideIdx >= journalCardsArray.length) { currentJournalSlideIdx = 0; }
            else if (currentJournalSlideIdx < 0) { currentJournalSlideIdx = journalCardsArray.length - 1; }

            journalCardsArray[currentJournalSlideIdx].classList.remove('pointer-events-none');
            journalCardsArray[currentJournalSlideIdx].classList.replace('translate-x-full', 'translate-x-0');
            setTimeout(() => {
                journalCardsArray[currentJournalSlideIdx].classList.replace('opacity-0', 'opacity-100');
            }, 50);
        }

        document.addEventListener("DOMContentLoaded", function() {
            if (imgSlides.length > 0) {
                setInterval(() => {
                    navigateBactaDynamicSlide(1);
                }, 5000);
            }

            if (journalCardsArray.length > 1) {
                setInterval(() => {
                    slideBactaJournalStream(1);
                }, 6000);
            }
        });
    </script>
</div>{{-- .bacta-page-bg --}}

@if($activePopup ?? null)
<div id="bactaHomepagePopupOverlay" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(15,23,42,0.6); align-items:center; justify-content:center; padding:16px;">
    <div style="position:relative; max-width:520px; width:100%;">
        <button type="button" onclick="closeBactaHomepagePopup()" aria-label="Close"
            style="position:absolute; top:-14px; right:-14px; width:34px; height:34px; border-radius:9999px; background:#fff; color:#0F172A; border:none; box-shadow:0 4px 12px rgba(0,0,0,0.25); font-size:16px; font-weight:700; cursor:pointer;">
            &times;
        </button>
        @if($activePopup->link_url)
        <a href="{{ $activePopup->link_url }}" target="_blank" rel="noopener noreferrer">
        @endif
            <img src="{{ asset('storage/' . $activePopup->image) }}" alt="{{ $activePopup->title ?: 'BACTA Announcement' }}"
                style="width:100%; max-height:80vh; object-fit:contain; border-radius:12px; box-shadow:0 20px 50px rgba(0,0,0,0.35); display:block;">
        @if($activePopup->link_url)
        </a>
        @endif
    </div>
</div>
<script>
    (function () {
        var POPUP_KEY = 'bacta_popup_dismissed_{{ $activePopup->id }}';
        document.addEventListener('DOMContentLoaded', function () {
            var alreadyDismissed = false;
            try { alreadyDismissed = sessionStorage.getItem(POPUP_KEY) === '1'; } catch (e) {}

            if (!alreadyDismissed) {
                var overlay = document.getElementById('bactaHomepagePopupOverlay');
                if (overlay) overlay.style.display = 'flex';
            }
        });

        window.closeBactaHomepagePopup = function () {
            var overlay = document.getElementById('bactaHomepagePopupOverlay');
            if (overlay) overlay.style.display = 'none';
            try { sessionStorage.setItem(POPUP_KEY, '1'); } catch (e) {}
        };

        document.addEventListener('DOMContentLoaded', function () {
            var overlay = document.getElementById('bactaHomepagePopupOverlay');
            if (overlay) {
                overlay.addEventListener('click', function (e) {
                    if (e.target === overlay) window.closeBactaHomepagePopup();
                });
            }
        });
    })();
</script>
@endif
@endsection