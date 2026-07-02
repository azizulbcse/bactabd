@extends('layouts.app')

@section('title', 'About Us | BACTA Bangladesh')

@section('content')

    {{-- 1. HEADER BANNER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Who We Are</span>
                <h1 class="text-3xl lg:text-4xl font-semibold tracking-tight text-[#0F172A]">About BACTA</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">About Us</span>
            </div>
        </div>
    </header>

    {{-- 2. MISSION OVERVIEW --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-5 space-y-4">
                <h2 class="text-2xl lg:text-3xl font-semibold text-slate-900 tracking-tight leading-snug">
                    Uniting Anesthesiologists for <span class="text-[#0284C7]">Cardiovascular Excellence</span>.
                </h2>
                <div class="h-0.5 w-16 bg-gradient-to-r from-[#0284C7] to-transparent rounded-full"></div>
            </div>

            <div class="lg:col-span-7">
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed" style="text-align:justify">
                    The Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA) serves as the official national body dedicated to associating and affiliating all clinical specialists actively practicing or previously veterans in the field of cardiovascular perioperative medicine [bactabd.org].
                </p>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-12 pt-12 border-t border-slate-100">
            <div class="bg-[#F0FDFF] p-6 rounded-2xl border border-[#B8DCEE] text-center">
                <span class="block text-3xl lg:text-4xl font-semibold text-[#0284C7] tracking-tight">500+</span>
                <span class="text-xs font-medium text-slate-400 mt-1 block">Active Specialists</span>
            </div>
            <div class="bg-[#F0FDF4] p-6 rounded-2xl border border-emerald-100 text-center">
                <span class="block text-3xl lg:text-4xl font-semibold text-emerald-600 tracking-tight">50+</span>
                <span class="text-xs font-medium text-slate-400 mt-1 block">BJCTA Journal Papers</span>
            </div>
            <div class="bg-[#FAF5FF] p-6 rounded-2xl border border-purple-100 text-center">
                <span class="block text-3xl lg:text-4xl font-semibold text-purple-600 tracking-tight">15+</span>
                <span class="text-xs font-medium text-slate-400 mt-1 block">Annual Live CME Workshops</span>
            </div>
        </div>
    </section>

    {{-- 3. AIMS & OBJECTIVES --}}
    <section class="border-y border-[#CFEAF5] py-20" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase">Our Constitution</span>
                <h2 class="text-2xl lg:text-3xl font-semibold text-slate-900 tracking-tight mt-2">Aims and Objectives of the Association</h2>
                <p class="text-xs text-slate-400 mt-3 leading-relaxed" style="text-align:justify">The foundational pillars set forth by BACTA to guide our clinical, academic, and professional advancements across Bangladesh.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="bg-white p-6 rounded-2xl border border-[#CFEAF5] shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-[#0284C7] flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Maintain Highest Standards</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Ensuring premium ethical benchmarks and safe compliance models in the clinical practice of Cardiovascular & Thoracic Anaesthesia.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#CFEAF5] shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Academic Progress</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Actively encouraging medical Education, advanced Training, structured Research, and ongoing Scientific progress.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#CFEAF5] shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Disseminate Information</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Publishing the official BJCTA medical journal and organizing CME workshops, structured training events, and professional seminars.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-[#CFEAF5] shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Welfare of Members</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Promoting the overall professional welfare, career development, and long-term interests of all registered BACTA members.</p>
                    </div>
                </div>

            </div>

            <div class="mt-10 text-center">
                <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-[#F0FDFF] text-slate-600 text-xs font-medium rounded-xl border border-[#CFEAF5] shadow-sm transition-all">
                    <svg class="w-4 h-4 text-[#0284C7]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    Download Full Constitution (PDF)
                </a>
            </div>
        </div>
    </section>

    {{-- 4. REMAINING PILLARS --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Public Protection</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Safeguarding the general public against irresponsible, uncertified, or unqualified clinical medical practitioners.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Safeguard Professional Interests</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Protecting and promoting the occupational interests, rights, and workflow status of all active association members.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.657-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.657-9 3-9m-9 9h18"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">International Affiliations</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Affiliating with elite international cardiac medical bodies to promote a mutual exchange of healthcare knowledge.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Faculty Exchange Programmes</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Encouraging global faculty exchange tracks both inside Bangladesh and across renowned foreign clinical centers.</p>
                    </div>
                </div>

                <div class="bg-[#F0FDFF] p-6 rounded-2xl border border-[#CFEAF5] shadow-sm flex items-start gap-4 md:col-span-2 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-pink-500 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Grants & Non-Profit Asset Management</h4>
                        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed" style="text-align:justify">Receiving donations, gifts, or state grants as per law, ensuring all earnings, income, and properties are transparently used solely for the promotion of BACTA constitutional aims.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 5. MEMBERSHIP CTA --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="rounded-3xl p-8 lg:p-12 text-center relative overflow-hidden border border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-[#0284C7]/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#00ADB5]/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase">Join Us</span>
                <h3 class="text-2xl lg:text-3xl font-semibold text-slate-900 tracking-tight">Apply for BACTA Official Membership</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Are you a practicing Cardiovascular & Thoracic Anesthesiologist in Bangladesh? Join our national clinical network to access BJCTA journals, manage scientific councils, and upgrade patient perioperative safety protocols.
                </p>
                <div class="pt-2">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white text-xs font-medium tracking-wide rounded-xl shadow-md shadow-sky-200 transition-all">
                        <i class="fas fa-user-plus text-xs"></i> Start Registration Portal →
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection