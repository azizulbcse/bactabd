<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'History of BACTA | Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists')

@section('content')

    {{-- HEADER BANNER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">About the Association</span>
                <h1 class="text-2xl lg:text-3xl font-semibold tracking-tight text-[#0F172A]">History of BACTA</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">History of BACTA</span>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <section class="py-16" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-8 sm:p-12 space-y-10">

                {{-- Section 1 --}}
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-[#0284C7] flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-building-columns text-sm"></i>
                    </div>
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-slate-900 tracking-tight">Foundation & Genesis</h2>
                        <div class="h-0.5 w-12 bg-gradient-to-r from-[#0284C7] to-transparent rounded-full"></div>
                        <p class="text-sm text-slate-500 leading-relaxed" style="text-align:justify">
                            The Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA) was established with a visionary mission to unify medical pioneers specialized in cardiothoracic and vascular anesthesia across the nation. Recognizing the critical advancements in perioperative cardiac care, BACTA emerged as the premier academic body dedicated to setting international standards of patient safety, clinical protocols, and specialized professional training in Bangladesh.
                        </p>
                    </div>
                </div>

                <div class="border-t border-[#CFEAF5]"></div>

                {{-- Section 2 --}}
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-bullseye text-sm"></i>
                    </div>
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-slate-900 tracking-tight">Academic Mission & Evolution</h2>
                        <div class="h-0.5 w-12 bg-gradient-to-r from-emerald-500 to-transparent rounded-full"></div>
                        <p class="text-sm text-slate-500 leading-relaxed" style="text-align:justify">
                            Over the years, BACTA has evolved from an elite medical network into a cornerstone of academic and clinical research. The association plays a pivotal role in organizing national congresses, scientific seminars, advanced echocardiography workshops, and executing continuous medical education (CME) frameworks to equip the next generation of cardiothoracic anesthesiologists with global best practices.
                        </p>
                    </div>
                </div>

                <div class="border-t border-[#CFEAF5]"></div>

                {{-- Section 3 --}}
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 flex-shrink-0 mt-0.5">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <div class="space-y-3">
                        <h2 class="text-lg font-semibold text-slate-900 tracking-tight">Core Objectives & Milestones</h2>
                        <div class="h-0.5 w-12 bg-gradient-to-r from-purple-500 to-transparent rounded-full"></div>
                        <p class="text-sm text-slate-500 leading-relaxed" style="text-align:justify">
                            To further its clinical roadmap, the association strictly operates upon multi-tier baseline parameters aimed at enriching the nationwide medical landscape:
                        </p>

                        <ul class="space-y-3 mt-2">
                            <li class="flex items-start gap-3">
                                <span class="mt-1.5 w-2 h-2 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                <span class="text-sm text-slate-500 leading-relaxed">Formulating and implementing certified, unified cardiovascular perioperative anesthesia standards across all active registered registries in Bangladesh.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1.5 w-2 h-2 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                <span class="text-sm text-slate-500 leading-relaxed">Fostering breaking research pipelines and compiling global medical journals to represent Bangladesh on prestigious international cardiorespiratory academic platforms.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1.5 w-2 h-2 rounded-full bg-[#0284C7] flex-shrink-0 ring-4 ring-sky-100"></span>
                                <span class="text-sm text-slate-500 leading-relaxed">Strengthening collaboration between senior clinical veterans, research fellows, and global healthcare device leaders to catalyze innovation.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-[#CFEAF5]"></div>

                {{-- Note --}}
                <p class="text-xs text-slate-400 italic text-center">
                    This historical archive is continuously reviewed and curated by the Executive Committee of BACTA Bangladesh.
                </p>

            </div>
        </div>
    </section>

@endsection