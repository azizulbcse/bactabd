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
        #main-header-navbar {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #brand-identity-block {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-[#0F172A] antialiased flex flex-col min-h-screen">
{{-- TOP SOCIAL BAR --}}
<div class="bg-gradient-to-r from-[#0F172A] via-[#1E3A5F] to-[#0F172A] text-white text-xs py-1.5 border-b border-slate-700/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <span class="hidden sm:block text-slate-400 text-[10px] font-medium tracking-wider">
            🏥 Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists
        </span>
        <div class="flex items-center gap-3 ml-auto">
            {{-- Facebook --}}
            <a href="https://facebook.com/bactabd" target="_blank"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#1877F2]/20 hover:bg-[#1877F2] text-[#1877F2] hover:text-white transition-all duration-300 border border-[#1877F2]/30">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">Facebook</span>
            </a>
            {{-- WhatsApp --}}
            <a href="https://wa.me/8801XXXXXXXXX" target="_blank"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#25D366]/20 hover:bg-[#25D366] text-[#25D366] hover:text-white transition-all duration-300 border border-[#25D366]/30">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">WhatsApp</span>
            </a>
            {{-- YouTube --}}
            <a href="https://youtube.com/@bactabd" target="_blank"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#FF0000]/20 hover:bg-[#FF0000] text-[#FF0000] hover:text-white transition-all duration-300 border border-[#FF0000]/30">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">YouTube</span>
            </a>
        </div>
    </div>
</div>
    <nav id="main-header-navbar"
        class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

            <div class="flex items-center justify-between w-full">

                <div class="flex items-center gap-4 min-w-0 flex-1">

                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 rounded-full bg-sky-200 blur-xl opacity-40"></div>

                        <div
                            class="relative w-16 h-16 lg:w-20 lg:h-20 bg-white rounded-full shadow-md border border-slate-200 flex items-center justify-center">

                            <img src="{{ asset('images/logo.png') }}"
                                alt="BACTA Logo"
                                class="w-13 h-13 lg:w-16 lg:h-16 object-contain">
                        </div>
                    </div>

                    <!-- Brand Text -->
                    <div class="relative block min-w-0">

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

                            <p class="text-[10px] sm:text-[11px] lg:text-[13px] font-black leading-tight max-w-[210px] sm:max-w-[340px] lg:max-w-xl">
                                <span class="bg-gradient-to-r from-[#0284C7] via-[#7C3AED] to-[#1E40AF] bg-clip-text text-transparent">
                                    Bangladesh Association of
                                </span>
                                <br>
                                <span class="bg-gradient-to-r from-[#DC2626] via-[#EA580C] to-[#0284C7] bg-clip-text text-transparent">
                                    Cardiovascular &amp; Thoracic Anesthesiologists
                                </span>
                            </p>

                        </div>

                    </div>

                </div>

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

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 rounded-lg transition-all shadow-sm whitespace-nowrap">

                            <i class="fas fa-user-circle mr-2"></i>
                            {{ Auth::user()->name }}

                        </a>
                    @endauth

                    @guest
    <div class="flex items-center gap-2">
        {{-- Join Us Button --}}
        <a href="{{ route('register') ?? '#' }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-black text-white rounded-lg transition-all shadow-md whitespace-nowrap
            bg-gradient-to-r from-[#7C3AED] via-[#DB2777] to-[#EA580C] hover:brightness-110 hover:scale-105 active:scale-95">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Join Us
        </a>
        {{-- Login Button --}}
        <a href="{{ route('login') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-[#0284C7] hover:bg-[#0369A1] rounded-lg transition-all shadow-sm whitespace-nowrap border border-sky-400/30">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Login
        </a>
    </div>
@endguest

                </div>

                <div class="md:hidden flex items-center gap-2">
    {{-- Mobile Join Us --}}
    <a href="{{ route('register') ?? '#' }}"
        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-[10px] font-black text-white rounded-lg
        bg-gradient-to-r from-[#7C3AED] via-[#DB2777] to-[#EA580C] whitespace-nowrap shadow-sm">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Join
    </a>
    {{-- Mobile Login --}}
    <a href="{{ route('login') }}"
        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-[10px] font-bold text-white bg-[#0284C7] rounded-lg whitespace-nowrap shadow-sm">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        Login
    </a>
    {{-- Hamburger --}}
    <button id="mobile-menu-button" type="button"
        class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-[#0284C7] hover:bg-slate-100 transition-colors">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path id="hamburger-icon" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
            </div>
        </div>
    </nav>

<div class="hidden md:block border-t border-slate-100 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex space-x-4 sm:space-x-5 h-12 items-center text-sm font-bold text-[#475569] whitespace-nowrap">
        <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-all text-xs lg:text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Home
        </a>
    <div class="relative group h-12 flex items-center font-sans">
    <button class="{{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none text-xs lg:text-sm font-bold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        About BACTA
        <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div class="absolute top-12 left-0 w-56 bg-[#27AE60] border border-green-600 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
        <a href="{{ Route::has('about') ? route('about') : '#' }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('about') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
            <i class="fa-solid fa-address-card text-green-200 text-sm w-4 flex justify-center"></i>
            About BACTA
        </a>
        
        <a href="{{ route('frontend.history.bacta') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('frontend.history.bacta') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
            <i class="fa-solid fa-book-atlas text-green-200 text-sm w-4 flex justify-center"></i>
            History of BACTA
        </a>        
    </div>
    </div>

<div class="relative group h-12 flex items-center font-sans">
    <button class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none text-xs lg:text-sm font-bold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        Governance & Membership
        <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div class="absolute top-12 left-0 w-60 bg-[#27AE60] border border-green-600 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
        <a href="{{ route('committee') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('committee') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
            <i class="fa-solid fa-users-rectangle text-green-200 text-sm w-4 flex justify-center"></i>
            Executive Committee
        </a>
        <a href="{{ route('members.lifetime') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('members.lifetime') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
            <i class="fa-solid fa-id-card-clip text-green-200 text-sm w-4 flex justify-center"></i>
            Life Members
        </a>
        <a href="{{ route('members.active') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('members.active') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
            <i class="fa-solid fa-user-doctor text-green-200 text-sm w-4 flex justify-center"></i>
            General Members
        </a>
        <div class="relative group/sub">
            <a href="#" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-white hover:bg-white/20 transition-all cursor-pointer">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-gear text-green-200 text-sm w-4 flex justify-center"></i>
                    <span>Associate Members</span>
                </div>
                <i class="fa-solid fa-chevron-right text-green-200/70 text-[10px] group-hover/sub:translate-x-0.5 transition-transform"></i>
            </a>
            <div class="absolute top-0 left-[238px] w-52 bg-[#219653] border border-green-700 rounded-xl shadow-2xl py-2 hidden group-hover/sub:block z-50">
                <a href="{{ route('members.active', ['category' => 'paramedics']) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white hover:bg-white/15 transition-all">
                    <i class="fa-solid fa-kit-medical text-green-200 text-xs"></i>
                    Paramedics
                </a>
                <a href="{{ route('members.active', ['category' => 'technicians']) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white hover:bg-white/15 transition-all">
                    <i class="fa-solid fa-microscope text-green-200 text-xs"></i>
                    Technicians
                </a>
                <a href="{{ route('members.active', ['category' => 'perfusionist']) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white hover:bg-white/15 transition-all">
                    <i class="fa-solid fa-mask-ventilator text-green-200 text-xs"></i>
                    Perfusionist
                </a>
            </div>
        </div>
    </div>
</div>
        <div class="relative group h-12 flex items-center">
            <button class="{{ (Route::is('president.message') || Route::is('minutes.list') || Route::is('notice.archive')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none text-xs lg:text-sm font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>News & Publications
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-12 left-0 w-60 bg-[#27AE60] border border-green-600 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
                <a href="{{ route('notice.archive') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('notice.archive') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Announcements
                </a>
                <a href="{{ route('president.message') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('president.message') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>President's Message
                </a>
                <a href="{{ route('minutes.list') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('minutes.list') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Executive Minutes
                </a>
            </div>
        </div>
        <div class="relative group h-12 flex items-center">
            <button class="{{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'text-[#0284C7]' : 'hover:text-[#0284C7]' }} flex items-center gap-1.5 transition-colors focus:outline-none text-xs lg:text-sm font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>Surgery Statistics
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-12 left-0 w-64 bg-[#27AE60] border border-green-600 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
                <a href="{{ route('frontend.surgeries.stats') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('frontend.surgeries.stats') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-[#0284C7]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>Overall Cardiac Surgery
                </a>
                <a href="{{ route('frontend.congenital.stats') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('frontend.congenital.stats') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>Congenital Heart Surgery
                </a>
                <a href="{{ route('frontend.valvular.stats') }}" class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold {{ Route::is('frontend.valvular.stats') ? 'text-white bg-white/20' : 'text-white hover:bg-white/20' }} transition-all">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>  Valvular Heart Surgery
                </a>
            </div>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="{{ Route::is('admin.gallery.index') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'text-slate-700 hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-colors text-xs lg:text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Events & Gallery
        </a>
        <a href="{{ route('journals.archive') }}" class="{{ Route::is('journals.archive') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'text-slate-700 hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-all text-xs lg:text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Journals (BACTA)
        </a>
        <a href="{{ route('contact.archive') }}" class="{{ Route::is('contact.archive') ? 'text-[#0284C7] border-b-2 border-[#0284C7]' : 'text-slate-700 hover:text-[#0284C7]' }} h-12 flex items-center gap-1.5 transition-colors text-xs lg:text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>Contact
        </a>        
    </div>
</div>

<div id="mobile-dropdown" class="hidden bg-white border-t border-slate-100 shadow-inner">
<div class="px-4 pt-4 pb-6 space-y-1 text-base font-medium font-sans">
    
    <form action="#" method="GET" class="relative mb-3 px-3">
        <input type="text" name="search" placeholder="Search here..." class="w-full pl-4 pr-10 py-2.5 text-sm border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:border-[#0284C7] focus:bg-white transition-all">
        <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </form>
    
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('home') ? 'text-[#0284C7] bg-sky-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
        <svg class="w-5 h-5 {{ Route::is('home') ? 'text-[#0284C7]' : 'text-slate-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Home
    </a>

<div class="border-t border-slate-100 pt-2 mt-1 font-sans">
    <button id="mobile-about-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'text-[#27AE60] bg-green-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <span class="text-base font-bold">About BACTA</span>
        </div>
        <svg id="about-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div id="mobile-about-box" class="hidden pl-4 pr-2 py-1 space-y-1 bg-green-50/50 rounded-xl mt-1 transition-all">
        
        <a href="{{ Route::has('about') ? route('about') : '#' }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('about') ? 'text-[#27AE60] font-bold' : 'text-slate-600 hover:text-[#27AE60]' }} text-sm transition-colors">
            <i class="fa-solid fa-address-card text-green-500 text-sm w-4 flex justify-center"></i>
            About BACTA
        </a>
        
        <a href="{{ route('frontend.history.bacta') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('frontend.history.bacta') ? 'text-[#27AE60] font-bold' : 'text-slate-600 hover:text-[#27AE60]' }} text-sm transition-colors">
            <i class="fa-solid fa-book-atlas text-green-500 text-sm w-4 flex justify-center"></i>
            History of BACTA
        </a>
        
    </div>
</div>

<div class="border-t border-slate-100 pt-2 mt-2 font-sans">
    <button id="mobile-submenu-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-[#0284C7] bg-sky-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span class="text-base font-bold">Governance & Membership</span>
        </div>
        <svg id="submenu-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300 {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div id="mobile-submenu-box" class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1 transition-all">
        
        <a href="{{ route('committee') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('committee') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <i class="fa-solid fa-users-rectangle text-[#0284C7] text-xs w-4 text-center"></i> Executive Committee
        </a>
        
        <a href="{{ route('members.lifetime') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('members.lifetime') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <i class="fa-solid fa-id-card-clip text-emerald-500 text-xs w-4 text-center"></i> Life Members
        </a>
        
        <a href="{{ route('members.active') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('members.active') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
            <i class="fa-solid fa-user-doctor text-blue-500 text-xs w-4 text-center"></i> General Members
        </a>
        <div class="w-full">
            <button id="mobile-associate-sub-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2 rounded-xl text-slate-600 hover:text-[#0284C7] text-sm transition-colors focus:outline-none">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-gear text-blue-500 text-xs w-4 text-center"></i>
                    <span>Associate Members</span>
                </div>
                <i id="associate-arrow-node" class="fa-solid fa-chevron-down text-slate-400 text-[10px] transition-transform duration-300"></i>
            </button>
            
            <div id="mobile-associate-sub-box" class="hidden pl-6 pr-2 py-1 space-y-1 bg-slate-100/40 rounded-xl mt-1 transition-all">
                <a href="{{ route('members.active', ['category' => 'paramedics']) }}" class="flex items-center gap-2 px-4 py-1.5 text-xs font-bold text-slate-600 hover:text-[#0284C7] transition-all">
                    <i class="fa-solid fa-kit-medical text-slate-400 text-[10px]"></i> Paramedics
                </a>
                <a href="{{ route('members.active', ['category' => 'technicians']) }}" class="flex items-center gap-2 px-4 py-1.5 text-xs font-bold text-slate-600 hover:text-[#0284C7] transition-all">
                    <i class="fa-solid fa-microscope text-slate-400 text-[10px]"></i> Technicians
                </a>
                <a href="{{ route('members.active', ['category' => 'perfusionist']) }}" class="flex items-center gap-2 px-4 py-1.5 text-xs font-bold text-slate-600 hover:text-[#0284C7] transition-all">
                    <i class="fa-solid fa-mask-ventilator text-slate-400 text-[10px]"></i> Perfusionist
                </a>
            </div>
        </div>
    </div>
</div>
        <div class="border-t border-slate-100 pt-2 mt-1">
            <button id="mobile-news-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('president.message') || Route::is('minutes.list') || Route::is('notice.archive')) ? 'text-[#0284C7] bg-sky-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-base font-bold">News & Publications</span>
                </div>
                <svg id="news-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300 {{ (Route::is('president.message') || Route::is('minutes.list') || Route::is('notice.archive')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="mobile-news-box" class="{{ (Route::is('president.message') || Route::is('minutes.list') || Route::is('notice.archive')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1 transition-all">
                <a href="{{ route('notice.archive') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('notice.archive') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Announcements
                </a>
                <a href="{{ route('president.message') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('president.message') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>President's Message
                </a>
                <a href="{{ route('minutes.list') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('minutes.list') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Executive Minutes
                </a>
            </div>
        </div>
       <div class="border-t border-slate-100 pt-2 mt-1">
            <button id="mobile-surgery-trigger" type="button" class="flex w-full items-center justify-between px-3 py-2.5 rounded-xl {{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'text-[#0284C7] bg-sky-50/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors focus:outline-none">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    <span class="text-base font-bold">Surgery Statistics</span>
                </div>
                <svg id="surgery-arrow" class="w-4 h-4 text-slate-400 transition-transform duration-300 {{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div id="mobile-surgery-box" class="{{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-slate-50/50 rounded-xl mt-1 transition-all">
                <a href="{{ route('frontend.surgeries.stats') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('frontend.surgeries.stats') ? 'text-[#0284C7] font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-[#0284C7]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>Overall Cardiac Surgery
                </a>
                <a href="{{ route('frontend.congenital.stats') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('frontend.congenital.stats') ? 'text-white bg-white/20 font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>    Congenital Heart Surgery
                </a>
                <a href="{{ route('frontend.valvular.stats') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl {{ Route::is('frontend.valvular.stats') ? 'text-white bg-white/20 font-bold' : 'text-slate-600 hover:text-[#0284C7]' }} text-sm transition-colors">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> Valvular Heart Surgery
                </a>
            </div>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('admin.gallery.index') ? 'text-white bg-white/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>Events & Gallery
        </a>
        <a href="{{ Route::has('journals.archive') ? route('journals.archive') : '#' }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('journals.archive') ? 'text-white bg-white/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>Journals (BACTA)
        </a>
        <a href="{{ route('contact.archive') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ Route::is('contact.archive') ? 'text-white bg-white/20 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>Contact
        </a>
    </div>
</div>               
            </div>
        </div>
    </nav>
<!-- =========================================================================
     👑 🔒 বিএসিটিএ মোবাইল কোর ড্রাইভার: আল্ট্রা-সেফ টগল এবং জিরো-ক্র্যাশ জাভাস্ক্রিপ্ট ইঞ্জিন ভাই
     ========================================================================= -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 🎯 ১. Governance & Membership মেইন প্যারেন্ট টগল নোড ভাই
        const govTrigger = document.getElementById('mobile-submenu-trigger');
        const govBox = document.getElementById('mobile-submenu-box');
        const govArrow = document.getElementById('submenu-arrow');
        
        if (govTrigger && govBox) {
            govTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                govBox.classList.toggle('hidden');
                if (govArrow) govArrow.classList.toggle('rotate-180');
            });
        }
        
        // 🎯 👑 ২. আপনার মেগা রikোয়ারমেন্ট: অ্যাসোসিয়েট মেম্বারসের ২য় লেয়ার অভ্যন্তরীণ কাস্টম সাব-টগল ইঞ্জিন ভাই
        const subTrigger = document.getElementById('mobile-associate-sub-trigger');
        const subBox = document.getElementById('mobile-associate-sub-box');
        const subArrow = document.getElementById('associate-arrow-node');
        
        if (subTrigger && subBox) {
            subTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // 🔒 ওয়ান-লাইন সেফগার্ড: প্যারেন্ট কলাপ্স বন্ধ হওয়া চিরতরে লক ভাই
                
                subBox.classList.toggle('hidden');
                if (subArrow) subArrow.classList.toggle('rotate-180');
            });
        }
        
        // 🎯 ৩. News & Publications মেইন প্যারেন্ট টগল নোড ভাই
        const newsTrigger = document.getElementById('mobile-news-trigger');
        const newsBox = document.getElementById('mobile-news-box');
        const newsArrow = document.getElementById('news-arrow');
        
        if (newsTrigger && newsBox) {
            newsTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                newsBox.classList.toggle('hidden');
                if (newsArrow) newsArrow.classList.toggle('rotate-180');
            });
        }

        // 🎯 ৪. National Surgical Registries মেইন প্যারেন্ট টগল নোড ভাই
        const surgeryTrigger = document.getElementById('mobile-surgery-trigger');
        const surgeryBox = document.getElementById('mobile-surgery-box');
        const surgeryArrow = document.getElementById('surgery-arrow');
        
        if (surgeryTrigger && surgeryBox) {
            surgeryTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                surgeryBox.classList.toggle('hidden');
                if (surgeryArrow) surgeryArrow.classList.toggle('rotate-180');
            });
        }
    });
</script>


    <main class="flex-grow relative">
        @if (session('success'))
            <div id="bacta-success-toast" class="fixed top-24 right-4 sm:right-8 z-[100] max-w-md bg-emerald-950 border border-emerald-500/30 p-4 rounded-2xl shadow-2xl shadow-emerald-950/20 flex items-start gap-3 animate-bounce">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 border border-emerald-500/40 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="space-y-0.5 pr-4">
                    <h5 class="text-sm font-black text-white tracking-tight">Submission Successful</h5>
                    <p class="text-emerald-400 text-xs font-semibold leading-relaxed">{{ session('success') }}</p>
                </div>
                <button onclick="closeBactaToast()" type="button" class="text-emerald-500 hover:text-white transition-colors focus:outline-none ml-auto -mt-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @yield('content')
    </main>
<footer class="w-full bg-[#F1F5F9] text-[#334155] py-4 border-t border-[#E2E8F0] mt-auto font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-3 text-[12px] font-medium">
        
        <div class="flex items-center space-x-1 text-[#475569]">
            <span class="font-semibold text-[#1E293B]">Copyright</span>
            <span>&copy;</span>
            <span class="font-semibold text-[#1E293B]">{{ date('Y') }}</span>
            <a href="{{ route('home') }}" class="font-bold text-[#0F172A] hover:text-[#0284C7] transition-colors ml-0.5">
                BACTA Bangladesh.
            </a>
        </div>       
        

        <div class="flex items-center text-[#64748B]">
            <span>Crafted with</span>
            <span class="text-red-500 mx-1 text-[11px] animate-pulse">❤️</span>
            <span class="mr-1">by</span>
            <a href="https://it.matrik.com.bd" target="_blank" rel="noopener noreferrer" class="font-bold text-[#0F172A] hover:text-[#0284C7] transition-colors tracking-wide">
                Matrik
            </a>
        </div>

    </div>
</footer>

    <button id="back-to-top-btn" type="button" class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-xl bg-[#0284C7] hover:bg-[#0369A1] text-white flex items-center justify-center shadow-lg shadow-sky-500/20 opacity-0 translate-y-10 scale-75 pointer-events-none transition-all duration-300 focus:outline-none">
        <svg class="w-5 h-5 font-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
        </svg>
    </button>
    <script>
        const mainNavbar = document.getElementById('main-header-navbar');
        const brandIdentityBlock = document.getElementById('brand-identity-block');
        const backToTopBtn = document.getElementById('back-to-top-btn');
    window.addEventListener('scroll', () => {
            const scrollValue = window.scrollY;
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
            if (scrollValue > 300) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-10', 'scale-75', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
                backToTopBtn.classList.add('opacity-0', 'translate-y-10', 'scale-75', 'pointer-events-none');
            }
        });
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
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

        const aboutTrigger = document.getElementById('mobile-about-trigger');
        const aboutBox = document.getElementById('mobile-about-box');
        const aboutArrow = document.getElementById('about-arrow');
        if (aboutTrigger && aboutBox && aboutArrow) {
            aboutTrigger.addEventListener('click', () => {
                aboutBox.classList.toggle('hidden');
                aboutArrow.classList.toggle('rotate-180');
            });
        }

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