@extends('layouts.app')

@section('title', 'Cardiology | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- HEADER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Department</span>
                <h1 class="text-3xl lg:text-4xl font-semibold tracking-tight text-[#0F172A]">Cardiology Division</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">Cardiology</span>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <section class="py-14" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- LEFT: Main content --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Overview card --}}
                    <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-7">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 border border-[#CFEAF5] flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-heart-pulse text-[#0284C7] text-sm"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-slate-900 tracking-tight">Overview & Scientific Focus</h2>
                                <div class="h-0.5 w-10 bg-gradient-to-r from-[#0284C7] to-transparent rounded-full mt-1"></div>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 leading-relaxed mb-3" style="text-align:justify">
                            The Cardiology Division under BACTA serves as a dedicated scientific forum bridging advanced cardiac anesthesia, intensive care, and cardiovascular medicine. It provides a platform for clinical research, evidence-based guidelines, and knowledge exchange among practitioners.
                        </p>
                        <p class="text-sm text-slate-500 leading-relaxed" style="text-align:justify">
                            National and international cardiovascular case studies, seminar proceedings, and peer-reviewed clinical practice guidelines are regularly catalogued and published through this division for the benefit of registered BACTA members.
                        </p>
                    </div>

                    {{-- Feature cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-6 flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-microscope text-emerald-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 mb-1">Clinical Research</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Advanced cardiovascular research and evidence-based clinical protocols.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-6 flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-chalkboard-user text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 mb-1">CME Seminars</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Continuing medical education workshops and scientific seminars.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-6 flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-book-open text-orange-500 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 mb-1">Case Studies</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">National and international cardiovascular case study catalogues.</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-6 flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-globe text-[#0284C7] text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800 mb-1">Global Guidelines</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">International cardiovascular clinical practice guidelines and standards.</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT: Sidebar --}}
                <div class="space-y-5">

                    {{-- Contact card --}}
                    <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 border border-[#CFEAF5] flex items-center justify-center">
                                <i class="fa-solid fa-phone-volume text-[#0284C7] text-sm"></i>
                            </div>
                            <h3 class="text-sm font-semibold text-slate-900">Quick Contact</h3>
                        </div>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            For queries regarding cardiothoracic guidelines or division activities, contact the BACTA secretariat directly.
                        </p>
                        <a href="{{ route('contact.archive') }}"
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-[#0284C7] to-[#1A4B84] text-white text-xs font-medium rounded-xl hover:opacity-90 transition-all no-underline shadow-sm shadow-sky-200">
                            <i class="fas fa-envelope text-[10px]"></i> Contact Department
                        </a>
                    </div>

                    {{-- Info card --}}
                    <div class="bg-[#F0FDFF] rounded-2xl border border-[#CFEAF5] p-6">
                        <h3 class="text-sm font-semibold text-slate-900 mb-3">Division Highlights</h3>
                        <ul class="space-y-2.5">
                            <li class="flex items-start gap-2.5 text-xs text-slate-500">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                Peer-reviewed cardiovascular research publications
                            </li>
                            <li class="flex items-start gap-2.5 text-xs text-slate-500">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                Annual CME workshop and conference programs
                            </li>
                            <li class="flex items-start gap-2.5 text-xs text-slate-500">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                International faculty exchange programs
                            </li>
                            <li class="flex items-start gap-2.5 text-xs text-slate-500">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                Structured training for cardiology professionals
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
