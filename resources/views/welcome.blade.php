@extends('layouts.app')

@section('title', 'Home | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <header class="relative bg-slate-950 overflow-hidden" style="height:580px;">
        <div id="bacta-image-track" class="absolute inset-0 w-full h-full z-0">
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-100 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner1.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner2.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner3.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner4.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner5.jpg') }}');"></div>
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
        <!--<div class="absolute bottom-10 right-8 lg:right-16 z-30 w-80 hidden sm:block">
            <div class="bg-[#0F172A]/90 backdrop-blur-xl rounded-2xl border border-slate-700/60 p-5 shadow-2xl relative overflow-hidden group hover:border-slate-600 transition-all duration-300">
                <div class="absolute -top-8 -right-8 w-28 h-28 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex items-center justify-between mb-3 pb-3 border-b border-slate-800/80">
                    <span class="text-[10px] font-black tracking-[0.18em] text-[#DC2626] uppercase">From the President's Desk</span>
                    <span class="w-2 h-2 rounded-full bg-[#DC2626] animate-pulse flex-shrink-0"></span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-xl border border-slate-700 overflow-hidden flex-shrink-0 shadow-md">
                        <img src="{{ asset('storage/committee_pics/president.jpg') }}"
                             alt="Prof. A. T. M. Khalilur Rahman"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\' fill=\'%231e293b\'/>';">
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white leading-snug">Prof. A. T. M. Khalilur Rahman</h3>
                        <p class="text-[9px] font-semibold text-[#DC2626] uppercase tracking-wider mt-0.5">Founder Member & President, BACTA</p>
                        <p class="text-slate-500 text-[9px] mt-0.5">NHFH & Research Institute</p>
                    </div>
                </div>
                <div class="mt-3 bg-slate-900/60 rounded-xl p-3 border border-slate-800/60">
                    <p class="text-slate-300 text-[10px] leading-relaxed italic">
                        "Welcome to the official digital portal of BACTA. Our mission remains steadfast in advancing perioperative patient safety, fostering thoracic research, and educating the next generation of anesthesiologists across Bangladesh."
                    </p>
                </div>
            </div>
        </div>-->

        {{-- Mobile: small badge bottom-left --}}
        <!--<div class="absolute bottom-14 left-4 z-30 sm:hidden">
            <div class="flex items-center gap-2 bg-[#0F172A]/90 backdrop-blur-md rounded-xl px-3 py-2 border border-slate-700/60 shadow-lg">
                <div class="w-8 h-8 rounded-lg border border-slate-700 overflow-hidden flex-shrink-0">
                    <img src="{{ asset('storage/committee_pics/president.jpg') }}" alt="President" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-[9px] font-black text-[#DC2626] uppercase tracking-wider">President's Message</p>
                    <p class="text-[9px] text-slate-300 font-medium">Prof. A. T. M. Khalilur Rahman</p>
                </div>
            </div>
        </div>-->

    </header>


<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30 font-sans">
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
                    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] no-underline hover:underline">Browse Library &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#0284C7] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#DC2626] to-[#991B1B] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">02</div>
                <i class="fa-solid fa-user-doctor text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#DC2626] transition-colors">Membership Portal</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Join the national elite network of thoracic and cardiac anesthesia veterans.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-xs font-bold text-[#DC2626] no-underline hover:underline">Register Portal &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#DC2626] group-hover:translate-x-1"></i>
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
                    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] no-underline hover:underline">View Calendar &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#0284C7] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 overflow-hidden hover:-translate-y-2 transition-all duration-500 group flex flex-col cursor-pointer">
            <div class="w-full h-32 overflow-hidden relative bg-gradient-to-br from-[#991B1B] to-[#4C0519] flex items-center justify-center">
                <div class="absolute top-3 left-3 bg-white/20 backdrop-blur-md text-white text-[11px] font-extrabold px-2.5 py-1 rounded-md tracking-wider z-10">04</div>
                <i class="fa-solid fa-book-journal-whills text-white/30 text-5xl transition-transform duration-500 group-hover:scale-110"></i>
            </div>
            <div class="p-5 flex flex-col flex-grow text-left">
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#DC2626] transition-colors">BJCTA Journals</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed flex-grow">Explore groundbreaking research, academic articles, and global case studies.</p>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{ route('journals.archive') }}" class="inline-flex items-center text-xs font-bold text-[#DC2626] no-underline hover:underline">Read Research &rarr;</a>
                    <i class="fa-solid fa-chevron-right text-slate-300 text-xs transition-transform duration-300 group-hover:text-[#DC2626] group-hover:translate-x-1"></i>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =========================================================================
     👑 🔒 বিএসিটিএ মেগা থিম: BSEcho ইন্সপায়ার্ড আন্তর্জাতিক স্ট্যান্ডার্ড মেগা লোগো গ্রিড ভাই (বড় সাইজ)
     ========================================================================= -->
<section class="w-full bg-[#F8FAFC] border-t border-b border-[#E2E8F0] py-16 mt-16 font-sans">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- ১. মেগা হেডিং এবং ব্র্যান্ড নোড জোন ভাই -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-[#16A34A] text-xs font-bold tracking-[0.2em] uppercase border border-emerald-100/60">
                Annual Partners
            </span>
            <h4 class="mt-3 text-sm font-extrabold text-slate-500 uppercase tracking-[0.15em]">
                With thanks to our annual partners
            </h4>
        </div>

        <!-- ২. 🔒 আপনার মেগা রিকোয়ারমেন্ট: লোগোর সাইজ আরও বড় ও স্পষ্ট করে সাজানো ফিক্সড গ্রিড ভাই -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-16 gap-y-12 items-center justify-center max-w-5xl mx-auto mt-6">
            
            <!-- ক) রো ১: ওয়ান-ক্লিক লিঙ্কড মেগা লোগো ক্যাটালগ ভাই (h-16 লকিং ড্রাইভার) -->
            <a href="https://gehealthcare.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105">
                <img src="/images/partners/ge.png" class="max-h-full max-w-full object-contain block" alt="GE">
            </a>
            
            <a href="https://philips.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105">
                <img src="/images/partners/philips.png" class="max-h-full max-w-full object-contain block" alt="Philips">
            </a>
            
            <a href="https://siemens-healthineers.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105">
                <img src="/images/partners/siemens.png" class="max-h-full max-w-full object-contain block" alt="Siemens">
            </a>
            
            <a href="https://mindray.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105">
                <img src="/images/partners/mindray.png" class="max-h-full max-w-full object-contain block" alt="Mindray">
            </a>

            <!-- খ) রো ২: নিচে নিচে নিখুঁত বড় এলাইনমেন্ট ট্র্যাকার নোড ভাই -->
            <a href="https://abbott.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105 lg:col-start-2">
                <img src="/images/partners/abbott.png" class="max-h-full max-w-full object-contain block" alt="Abbott">
            </a>
            
            <a href="https://draeger.com" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center h-10 md:h-16 transition-all duration-300 hover:scale-105">
                <img src="/images/partners/drager.png" class="max-h-full max-w-full object-contain block" alt="Drager">
            </a>
            
        </div> {{-- .grid-end ভাই --}}
        
    </div> {{-- .container-end ভাই --}}
</section>

    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2 space-y-8">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">Upcoming Scientific Sessions</h2>
                    <p class="text-xs text-slate-500 mt-1">Global and national medical knowledge sharing timelines</p>
                </div>
                <a href="{{ route('admin.gallery.index') }}" class="text-xs font-bold text-[#0284C7] no-underline hover:underline">View All Events</a>
            </div>

            @php
                // 💡 আপনার লজিক: ইভেন্ট টেবিল থেকে টাইপ ১ (Scientific Events) এবং পাবলিশড (status = 2) লেটেস্ট ২টি লাইভ ডাটা রিড ভাই
                $liveUpcomingEvents = \DB::table('events_galleries')
                                          ->where('type', 1)
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
                @endphp
                
                <div class="flex gap-6 bg-white p-5 rounded-2xl border border-slate-200/50 hover:shadow-md transition-all duration-300 group">
                    <div class="flex-none w-16 h-20 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center text-center transition-colors group-hover:border-[#0284C7] group-hover:bg-sky-50/20 shadow-sm">
                        <span class="text-[10px] text-slate-400 uppercase font-black tracking-wider">{{ $eventMonth }}</span>
                        <span class="text-2xl font-black text-slate-800 -mt-0.5">{{ $eventDay }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-wider text-[#0284C7]">BACTA Official Session</span>
                        <h3 class="text-base font-bold text-slate-900 mt-1 hover:text-[#0284C7] cursor-pointer transition-colors leading-snug">
                            {{ $eRow->title }}
                        </h3>
                        @if($eRow->venue)
                            <p class="text-xs text-slate-500 mt-2 flex items-start gap-1 font-medium leading-relaxed">
                                <i class="fa-solid fa-location-dot text-[#DC2626] mt-0.5" style="font-size: 11px;"></i>
                                <span>{{ $eRow->venue }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                {{-- 💡 ইভেন্ট টেবিল খালি থাকলে চিকিৎসকদের জন্য প্রফেশনাল ফলব্যাক উইজেট ভাই --}}
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
                        <div class="group cursor-pointer">
                            <div class="aspect-[16/10] bg-[#0F172A] rounded-2xl overflow-hidden border border-slate-800 flex flex-col items-center justify-center p-6 text-center relative shadow-inner shadow-black/40">
                                <div class="absolute inset-0 opacity-5 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:14px_14px]"></div>
                                <i class="far fa-file-pdf text-red-500 text-3xl mb-2 animate-bounce"></i>
                                <span class="text-[10px] uppercase text-slate-400 tracking-widest font-black block">{{ $jRow->volume_issue }}</span>
                            </div>
                            <div class="mt-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider"><i class="fas fa-user-graduate text-[#0284C7] mr-1"></i> {{ $jRow->author_name }}</span>
                                <h4 class="text-sm font-bold text-slate-900 mt-1.5 group-hover:text-[#0284C7] transition-colors leading-snug line-clamp-2">
                                    {{ $jRow->title }}
                                </h4>
                            </div>
                        </div>
                        
                        <div class="flex gap-2 pt-3 border-t border-slate-100 mt-auto">
                            <a href="{{ asset('storage/' . $jRow->journal_file) }}" target="_blank" class="flex-1 text-center bg-slate-50 hover:bg-sky-50 text-slate-700 hover:text-[#0284C7] border border-slate-200 py-2 rounded-xl text-xs font-bold no-underline transition-colors"><i class="fas fa-eye mr-1"></i> View</a>
                            <a href="{{ asset('storage/' . $jRow->journal_file) }}" download class="flex-1 text-center bg-[#0F172A] hover:bg-[#DC2626] text-white py-2 rounded-xl text-xs font-bold no-underline transition-colors shadow-sm"><i class="fas fa-download mr-1"></i> Download</a>
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
@endsection