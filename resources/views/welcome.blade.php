@extends('layouts.app')

@section('title', 'Home | BACTA Bangladesh')

@section('content')
    <!-- 1. PREMIUM MEDICAL SLIDING BANNER (BSEcho-Inspired Clean Concept) -->
    <header class="relative bg-slate-950 overflow-hidden min-h-[580px] flex items-center">
        
        <!-- Background Image Track Area (100% Full Brightness) -->
        <div id="bacta-image-track" class="absolute inset-0 w-full h-full z-0">
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-100 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner1.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner2.jpg') }}');"></div>
            <div class="bacta-img-slide absolute inset-0 w-full h-full bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-in-out" style="background-image: url('{{ asset('images/banner3.jpg') }}');"></div>
        </div>

        <!-- Light Shield Just to Protect Text Drop Shadows -->
        <div class="absolute inset-0 bg-slate-950/20 z-10"></div>
        
        <!-- Main Core Container Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-20 py-20 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Side: Sliding Dynamic Information (Enhanced with CSS Text Drop-Shadow) -->
            <div class="lg:col-span-7 text-center lg:text-left">
                <div id="bacta-text-track" class="min-h-[280px] flex flex-col justify-center drop-shadow-[0_4px_12px_rgba(0,0,0,0.8)]">
                    
                    <div class="bacta-text-slide block opacity-100 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#0F172A]/80 text-[#38BDF8] mb-6 backdrop-blur-md border border-slate-700/50 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-[#38BDF8]"></span> National Clinical Hub
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Advancing the Science of <br>
                            <span class="bg-gradient-to-r from-[#38BDF8] to-[#0284C7] bg-clip-text text-transparent">Cardiac Anesthesia</span> in Bangladesh.
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Connecting premium clinical specialists, publishing groundbreaking research, and setting national benchmarks for cardiovascular perioperative care.
                        </p>
                    </div>

                    <div class="bacta-text-slide hidden opacity-0 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#0F172A]/80 text-emerald-400 mb-6 backdrop-blur-md border border-slate-700/50 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-emerald-400"></span> Peer-Reviewed Library
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Explore Breakthrough <br>
                            <span class="bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">BJCTA Research Journals</span>
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Access our official scientific papers, perioperative echocardiography studies, and global thoracic case tracking workflows.
                        </p>
                    </div>

                    <div class="bacta-text-slide hidden opacity-0 transition-all duration-500">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-[#0F172A]/80 text-purple-400 mb-6 backdrop-blur-md border border-slate-700/50 shadow-md">
                            <span class="w-1.5 h-1.5 inline-block rounded-full bg-purple-400"></span> Scientific Congress 2026
                        </span>
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                            Join BACTA National <br>
                            <span class="bg-gradient-to-r from-purple-400 to-pink-500 bg-clip-text text-transparent">Annual Conference</span>
                        </h1>
                        <p class="mt-6 text-sm sm:text-base text-white font-medium leading-relaxed max-w-xl">
                            Book your seats for the largest clinical theater gathering, senior registrar workshops, and expert panel discussions on thoracic anesthesia.
                        </p>
                    </div>

                </div>
                
                <div class="mt-4 flex flex-wrap justify-center lg:justify-start">
                    <a href="#" class="px-6 py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-sky-500/20 transition-all">
                        Explore Portal
                    </a>
                </div>
            </div>

            <!-- Right Side: Floating President's Desk Card -->
            <div class="lg:col-span-5 w-full max-w-md mx-auto lg:mx-0">
                <div class="bg-slate-950/85 backdrop-blur-xl rounded-2xl border border-slate-800/80 p-6 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl"></div>
                    
                    <div class="border-b border-slate-800 pb-3 mb-4 flex items-center justify-between">
                        <span class="text-xs font-bold tracking-[0.2em] text-[#38BDF8] uppercase">From the President's Desk</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-20 h-20 bg-slate-900 rounded-xl border border-slate-800 flex-shrink-0 flex items-center justify-center text-slate-500 overflow-hidden shadow-md">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white tracking-tight leading-snug">Prof. Dr. [President Name]</h3>
                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">President, BACTA</p>
                            <p class="text-slate-400 text-[11px] mt-1 leading-normal">National Institute of Cardiovascular Diseases (NICVD)</p>
                        </div>
                    </div>

                    <div class="mt-4 bg-slate-900/60 rounded-xl p-3.5 border border-slate-800/80">
                        <p class="text-white text-xs leading-relaxed italic opacity-95">
                            "Welcome to the official digital portal of BACTA. Our mission remains steadfast in advancing perioperative patient safety, fostering thoracic research, and educating the next generation of anesthesiologists across Bangladesh."
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- 100% Perfect Smart Indicator Dots -->
        <div class="absolute bottom-6 left-1/2 lg:left-32 lg:-translate-x-0 -translate-x-1/2 z-30 flex space-x-3">
            <button onclick="changeBactaDynamicSlide(0)" class="bacta-dot w-8 h-2 rounded-full bg-white transition-all duration-300" aria-label="Slide 1"></button>
            <button onclick="changeBactaDynamicSlide(1)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300" aria-label="Slide 2"></button>
            <button onclick="changeBactaDynamicSlide(2)" class="bacta-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300" aria-label="Slide 3"></button>
        </div>
    </header>


    <!-- 2. MEDICAL PORTAL ACTION PILLARS (BSEcho-Inspired Grid System) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1 transition-all duration-300">
                <div class="w-10 h-10 bg-sky-50 text-[#0284C7] rounded-xl flex items-center justify-center mb-5 font-bold text-sm">01</div>
                <h3 class="text-base font-bold text-slate-900">Clinical Guidelines</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Download official perioperative protocols, echo standards, and medical PDFs.</p>
                <a href="#" class="inline-flex items-center text-xs font-semibold text-[#0284C7] mt-4 hover:underline">Browse Library →</a>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1 transition-all duration-300">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-5 font-bold text-sm">02</div>
                <h3 class="text-base font-bold text-slate-900">Membership Portal</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Join the national elite network of thoracic and cardiac anesthesia veterans.</p>
                <a href="#" class="inline-flex items-center text-xs font-semibold text-emerald-600 mt-4 hover:underline">Register Portal →</a>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1 transition-all duration-300">
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-5 font-bold text-sm">03</div>
                <h3 class="text-base font-bold text-slate-900">CME & Events</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Access upcoming advanced workshops, scientific webinars, and annual congress.</p>
                <a href="#" class="inline-flex items-center text-xs font-semibold text-purple-600 mt-4 hover:underline">View Calendar →</a>
            </div>

            <!-- Card 4 -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-xl shadow-slate-100/40 hover:-translate-y-1 transition-all duration-300">
                <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-5 font-bold text-sm">04</div>
                <h3 class="text-base font-bold text-slate-900">BJCTA Journals</h3>
                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Explore groundbreaking research, academic articles, and global case studies.</p>
                <a href="#" class="inline-flex items-center text-xs font-semibold text-amber-600 mt-4 hover:underline">Read Research →</a>
            </div>

        </div>
    </section>
    <!-- 3. DUAL COLUMN LAYOUT: SCIENTIFIC SESSIONS & ANNOUNCEMENTS -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <!-- Left Area: Scientific Sessions (Occupies 2 columns) -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">Upcoming Scientific Sessions</h2>
                    <p class="text-xs text-slate-500 mt-1">Global and national medical knowledge sharing timelines</p>
                </div>
                <a href="#" class="text-xs font-semibold text-[#0284C7] hover:underline">View All Events</a>
            </div>

            <!-- Event Card 1 -->
            <div class="flex gap-6 bg-white p-5 rounded-2xl border border-slate-200/50 hover:shadow-md transition-all">
                <div class="flex-none w-16 h-20 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center text-center">
                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">July</span>
                    <span class="text-2xl font-bold text-slate-800 -mt-0.5">14</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#0284C7]">CME Webinar</span>
                    <h3 class="text-base font-bold text-slate-900 mt-1 hover:text-[#0284C7] cursor-pointer transition-colors">Research Integrity in Cardiothoracic Anesthesia</h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">A specialized panel discussion focusing on ethical structures and modern clinical writing frameworks for global publication.</p>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="flex gap-6 bg-white p-5 rounded-2xl border border-slate-200/50 hover:shadow-md transition-all">
                <div class="flex-none w-16 h-20 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center text-center">
                    <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Aug</span>
                    <span class="text-2xl font-bold text-slate-800 -mt-0.5">05</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-purple-600">Hands-on Workshop</span>
                    <h3 class="text-base font-bold text-slate-900 mt-1 hover:text-purple-600 cursor-pointer transition-colors">Advanced Echocardiography: Complex Valve Evaluations</h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">Structured clinical approaches focusing on perioperative transesophageal echocardiography (TEE) for senior registrars.</p>
                </div>
            </div>
        </div>

        <!-- Right Area: Latest Insights Feed (Occupies 1 column) -->
        <div class="space-y-8">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900">Latest Insights</h2>
                    <p class="text-xs text-slate-500 mt-1">Official society announcements & updates</p>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="aspect-[16/10] bg-slate-950 rounded-2xl overflow-hidden border border-slate-800 flex items-center justify-center p-4">
                    <span class="text-[10px] uppercase text-slate-500 tracking-widest font-semibold">[ BJCTA Journal Banner ]</span>
                </div>
                <div class="mt-4">
                    <span class="text-[10px] font-semibold text-slate-400">June 11, 2026</span>
                    <h4 class="text-sm font-bold text-slate-900 mt-1 group-hover:text-[#0284C7] transition-colors leading-snug">
                        Introducing New BJCTA Editorial Panel Members for Academic Research Support
                    </h4>
                </div>
            </div>

            <div class="pt-5 border-t border-slate-200 group cursor-pointer">
                <span class="text-[10px] font-semibold text-slate-400">May 28, 2026</span>
                <h4 class="text-sm font-bold text-slate-900 mt-1 group-hover:text-[#0284C7] transition-colors leading-snug">
                    Lifetime Membership Registration Guidelines Upgraded for New Financial Year
                </h4>
            </div>
        </div>

    </main>

    <!-- AUTOMATIC LIGHTWEIGHT CAROUSEL CONTROLLER JAVASCRIPT -->
    <script>
        let currentBactaSlideIdx = 0;
        const imgSlides = document.querySelectorAll('.bacta-img-slide');
        const textSlides = document.querySelectorAll('.bacta-text-slide');
        const sliderDots = document.querySelectorAll('.bacta-dot');

        function changeBactaDynamicSlide(slideIndex) {
            imgSlides[currentBactaSlideIdx].classList.replace('opacity-100', 'opacity-0');
            textSlides[currentBactaSlideIdx].classList.replace('block', 'hidden');
            textSlides[currentBactaSlideIdx].classList.replace('opacity-100', 'opacity-0');
            sliderDots[currentBactaSlideIdx].classList.replace('w-8', 'w-2.5');
            sliderDots[currentBactaSlideIdx].classList.replace('bg-white', 'bg-white/40');

            currentBactaSlideIdx = slideIndex;

            imgSlides[currentBactaSlideIdx].classList.replace('opacity-0', 'opacity-100');
            textSlides[currentBactaSlideIdx].classList.remove('hidden');
            setTimeout(() => {
                textSlides[currentBactaSlideIdx].classList.add('block', 'opacity-100');
            }, 50);
            sliderDots[currentBactaSlideIdx].classList.replace('w-2.5', 'w-8');
            sliderDots[currentBactaSlideIdx].classList.replace('bg-white/40', 'bg-white');
        }

        setInterval(() => {
            let nextIdx = (currentBactaSlideIdx + 1) % imgSlides.length;
            changeBactaDynamicSlide(nextIdx);
        }, 5000);
    </script>
@endsection
