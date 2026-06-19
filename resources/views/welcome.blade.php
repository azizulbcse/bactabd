@extends('layouts.app')

@section('title', 'Home | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <header class="relative bg-slate-950 overflow-hidden min-h-[580px] flex items-center">
        <div id="bacta-image-track" class="absolute inset-0 w-full h-full z-0">
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-100 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner1.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner2.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner3.jpg') }}');"></div>
        </div>

        <div class="absolute inset-0 bg-slate-950/40 z-10"></div>
        
        <button type="button" onclick="navigateBactaDynamicSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-[#0F172A]/60 border border-slate-700 text-white flex items-center justify-center hover:bg-[#DC2626] hover:border-[#DC2626] transition-all duration-300 focus:outline-none shadow-lg">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
        <button type="button" onclick="navigateBactaDynamicSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-[#0F172A]/60 border border-slate-700 text-white flex items-center justify-center hover:bg-[#DC2626] hover:border-[#DC2626] transition-all duration-300 focus:outline-none shadow-lg">
            <i class="fas fa-chevron-right text-sm"></i>
        </button>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-20 py-20 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 text-center lg:text-left">
                <div id="bacta-text-track" class="min-h-[280px] flex flex-col justify-center drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                    
                    <div class="bacta-text-slide block opacity-100 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#DC2626]/10 text-[#DC2626] mb-6 backdrop-blur-md border border-[#DC2626]/20 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-[#DC2626] animate-pulse"></span> National Clinical Hub
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Advancing the Science of <br>
                            <span class="bg-gradient-to-r from-red-500 to-[#DC2626] bg-clip-text text-transparent">Cardiac Anesthesia</span> in Bangladesh.
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Connecting premium clinical specialists, publishing groundbreaking research, and setting national benchmarks for cardiovascular perioperative care.
                        </p>
                    </div>

                    <div class="bacta-text-slide hidden opacity-0 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#0F172A]/80 text-[#0284C7] mb-6 backdrop-blur-md border border-slate-700/50 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-[#0284C7]"></span> Peer-Reviewed Library
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Explore Breakthrough <br>
                            <span class="bg-gradient-to-r from-[#0284C7] to-indigo-400 bg-clip-text text-transparent">BJCTA Research Journals</span>
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Access our official scientific papers, perioperative echocardiography studies, and global thoracic case tracking workflows.
                        </p>
                    </div>

                    <div class="bacta-text-slide hidden opacity-0 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#0F172A]/80 text-amber-500 mb-6 backdrop-blur-md border border-slate-700/50 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-amber-500"></span> Scientific Congress 2026
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Join BACTA National <br>
                            <span class="bg-gradient-to-r from-amber-400 to-orange-500 bg-clip-text text-transparent">Annual Conference</span>
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Book your seats for the largest clinical theater gathering, senior registrar workshops, and expert panel discussions on thoracic anesthesia.
                        </p>
                    </div>

                </div>
                
                <div class="mt-4 flex flex-wrap justify-center lg:justify-start">
                    <a href="{{ route('journals.archive') }}" class="px-7 py-3.5 bg-gradient-to-r from-[#0284C7] to-[#1E40AF] hover:from-[#DC2626] hover:to-[#991B1B] text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-sky-500/10 transition-all duration-300 transform hover:-translate-y-0.5">
                        Explore Portal
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5 w-full max-w-md mx-auto lg:mx-0">
                <div class="bg-[#0F172A]/85 backdrop-blur-xl rounded-2xl border border-slate-800 p-6 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-500/10 rounded-full blur-2xl"></div>
                    
                    <div class="border-b border-slate-800 pb-3 mb-4 flex items-center justify-between">
                        <span class="text-xs font-bold tracking-[0.2em] text-[#DC2626] uppercase">From the President's Desk</span>
                        <span class="w-2 h-2 rounded-full bg-[#DC2626] animate-pulse"></span>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-20 h-20 bg-slate-900 rounded-xl border border-slate-800 flex-shrink-0 flex items-center justify-center overflow-hidden shadow-md">
                            <img src="{{ asset('storage/committee_pics/president.jpg') }}" 
                                 alt="Prof. A. T. M. Khalilur Rahman" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://w3.org\' viewBox=\'0 0 1 1\' fill=\'%231e293b\'/>';">
                        </div>
                        
                        <div>
                            <h3 class="text-base font-bold text-white tracking-tight leading-snug">Prof. A. T. M. Khalilur Rahman</h3>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">Founder Member & President, BACTA</p>
                            <p class="text-slate-400 text-[11px] mt-1 leading-normal">National Heart Foundation Hospital and Research Institute [NHFH&RI]</p>
                        </div>
                    </div>
                    <div class="mt-4 bg-[#0F172A]/40 rounded-xl p-3.5 border border-slate-800">
                        <p class="text-white text-xs leading-relaxed italic opacity-95">
                            "Welcome to the official digital portal of BACTA. Our mission remains steadfast in advancing perioperative patient safety, fostering thoracic research, and educating the next generation of anesthesiologists across Bangladesh."
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-6 left-1/2 lg:left-32 lg:-translate-x-0 -translate-x-1/2 z-30 flex space-x-3">
            <button type="button" onclick="changeBactaDynamicSlide(0)" class="bacta-dot w-8 h-2 rounded-full bg-[#DC2626] transition-all duration-300" aria-label="Slide 1"></button>
            <button type="button" onclick="changeBactaDynamicSlide(1)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300" aria-label="Slide 2"></button>
            <button type="button" onclick="changeBactaDynamicSlide(2)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300" aria-label="Slide 3"></button>
        </div>
    </header>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Pillar Card 1 (Royal Blue Node) -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 bg-sky-50 text-[#0284C7] rounded-xl flex items-center justify-center mb-5 font-bold text-sm transition-colors group-hover:bg-[#0284C7] group-hover:text-white shadow-sm">01</div>
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#0284C7] transition-colors">Clinical Guidelines</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Download official perioperative protocols, echo standards, and medical PDFs.</p>
                <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] mt-4 no-underline hover:underline">Browse Library &rarr;</a>
            </div>

            <!-- Pillar Card 2 (Medical Red Node) -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 bg-red-50 text-[#DC2626] rounded-xl flex items-center justify-center mb-5 font-bold text-sm transition-colors group-hover:bg-[#DC2626] group-hover:text-white shadow-sm">02</div>
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#DC2626] transition-colors">Membership Portal</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Join the national elite network of thoracic and cardiac anesthesia veterans.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center text-xs font-bold text-[#DC2626] mt-4 no-underline hover:underline">Register Portal &rarr;</a>
            </div>

            <!-- Pillar Card 3 (Royal Blue Node) -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 bg-sky-50 text-[#0284C7] rounded-xl flex items-center justify-center mb-5 font-bold text-sm transition-colors group-hover:bg-[#0284C7] group-hover:text-white shadow-sm">03</div>
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#0284C7] transition-colors">CME & Events</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Access upcoming advanced workshops, scientific webinars, and annual congress.</p>
                <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center text-xs font-bold text-[#0284C7] mt-4 no-underline hover:underline">View Calendar &rarr;</a>
            </div>

            <!-- Pillar Card 4 (Medical Red Node) -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-10 h-10 bg-red-50 text-[#DC2626] rounded-xl flex items-center justify-center mb-5 font-bold text-sm transition-colors group-hover:bg-[#DC2626] group-hover:text-white shadow-sm">04</div>
                <h3 class="text-base font-bold text-slate-900 group-hover:text-[#DC2626] transition-colors">BJCTA Journals</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Explore groundbreaking research, academic articles, and global case studies.</p>
                <a href="{{ route('journals.archive') }}" class="inline-flex items-center text-xs font-bold text-[#DC2626] mt-4 no-underline hover:underline">Read Research &rarr;</a>
            </div>

        </div>
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
        const textSlides = document.querySelectorAll('.bacta-text-slide');
        const sliderDots = document.querySelectorAll('.bacta-dot');

        function changeBactaDynamicSlide(slideIndex) {
            if (imgSlides.length === 0) return;
            
            imgSlides[currentBactaSlideIdx].classList.replace('opacity-100', 'opacity-0');
            textSlides[currentBactaSlideIdx].classList.replace('block', 'hidden');
            textSlides[currentBactaSlideIdx].classList.replace('opacity-100', 'opacity-0');
            sliderDots[currentBactaSlideIdx].classList.replace('w-8', 'w-2.5');
            sliderDots[currentBactaSlideIdx].classList.replace('bg-[#DC2626]', 'bg-white/40');

            currentBactaSlideIdx = slideIndex;

            imgSlides[currentBactaSlideIdx].classList.replace('opacity-0', 'opacity-100');
            textSlides[currentBactaSlideIdx].classList.remove('hidden');
            setTimeout(() => {
                textSlides[currentBactaSlideIdx].classList.add('block', 'opacity-100');
            }, 50);
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
