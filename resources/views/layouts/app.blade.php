<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BACTA | Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists')</title>
    <meta name="description" content="Official website of Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA). Advancing perioperative care and thoracic anesthesia research.">
    <meta name="keywords" content="BACTA, BACTA Bangladesh, Cardiac Anesthesia Bangladesh, Thoracic Anesthesiologists, Cardiovascular Anesthesia, BJCTA Journal">
    <meta name="author" content="Matrik Solutions">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="BACTA Bangladesh">
    <meta property="og:title" content="@yield('title', 'BACTA | Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists')">
    <meta property="og:description" content="Official website of Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA).">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:image:alt" content="BACTA Bangladesh Logo">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'BACTA | Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists')">
    <meta name="twitter:description" content="Official website of Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA).">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="no-referrer-when-downgrade">
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes heartbeat {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.6; }
            100% { transform: scale(1); opacity: 1; }
        }
        .pulse-heart { animation: heartbeat 1.2s infinite ease-in-out; }

        /* --- লোগো হাইড ও স্টিকি হেডারের জন্য ট্রানজিশন লক ইফেক্ট --- */
        #main-header-navbar {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #brand-identity-block {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-[#0F172A] antialiased flex flex-col min-h-screen">

    <!-- Header -->
    <nav id="main-header-navbar"
        class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

            <div class="flex items-center justify-between w-full">

                <!-- Left Side : Logo + Brand -->
                <div class="flex items-center gap-4 min-w-0 flex-1">

                    <!-- Logo -->
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 rounded-full bg-sky-200 blur-xl opacity-40"></div>

                        <div
                            class="relative w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-full shadow-md border border-slate-200 flex items-center justify-center">

                            <img src="{{ asset('images/logo.png') }}"
                                alt="BACTA Logo"
                                class="w-10 h-10 lg:w-12 lg:h-12 object-contain">
                        </div>
                    </div>

                    <!-- Brand Text -->
                    <div class="relative hidden sm:block min-w-0">

                        <div
                            class="absolute -top-5 left-0 text-4xl lg:text-5xl font-black text-sky-100 opacity-30 select-none pointer-events-none">
                            BACTA
                        </div>

                        <div class="relative z-10">

                            <h1
                                class="text-xl lg:text-2xl font-black tracking-tight bg-gradient-to-r from-[#0F172A] via-[#1E40AF] to-[#0284C7] bg-clip-text text-transparent leading-none">
                                BACTA
                            </h1>

                            <div class="flex items-center gap-2 mt-1 mb-1">

                                <svg width="50" height="10" viewBox="0 0 70 14" fill="none">
                                    <path d="M0 7H15L20 2L26 12L33 1L40 7H70"
                                        stroke="#0284C7"
                                        stroke-width="2"
                                        fill="none" />
                                </svg>

                                <div
                                    class="h-[1.5px] w-8 bg-gradient-to-r from-sky-600 to-transparent rounded-full">
                                </div>

                            </div>

                            <p
                                class="text-[9px] lg:text-xs font-semibold tracking-wider uppercase text-slate-600 truncate max-w-[280px] sm:max-w-[360px] lg:max-w-xl">
                                Bangladesh Association of Cardiovascular &
                                Thoracic Anesthesiologists
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Desktop Right Side -->
                <div class="hidden md:flex items-center space-x-3 flex-shrink-0">

                    <!-- Search -->
                    <form action="#" method="GET" class="relative">

                        <input type="text"
                            name="search"
                            placeholder="Search journals, notices..."
                            class="w-40 lg:w-52 pl-3 pr-8 py-2 text-xs font-medium border border-slate-200 rounded-lg bg-slate-50 focus:outline-none focus:border-[#0284C7] focus:bg-white transition-all">

                        <button type="submit"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#0284C7]">

                            <svg class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

                        </button>

                    </form>

                    <!-- Auth User -->
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 rounded-lg transition-all shadow-sm whitespace-nowrap">

                            <i class="fas fa-user-circle mr-2"></i>
                            {{ Auth::user()->name }}

                        </a>
                    @endauth

                    <!-- Guest -->
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-[#0284C7] hover:bg-[#0369A1] rounded-lg transition-all shadow-sm whitespace-nowrap">

                            Register / Sign In

                        </a>
                    @endguest

                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">

                    <button id="mobile-menu-button"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-[#0284C7] hover:bg-slate-100 transition-colors">

                        <svg class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path id="hamburger-icon"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16" />

                            <path id="close-icon"
                                class="hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>

            </div>

        </div>

    </nav>

</body>
<div class="hidden md:block border-t border-slate-100 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex space-x-6 h-12 items-center text-sm font-bold text-[#475569]">
        
        <!-- ১. হোম লিংক জোন -->
        <a href="{{ Route::has('home') ? route('home') : url('/') }}" class="{{ Route::is('home') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Home
        </a>

        <!-- ২. অ্যাবাউট BACTA লিংক জোন -->
        <a href="{{ Route::has('about') ? route('about') : '#' }}" class="{{ Route::is('about') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            About BACTA
        </a>

        <!-- ৩. ড্রপডাউন ১: Governance & Membership (আপনার ৩টি নতুন ডাইনামিক পেজ সিঙ্কড) -->
        <div class="relative group h-12 flex items-center">
            <button class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Governance & Membership
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            
            <!-- Hover Dropdown Box Overlay -->
            <div class="absolute top-12 left-0 w-60 bg-white border border-slate-100 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
                <a href="{{ Route::has('committee') ? route('committee') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('committee') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Executive Committee
                </a>
                
                <a href="{{ Route::has('members.lifetime') ? route('members.lifetime') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('members.lifetime') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Lifetime Fellows
                </a>
                
                <a href="{{ Route::has('members.active') ? route('members.active') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('members.active') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Active Members
                </a>
            </div>
        </div>

        <!-- 🚀 ৪. ড্রপডাউন ২: NEW UPDATE - News & Publications (আপনার স্ক্রিনশটের নতুন জাদুকরী রূপ) -->
        <div class="relative group h-12 flex items-center">
            <button class="{{ (Route::is('president.message') || Route::is('notice.archive') || Route::is('events.list')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4h-2m2 4h-2m2 4h-2M9 8h4m-4 4h4m-4 4h2"/></svg>
                News & Publications
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            
            <!-- Hover Dropdown Box Overlay -->
            <div class="absolute top-12 left-0 w-60 bg-white border border-slate-100 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
                <a href="{{ Route::has('president.message') ? route('president.message') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('president.message') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    President's Message
                </a>
                
                <a href="{{ Route::has('notice.archive') ? route('notice.archive') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('notice.archive') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Announcements
                </a>
                
                <a href="{{ Route::has('events.list') ? route('events.list') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('events.list') ? 'text-[#0284C7] bg-sky-50/50' : 'text-slate-700 hover:bg-sky-50 hover:text-[#0284C7]' }} transition-all">
                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Events & Updates
                </a>
            </div>
        </div>

        <!-- ৫. ওফিসিয়াল জার্নাল লিংক জোন -->
        <a href="#" class="hover:text-[#0284C7] h-12 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Journals (BACTA)
        </a>

        <!-- ৬. সাধারণ নোটিশ বোর্ড লিংক জোন -->
        <a href="#" class="hover:text-[#0284C7] h-12 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            Notice Board
        </a>

        <!-- ৭. কন্টাক্ট বা যোগাযোগ লিংক জোন -->
        <a href="#" class="hover:text-[#0284C7] h-12 flex items-center gap-1.5 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Contact
        </a>
    </div>
</div>

        <!-- Mobile Menu Dropdown Panel (BSEcho-Inspired Accordion Style) -->
        <div id="mobile-dropdown" class="hidden bg-white border-t border-slate-100 shadow-inner">
            <div class="px-4 pt-4 pb-6 space-y-1 text-base font-medium">
                
                <!-- 1. Mobile Active Search Portal -->
                <form action="#" method="GET" class="relative mb-3 px-3">
                    <input type="text" name="search" placeholder="Search here..." class="w-full pl-4 pr-10 py-2.5 text-sm border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:border-[#0284C7] focus:bg-white transition-all">
                    <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </form>

                <!-- 🚀 ১. Home Link (Mobile) -->
<a href="{{ Route::has('home') ? route('home') : url('/') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('home') ? 'text-[#0284C7] bg-sky-50/50 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Home
</a>

<!-- 🚀 ২. About Link (Mobile) -->
<a href="{{ Route::has('about') ? route('about') : '#' }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('about') ? 'text-[#0284C7] bg-sky-50/50 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    About BACTA
</a>

<!-- 🚀 ৩. Click Accordion Menu 1: Governance & Membership -->
<div class="border-t border-slate-100 pt-2 mt-2">
    <button id="mobile-submenu-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-[#0284C7] bg-sky-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <span class="text-base font-medium">Governance & Membership</span>
        </div>
        <svg id="submenu-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300 {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
    
    <div id="mobile-submenu-box" class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1 transition-all">
        <a href="{{ Route::has('committee') ? route('committee') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('committee') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            Executive Committee
        </a>
        <a href="{{ Route::has('members.lifetime') ? route('members.lifetime') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('members.lifetime') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            Lifetime Fellows
        </a>
        <a href="{{ Route::has('members.active') ? route('members.active') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('members.active') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Active Members
        </a>
    </div>
</div>

<!-- 🚀 ৪. Click Accordion Menu 2: NEW UPDATE - News & Publications (মোবাইল টগল উইজেট) -->
<div class="border-t border-slate-100 pt-2 mt-1">
    <button id="mobile-news-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('president.message') || Route::is('notice.archive') || Route::is('events.list')) ? 'text-[#0284C7] bg-sky-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4h-2m2 4h-2m2 4h-2M9 8h4m-4 4h4m-4 4h2"/></svg>
            <span class="text-base font-medium">News & Publications</span>
        </div>
        <svg id="news-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300 {{ (Route::is('president.message') || Route::is('notice.archive') || Route::is('events.list')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
    
    <div id="mobile-news-box" class="{{ (Route::is('president.message') || Route::is('notice.archive') || Route::is('events.list')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1 transition-all">
        <a href="{{ Route::has('president.message') ? route('president.message') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('president.message') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            President's Message
        </a>
        <a href="{{ Route::has('notice.archive') ? route('notice.archive') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('notice.archive') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Announcements
        </a>
        <a href="{{ Route::has('events.list') ? route('events.list') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('events.list') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Events & Updates
        </a>
    </div>
</div>
<div class="border-t border-slate-100 my-2"></div>

<!-- 🚀 ৫. Journals Link (Mobile) -->
<a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    Journals (BACTA)
</a>

<!-- 🚀 ৬. Notice Board Link (Mobile) -->
<a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
    Notice Board
</a>

<!-- 🚀 ৭. Contact Link (Mobile) -->
<a href="#" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    Contact
</a>

{{-- 🛠️ মোবাইল ক্লিক ট্র্যাকার ইন্টেলিজেন্ট ইঞ্জিন (প্লাগইন ছাড়া নেটিভ সচল) --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ১. প্রথম মেনু: Governance & Membership টগল লজিক ভাই
        let govTrigger = document.getElementById('mobile-submenu-trigger');
        let govBox = document.getElementById('mobile-submenu-box');
        let govArrow = document.getElementById('submenu-arrow');

        if(govTrigger && govBox) {
            govTrigger.addEventListener('click', function() {
                govBox.classList.toggle('hidden');
                govArrow.classList.toggle('rotate-180');
            });
        }

        // ২. দ্বিতীয় নতুন মেনু: News & Publications টগল লজিক ভাই (আপনার ওল্ড সেকশন ফিক্স)
        let newsTrigger = document.getElementById('mobile-news-trigger');
        let newsBox = document.getElementById('mobile-news-box');
        let newsArrow = document.getElementById('news-arrow');

        if(newsTrigger && newsBox) {
            newsTrigger.addEventListener('click', function() {
                newsBox.classList.toggle('hidden');
                newsArrow.classList.toggle('rotate-180');
            });
        }
    });
</script>                
                <!-- 8. Mobile Action CTA Gate (Dynamic) -->
                <div class="pt-4 border-t border-slate-100 mt-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex w-full items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-slate-800 rounded-xl shadow-sm hover:bg-slate-900 transition-all">
                            <i class="fas fa-user-circle mr-1.5"></i> {{ Auth::user()->name }} (Portal)
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="flex w-full items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-[#0284C7] rounded-xl shadow-sm hover:bg-[#0369A1] transition-all">Register or Sign In</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <!-- 5. DYNAMIC MAIN CONTENT SLOTS WITH SMART TOAST ALERT -->
        <!-- 2. DYNAMIC MAIN CONTENT SLOTS WITH SMART TOAST ALERT -->
    <main class="flex-grow relative">
        
        <!-- Smart AI-Style Dynamic Success Notification -->
        @if (session('success'))
            <div id="bacta-success-toast" class="fixed top-24 right-4 sm:right-8 z-[100] max-w-md bg-emerald-950 border border-emerald-500/30 p-4 rounded-2xl shadow-2xl shadow-emerald-950/20 flex items-start gap-3 animate-bounce">
                <!-- Glowing Green Tick Icon -->
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 border border-emerald-500/40 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <!-- Message Copywriting (English Compliant for Doctors) -->
                <div class="space-y-0.5 pr-4">
                    <h5 class="text-sm font-black text-white tracking-tight">Submission Successful</h5>
                    <p class="text-emerald-400 text-xs font-semibold leading-relaxed">{{ session('success') }}</p>
                </div>
                <!-- Close Button -->
                <button onclick="closeBactaToast()" type="button" class="text-emerald-500 hover:text-white transition-colors focus:outline-none ml-auto -mt-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @yield('content')
    </main>


    <!-- Professional Dark Footer Section -->
    <footer class="bg-[#0F172A] text-slate-400 py-6 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
            
            <div class="flex items-center space-x-2">
                <span class="text-white font-bold tracking-tight text-sm">BACTA</span>
                <span class="text-slate-600">|</span>
                <p>© {{ date('Y') }} BACTA Bangladesh. All Rights Reserved.</p>
            </div>       
            
            <div class="flex items-center space-x-1.5 text-slate-500">
                <span class="pulse-heart inline-block w-2.5 h-2.5 rounded-full bg-red-500 shadow-[0_0_8px_#ef4444] mr-0.5"></span>
                <span>Digital Innovation by</span>
                <a href="https://it.matri.com.bd" target="_blank" rel="noopener noreferrer" class="font-extrabold tracking-wider bg-gradient-to-r from-[#38BDF8] to-[#0284C7] bg-clip-text text-transparent hover:brightness-110 transition-all">
                    Matrik
                </a>
            </div>
        </div>
    </footer>

    <!-- 100% Perfect Back To Top Arrow Button (Hidden by default, scales on scroll) -->
    <button id="back-to-top-btn" type="button" class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-xl bg-[#0284C7] hover:bg-[#0369A1] text-white flex items-center justify-center shadow-lg shadow-sky-500/20 opacity-0 translate-y-10 scale-75 pointer-events-none transition-all duration-300 focus:outline-none">
        <svg class="w-5 h-5 font-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
        </svg>
    </button>
    <!-- 6. GLOBAL LIGHTWEIGHT CORE JAVASCRIPT MECHANISMS -->
    <script>
        // Core Navbar and Scrolling Dynamic Tracking Selectors
        const mainNavbar = document.getElementById('main-header-navbar');
        const brandIdentityBlock = document.getElementById('brand-identity-block');
        const backToTopBtn = document.getElementById('back-to-top-btn');

        // ১. আল্ট্রা-স্মার্ট হেডার শ্রিঙ্ক এবং ব্যাক-টু-টপ স্ক্রোল মেকানিজম
        window.addEventListener('scroll', () => {
            const scrollValue = window.scrollY;

            // মেম্বাররা যখন ১০০ পিক্সেলের বেশি স্ক্রোল করবে তখন লোগো ও টাইটেল স্মুথলি হাইড হবে
            if (scrollValue > 100) {
                if (brandIdentityBlock) {
                    brandIdentityBlock.style.maxHeight = '0px';
                    brandIdentityBlock.style.overflow = 'hidden';
                    brandIdentityBlock.style.opacity = '0';
                    brandIdentityBlock.style.marginBottom = '-10px';
                    brandIdentityBlock.style.marginTop = '-10px';
                }
                if (mainNavbar) {
                    mainNavbar.classList.add('shadow-md', 'py-1');
                }
            } else {
                // একদম ওপরে থাকলে লোগো ও বড় টাইটেল আবার আগের জায়গায় ফিরে আসবে
                if (brandIdentityBlock) {
                    brandIdentityBlock.style.maxHeight = '200px';
                    brandIdentityBlock.style.opacity = '1';
                    brandIdentityBlock.style.marginBottom = '0px';
                    brandIdentityBlock.style.marginTop = '0px';
                }
                if (mainNavbar) {
                    mainNavbar.classList.remove('shadow-md', 'py-1');
                }
            }

            // স্ক্রোল ৩০০ পিক্সেল পার হলে ব্যাক-টু-টপ অ্যারো বাটনটি স্মুথলি ভেসে উঠবে
            if (scrollValue > 300) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'scale-75', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
                backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'scale-75', 'pointer-events-none');
            }
        });

        // ব্যাক-টু-টপ বাটনে ক্লিক করলে স্মুথলি একদম ওপরে স্ক্রোল করার ট্রিগার
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // ২. মোবাইল হ্যামবার্গার মেনু খোলার ও বন্ধ করার মেকানিজম
        const menuBtn = document.getElementById('mobile-menu-button');
        const dropdown = document.getElementById('mobile-dropdown');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (menuBtn && dropdown) {
            menuBtn.addEventListener('click', () => {
                const isHidden = dropdown.classList.contains('hidden');
                if (isHidden) {
                    dropdown.classList.remove('hidden');
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });
        }

        // ৩. মোবাইল সাব-মেনু (Governance & Membership) ক্লিক মেকানিজম
        const subTrigger = document.getElementById('mobile-submenu-trigger');
        const subBox = document.getElementById('mobile-submenu-box');
        const subArrow = document.getElementById('submenu-arrow');

        if (subTrigger && subBox && subArrow) {
            subTrigger.addEventListener('click', () => {
                const isBoxHidden = subBox.classList.contains('hidden');
                if (isBoxHidden) {
                    subBox.classList.remove('hidden');
                    subArrow.classList.add('rotate-180');
                } else {
                    subBox.classList.add('hidden');
                    subArrow.classList.remove('rotate-180');
                }
            });
        }

        // ৪. আল্ট্রা-স্মার্ট স্ক্রিন রিসাইজ হ্যান্ডলার (উইন্ডো বড় করলে মোবাইলের সব মেনু অটো রিসেট হবে)
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { 
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
                if (subBox && subArrow) {
                    subBox.classList.add('hidden');
                    subArrow.classList.remove('rotate-180');
                }
            }
        });

        // ৫. স্মার্ট সাকসেস টোস্ট এলার্ট অটো-হাইড মেকানিজম (৪ সেকেন্ড পর ভ্যানিশ হবে)
        const successToast = document.getElementById('bacta-success-toast');
        function closeBactaToast() {
            if (successToast) {
                successToast.style.display = 'none';
            }
        }
        if (successToast) {
            setTimeout(() => {
                closeBactaToast();
            }, 4000);
        }
    </script>
</body>
</html>
