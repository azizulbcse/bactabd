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
<body class="bg-gradient-to-br from-[#E0F2FE] via-[#F0FDFF] to-[#E8F8F5] text-[#0F172A] antialiased flex flex-col min-h-screen font-sans selection:bg-[#1A4B84] selection:text-white">
<div class="bg-gradient-to-r from-[#0F172A] via-[#1A4B84] to-[#0F172A] text-white text-xs py-1.5 border-b border-white/10 relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <span class="hidden sm:block text-slate-300 text-[10px] font-bold tracking-wider uppercase">
            🏥 Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists
        </span>
        <div class="flex items-center gap-3 ml-auto">
            {{-- Facebook --}}
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#1877F2]/20 hover:bg-[#1877F2] text-[#93C5FD] hover:text-white transition-all duration-300 border border-[#1877F2]/30 no-underline">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">Facebook</span>
            </a>
            
            {{-- WhatsApp --}}
            <a href="https://wa.me" target="_blank" rel="noopener noreferrer"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#25D366]/20 hover:bg-[#25D366] text-[#25D366] hover:text-white transition-all duration-300 border border-[#25D366]/30 no-underline">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">WhatsApp</span>
            </a>
            
            {{-- YouTube --}}
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer"
                class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#FF0000]/20 hover:bg-[#FF0000] text-[#FF0000] hover:text-white transition-all duration-300 border border-[#FF0000]/30 no-underline">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                <span class="text-[10px] font-bold hidden sm:block">YouTube</span>
            </a>
        </div>
    </div>
</div>

<style>
    /* 🎯 গ্লোবাল কাস্টম ফন্ট লকিং: ক্লায়েন্টের শর্ত অনুযায়ী Arial Rounded MT Bold ফন্ট ইঞ্জিন ভাই */
    .bacta-custom-nav-font { font-family: 'Arial Rounded MT Bold', 'Arial', sans-serif !important; }
</style>

<!-- 🚀 মেগা টপ হেডার পার্ট: রয়্যাল ব্লু ব্যাকগ্রাউন্ড এবং হোয়াইট ফন্ট ইঞ্জিন ভাই (হুবহু আপনার ১ম পার্ট) -->
<header class="w-full bg-[#1A4B84] text-white border-b border-white/10 font-sans py-3 md:py-4 transition-all relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-2.5">
        <div class="flex items-center gap-3 sm:gap-4 md:gap-5 w-full md:w-auto justify-start md:self-stretch">
            <a href="{{ route('home') }}" class="block shrink-0 md:self-stretch flex items-center h-auto md:h-full">
                <img src="{{ asset('images/logo.png') }}" class="h-16 sm:h-20 md:h-24 lg:h-28 xl:h-32 w-16 sm:w-20 md:w-24 lg:w-28 xl:w-32 object-cover rounded-full image-rendering-smooth block shadow-md ring-2 ring-white/20" alt="BACTA Logo">
            </a>
            
            <div class="flex flex-col justify-between text-left space-y-1 flex-grow min-w-0">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-wider text-[#93C5FD] leading-none uppercase m-0">BACTA</h1>
                <div class="text-red-500 my-0.5 flex items-center gap-0.5 animate-pulse shrink-0">
                    <svg class="h-5 w-auto" fill="none" viewBox="0 0 100 20" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M0,10 L30,10 L38,2 L46,18 L54,6 L60,13 L66,10 L100,10" />
                    </svg>
                </div>

                <p class="text-[12px] sm:text-sm md:text-base lg:text-lg xl:text-xl font-black tracking-wide text-[#93C5FD] leading-tight w-full break-words md:break-normal m-0">
                    Bangladesh Association of <br class="hidden sm:inline">
                    <span class="text-[#93C5FD]">Cardiovascular & Thoracic Anesthesiologists</span>
                </p>
            </div>
        </div>
        
        <div class="w-full md:w-auto md:flex-grow max-w-full md:max-w-xs mx-0 md:mx-4 mt-1 md:mt-0">
            <form action="#" method="GET" class="relative w-full">
                <input type="text" name="search" placeholder="Search" 
                       class="w-full bg-white/10 border border-white/30 rounded-md pl-4 pr-10 py-1.5 text-sm text-white placeholder-white/70 focus:outline-none focus:border-white focus:bg-white/20 transition-all">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="flex items-center gap-3 shrink-0 w-full md:w-auto justify-center md:justify-end mt-1 md:mt-0 border-t border-white/5 md:border-t-0 pt-3 md:pt-0">
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center border border-white/60 rounded-md px-4 py-1.5 text-xs sm:text-sm font-bold text-white bg-white/5 hover:bg-white/20 hover:border-white transition-all duration-300 no-underline whitespace-nowrap">
                Become a Member
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center border border-white/60 rounded-md px-4 py-1.5 text-xs sm:text-sm font-bold text-white bg-white/5 hover:bg-white/20 hover:border-white transition-all duration-300 no-underline whitespace-nowrap">
                Log In
            </a>
            {{-- 🍔 Mobile Hamburger Button --}}
            <button id="mobile-menu-button" type="button" class="md:hidden flex items-center justify-center w-9 h-9 rounded-lg bg-white/10 hover:bg-white/20 border border-white/30 text-white transition-all focus:outline-none" aria-label="Toggle menu">
                <svg id="hamburger-icon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div> 
</header>
<div class="hidden md:grid bg-[#2E5C90] border-t border-white/10 py-3 transition-all relative z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-6 gap-x-2 xl:gap-x-4 gap-y-2.5 text-center items-center text-xs lg:text-sm font-bold text-white whitespace-nowrap bacta-custom-nav-font w-full">
        <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Home
        </a>
        <div class="relative group h-10 flex items-center justify-center">
            <button class="{{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} flex items-center gap-1.5 transition-colors focus:outline-none focus:ring-0 font-bold">
                About BACTA
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-64 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover:block z-50 text-left">
                <a href="{{ Route::has('about') ? route('about') : '#' }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-200 no-underline">About BACTA</a>
                <a href="{{ route('frontend.history.bacta') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-200 no-underline">History of BACTA</a>        
            </div>
        </div>
        <div class="relative group h-10 flex items-center justify-center">
            <button class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} flex items-center gap-1.5 transition-colors focus:outline-none focus:ring-0 font-bold">
                Governance & Membership
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-68 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover:block z-50 text-left">        
                <a href="{{ route('committee') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Executive Committee</a>
                <a href="{{ route('members.lifetime') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Life Members</a>
                <a href="{{ route('members.active') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">General Members</a>
                <div class="relative group/sub">
                    <a href="#" class="flex items-center justify-between px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline cursor-pointer">
                        <span>Associate Members</span>
                        <svg class="w-3 h-3 text-white/80 group-hover/sub:text-black transition-colors duration-150" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    {{-- invisible bridge to prevent hover gap --}}
                    <div class="absolute top-0 right-0 w-4 h-full hidden group-hover/sub:block z-40"></div>
                    <div class="absolute top-0 left-full w-48 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover/sub:block z-50 text-left">
                        <a href="{{ route('members.active', ['category' => 'paramedics']) }}" class="block px-5 py-2.5 text-xs font-bold text-white hover:text-black transition-colors duration-150 no-underline">Paramedics</a>
                        <a href="{{ route('members.active', ['category' => 'technicians']) }}" class="block px-5 py-2.5 text-xs font-bold text-white hover:text-black transition-colors duration-150 no-underline">Technicians</a>
                        <a href="{{ route('members.active', ['category' => 'perfusionist']) }}" class="block px-5 py-2.5 text-xs font-bold text-white hover:text-black transition-colors duration-150 no-underline">Perfusionist</a>
                    </div>
                </div>        
            </div>
        </div>
        <a href="{{ route('notice.archive') }}" class="{{ Route::is('notice.archive') ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            News & Events
        </a>       
        <div class="relative group h-10 flex items-center justify-center">
            <button class="text-white hover:text-cyan-200 flex items-center gap-1.5 transition-colors focus:outline-none focus:ring-0 font-bold">
                Cardiac Anesthesia
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-64 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover:block z-50 text-left">
                <a href="#" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Pre-Anesthesia checkup</a>
                <a href="#" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Anesthesia</a>
                <a href="#" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">CardioThoracic ICU</a>
            </div>
        </div>

        <div class="relative group h-10 flex items-center justify-center">
            <button class="{{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} flex items-center gap-1.5 transition-colors focus:outline-none focus:ring-0 font-bold">
                Cardiac Surgery
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-64 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover:block z-50 text-left">
                <a href="{{ route('frontend.surgeries.stats') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Overall Cardiac Surgery</a>
                <a href="{{ route('frontend.congenital.stats') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Congenital Heart Surgery</a>
                <a href="{{ route('frontend.valvular.stats') }}" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Valvular Heart Surgery</a>        
            </div>
        </div>

        <a href="{{ route('frontend.cardiology') }}" class="{{ Route::is('frontend.cardiology') ? 'text-white border-b-2 border-white font-bold' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Cardiology
        </a>

        <div class="relative group h-10 flex items-center justify-center font-sans">
            <button class="text-white hover:text-cyan-200 flex items-center gap-1.5 transition-colors focus:outline-none focus:ring-0 font-bold">
                Echocardiography
                <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute top-10 left-1/2 -translate-x-1/2 w-52 bg-[#00ADB5] border border-cyan-600 rounded-xl shadow-2xl py-2 hidden group-hover:block z-50 text-left">
                <a href="#" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">TTE</a>
                <a href="#" class="block px-5 py-2.5 text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">TOE</a>
            </div>
        </div>
        <a href="{{ route('frontend.journals.index') }}" class="{{ Route::is('frontend.journals.index') ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Journals & Publication
        </a>

        <a href="{{ route('frontend.education.research') }}" class="{{ Route::is('frontend.education.research') ? 'text-white border-b-2 border-white font-bold' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Education & Research
        </a>

        <a href="{{ route('frontend.gallery.index') }}" class="{{ Route::is('frontend.gallery.index') ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Gallery
        </a>

        <a href="{{ route('contact.archive') }}" class="{{ Route::is('contact.archive') ? 'text-white border-b-2 border-white' : 'text-white hover:text-cyan-200' }} h-10 flex items-center justify-center transition-all no-underline">
            Contact Us
        </a>

    </div>
</div>

<div id="mobile-dropdown" class="hidden md:hidden border-t border-white/10 pt-3 pb-6 space-y-1 text-base font-medium bg-[#2E5C90] w-full bacta-custom-nav-font">    
    <form action="#" method="GET" class="relative mb-4 px-3">
        <input type="text" name="search" placeholder="Search" class="w-full bg-white/10 border border-white/20 rounded-md pl-4 pr-10 py-1.5 text-sm text-white placeholder-white/50 focus:outline-none focus:border-white/50 focus:bg-white/15 transition-all">
        <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-white/60">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </button>
    </form>
    
    <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('home') ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors no-underline">
        Home
    </a>

<div class="border-t border-white/10 pt-1">
    <button id="mobile-about-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2.5 rounded-xl {{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors focus:outline-none">
        <span class="text-base font-semibold">About BACTA</span>
        <svg id="about-arrow" class="w-4 h-4 text-white/60 transition-transform duration-300 {{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div id="mobile-about-box" class="{{ (Route::is('about') || Route::is('frontend.history.bacta')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-[#00ADB5] rounded-xl mt-1 transition-all">
        <a href="{{ route('about') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">About BACTA</a>
        <a href="{{ route('frontend.history.bacta') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">History of BACTA</a>
    </div>
</div>


    <div class="border-t border-white/10 pt-1">
        <button id="mobile-submenu-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2.5 rounded-xl {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors focus:outline-none">
            <span class="text-base font-semibold">Governance & Membership</span>
            <svg id="submenu-arrow" class="w-4 h-4 text-white/60 transition-transform duration-300 {{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="mobile-submenu-box" class="{{ (Route::is('committee') || Route::is('members.lifetime') || Route::is('members.active')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-[#00ADB5] rounded-xl mt-1 transition-all">
            <a href="{{ route('committee') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Executive Committee</a>
            <a href="{{ route('members.lifetime') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Life Members</a>
            <a href="{{ route('members.active') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">General Members</a>
            
            <div class="w-full border-t border-white/20 pt-1">
                <button id="mobile-associate-sub-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2 rounded-lg text-white hover:text-black text-sm font-bold transition-colors focus:outline-none">
                    <span>Associate Members</span>
                    <i id="associate-arrow-node" class="fa-solid fa-chevron-down text-white/80 text-[10px] transition-transform duration-300"></i>
                </button>
                <div id="mobile-associate-sub-box" class="hidden pl-4 pr-2 py-1 space-y-1 bg-[#3B7DC4]/40 rounded-lg mt-1 transition-all">
                    <a href="{{ route('members.active', ['category' => 'paramedics']) }}" class="block px-4 py-1.5 text-xs font-bold text-white hover:text-black transition-colors no-underline">Paramedics</a>
                    <a href="{{ route('members.active', ['category' => 'technicians']) }}" class="block px-4 py-1.5 text-xs font-bold text-white hover:text-black transition-colors no-underline">Technicians</a>
                    <a href="{{ route('members.active', ['category' => 'perfusionist']) }}" class="block px-4 py-1.5 text-xs font-bold text-white hover:text-black transition-colors no-underline">Perfusionist</a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 pt-1">
        <a href="{{ route('notice.archive') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('notice.archive') ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors no-underline">
            News & Events
        </a>
    </div>
    
    <div class="border-t border-white/10 pt-1">
        <button id="mobile-anesthesia-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2.5 rounded-xl text-white/85 hover:bg-white/10 transition-colors focus:outline-none">
            <span class="text-base font-semibold">Cardiac Anesthesia</span>
            <svg id="anesthesia-arrow" class="w-4 h-4 text-white/60 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="mobile-anesthesia-box" class="hidden pl-4 pr-2 py-1 space-y-1 bg-[#00ADB5] rounded-xl mt-1 transition-all">
            <a href="#" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Pre-Anesthesia checkup</a>
            <a href="#" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Anesthesia</a>
            <a href="#" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">CardioThoracic ICU</a>
        </div>
    </div>

    <div class="border-t border-white/10 pt-1">
        <button id="mobile-surgery-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2.5 rounded-xl {{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors focus:outline-none">
            <span class="text-base font-semibold">Cardiac Surgery</span>
            <svg id="surgery-arrow" class="w-4 h-4 text-white/60 transition-transform duration-300 {{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="mobile-surgery-box" class="{{ (Route::is('frontend.surgeries.stats') || Route::is('frontend.congenital.stats') || Route::is('frontend.valvular.stats')) ? 'block' : 'hidden' }} pl-4 pr-2 py-1 space-y-1 bg-[#00ADB5] rounded-xl mt-1 transition-all">
            <a href="{{ route('frontend.surgeries.stats') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Overall Cardiac Surgery</a>
            <a href="{{ route('frontend.congenital.stats') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">Congenital Heart Surgery</a>
            <a href="{{ route('frontend.valvular.stats') }}" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors duration-150 no-underline">Valvular Heart Surgery</a>
        </div>
    </div>

    <div class="border-t border-slate-100 pt-1">
            <a href="{{ route('frontend.cardiology') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('frontend.cardiology') ? 'text-[#0284C7] bg-sky-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors no-underline">
            Cardiology
            </a>
    </div>
    
    <div class="border-t border-white/10 pt-1">
        <button id="mobile-echo-trigger" type="button" class="flex w-full items-center justify-between px-4 py-2.5 rounded-xl text-white/85 hover:bg-white/10 transition-colors focus:outline-none">
            <span class="text-base font-semibold">Echocardiography</span>
            <svg id="echo-arrow" class="w-4 h-4 text-white/60 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div id="mobile-echo-box" class="hidden pl-4 pr-2 py-1 space-y-1 bg-[#00ADB5] rounded-xl mt-1 transition-all">
            <a href="#" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">TTE</a>
            <a href="#" class="block px-4 py-2 rounded-lg text-sm font-bold text-white hover:text-black transition-colors no-underline">TOE</a>
        </div>
    </div>
    
    <div class="border-t border-white/10 pt-1">
        <a href="{{ route('frontend.journals.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('frontend.journals.index') ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors no-underline">
            Journals & Publication
        </a>
    </div>
    
<div class="border-t border-slate-100 pt-1">
    <a href="{{ route('frontend.education.research') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('frontend.education.research') ? 'text-[#0284C7] bg-sky-50 font-bold' : 'text-slate-700 hover:bg-slate-50' }} transition-colors no-underline">
        Education & Research
    </a>
</div>

    
    <div class="border-t border-white/10 pt-1">
        <a href="{{ route('frontend.gallery.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('admin.gallery.index') ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors no-underline">
            Gallery
        </a>
    </div>
    
    <div class="border-t border-white/10 pt-1">
        <a href="{{ route('contact.archive') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl {{ Route::is('contact.archive') ? 'text-white border-b-2 border-white font-semibold' : 'text-white/85 hover:bg-white/10' }} transition-colors no-underline">
            Contact Us
        </a>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {        
        function setupMobileAccordionToggle(triggerId, boxId, arrowId) {
            let trigger = document.getElementById(triggerId);
            let box = document.getElementById(boxId);
            let arrow = document.getElementById(arrowId);
            
            if (trigger && box) {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    box.classList.toggle('hidden');
                    if (arrow) arrow.classList.toggle('rotate-180');
                });
            }
        }
        // ১. About BACTA মোবাইল টগল ওয়ান-ক্লিক রান ভাই
        setupMobileAccordionToggle('mobile-about-trigger', 'mobile-about-box', 'about-arrow');
        
        // ২. Governance & Membership মেইন টগল রান ভাই
        setupMobileAccordionToggle('mobile-submenu-trigger', 'mobile-submenu-box', 'submenu-arrow');
        
        // ৩. 👑 ২য় লেয়ার এসোসিয়েট সাব-টগল ওয়ান-লাইন ড্রাইভার ভাই
        let subTrigger = document.getElementById('mobile-associate-sub-trigger');
        let subBox = document.getElementById('mobile-associate-sub-box');
        let subArrow = document.getElementById('associate-arrow-node');
        if (subTrigger && subBox) {
            subTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // 🔒 প্যারেন্ট বক্স কলাপ্স হওয়া ওয়ান-লাইনে টাইট লক ভাই
                subBox.classList.toggle('hidden');
                if (subArrow) subArrow.classList.toggle('rotate-180');
            });
        }

        // ৪. Cardiac Anesthesia নতুন মেগা মোবাইল টগল রান ভাই
        setupMobileAccordionToggle('mobile-anesthesia-trigger', 'mobile-anesthesia-box', 'anesthesia-arrow');

        // ৫. Cardiac Surgery ৩-ট্র্যাক মেগা মোবাইল টগল রান ভাই
        setupMobileAccordionToggle('mobile-surgery-trigger', 'mobile-surgery-box', 'surgery-arrow');

        // ৬. Echocardiography নতুন মেগা মোবাইল টগল রান ভাই
        setupMobileAccordionToggle('mobile-echo-trigger', 'mobile-echo-box', 'echo-arrow');
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
{{-- ===== CONTACT SECTION ===== --}}
<section class="w-full bg-gradient-to-br from-[#EBF8FF] via-[#F0FDFF] to-[#E0F2FE] text-[#0F172A] py-14 mt-auto border-t border-[#CFEAF5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-black text-[#1A4B84] mb-2 tracking-wide">Contact</h2>
        <div class="border-t border-[#B8DCEE] mb-8"></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            {{-- Col 1: Address --}}
            <div>
                <p class="font-black text-[#0F172A] text-base mb-3 tracking-wide">Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists</p>
                <address class="not-italic text-slate-600 text-sm leading-relaxed space-y-1">
                    <p>House 15, Road 6, Block C</p>
                    <p>Banani, Dhaka 1213</p>
                    <p>Bangladesh</p>
                </address>
                <div class="mt-4 space-y-1 text-sm text-slate-600">
                    <p><span class="font-bold text-[#0F172A]">Email:</span> info@bacta.org.bd</p>
                    <p><span class="font-bold text-[#0F172A]">Phone:</span> +880-2-XXXXXXXX</p>
                </div>
            </div>

            {{-- Col 2: Office Hours --}}
            <div>
                <a href="{{ route('contact.archive') }}"
                   class="inline-block bg-[#00ADB5] hover:bg-[#0097A7] text-white font-bold px-7 py-3 rounded-lg mb-5 transition-all duration-300 no-underline text-sm shadow-lg shadow-cyan-900/10">
                    Contact us
                </a>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Our office is open<br>
                    <span class="text-[#0F172A] font-semibold">Monday – Friday, 9:00 am – 5:00 pm</span>
                </p>
                <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                    Please quote your membership ID when contacting us.
                </p>
            </div>

            {{-- Col 3: Follow Us + Links --}}
            <div>
                <h3 class="text-lg font-black text-[#1A4B84] mb-3 tracking-wide">Follow us</h3>
                <div class="border-t border-[#B8DCEE] mb-4"></div>
                <div class="flex items-center gap-4 mb-5">
                    {{-- Facebook --}}
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="text-[#1A4B84] hover:text-[#00ADB5] transition-colors" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    {{-- WhatsApp --}}
                    <a href="https://wa.me" target="_blank" rel="noopener noreferrer" class="text-[#1A4B84] hover:text-[#00ADB5] transition-colors" aria-label="WhatsApp">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    {{-- YouTube --}}
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="text-[#1A4B84] hover:text-[#00ADB5] transition-colors" aria-label="YouTube">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-[#00ADB5] hover:text-[#1A4B84] transition-colors font-semibold no-underline">Privacy policy</a></li>
                    <li><a href="#" class="text-[#00ADB5] hover:text-[#1A4B84] transition-colors font-semibold no-underline">Terms and conditions</a></li>
                    <li><a href="{{ route('contact.archive') }}" class="text-[#00ADB5] hover:text-[#1A4B84] transition-colors font-semibold no-underline">Contact us</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- ===== END CONTACT SECTION ===== --}}

<footer class="w-full bg-[#F1F5F9] text-[#334155] py-4 border-t border-[#E2E8F0] font-sans">
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
            <a href="https://www.facebook.com/fringebytetech" target="_blank" rel="noopener noreferrer" class="font-bold text-[#0F172A] hover:text-[#0284C7] transition-colors tracking-wide">
                FringeByte Technologies
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
                    if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                    if (closeIcon) closeIcon.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                    if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                }
            });
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { 
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
                const subBoxResize = document.getElementById('mobile-submenu-box');
                const subArrowResize = document.getElementById('submenu-arrow');
                if (subBoxResize && subArrowResize) {
                    subBoxResize.classList.add('hidden');
                    subArrowResize.classList.remove('rotate-180');
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