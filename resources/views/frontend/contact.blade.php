@extends('layouts.app')

@section('title', 'Contact Us | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
    @keyframes metricShake { 0%,100%{transform:translateX(0)} 20%,60%{transform:translateX(-5px)} 40%,80%{transform:translateX(5px)} }
</style>

    {{-- HEADER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Get In Touch</span>
                <h1 class="text-3xl lg:text-4xl font-semibold tracking-tight text-[#0F172A]">Contact Secretariat</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">Contact Us</span>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <section class="py-14" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">

                {{-- LEFT: Info column --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-7 space-y-6">

                        <div class="pb-5 border-b border-[#CFEAF5]">
                            <h3 class="text-base font-semibold text-[#0F172A] tracking-tight">Official Secretariat</h3>
                            <p class="text-xs text-slate-400 mt-1">Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists</p>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 border border-[#CFEAF5] flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-building-columns text-[#0284C7] text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Office Secretariat</p>
                                <p class="text-xs text-slate-500 leading-relaxed">Department of Cardiac Anesthesia</p>
                                <p class="text-xs font-semibold text-slate-800">National Heart Foundation Hospital</p>
                                <p class="text-xs text-slate-500">Mirpur-2, Dhaka-1216, Bangladesh</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 border border-[#CFEAF5] flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-phone-volume text-[#0284C7] text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Official Hotline</p>
                                <p class="text-xs font-semibold text-slate-800">+880 2-58051351-3</p>
                                <p class="text-[10px] text-slate-400 mt-1"><i class="far fa-clock mr-1"></i>Sat to Thu: 09:00 AM – 05:00 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 border border-[#CFEAF5] flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-envelope-open-text text-[#0284C7] text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Email</p>
                                <p class="text-xs font-semibold text-[#0284C7]">info@bactabd.org</p>
                                <p class="text-[10px] text-slate-400 mt-1"><i class="fas fa-shield-alt mr-1"></i>24/7 Secure Network</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- RIGHT: Form column --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-7">

                        @if(session('success'))
                            <div id="contactSuccessBanner" class="flex items-center gap-3 bg-emerald-500 text-white text-xs font-medium px-4 py-3 rounded-xl mb-6 shadow-sm transition-all duration-500">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        <form id="bactaContactForm" action="{{ route('contact.store') }}" method="POST" novalidate>
                            @csrf

                            {{-- Honeypot --}}
                            <div class="hidden">
                                <input type="text" name="bacta_security_verification_field" id="bactaSecurityField" autocomplete="off" tabindex="-1">
                            </div>

                            {{-- Name + Email --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-500 mb-1.5">
                                        <i class="fas fa-user-md mr-1 text-slate-300"></i> Full Name
                                    </label>
                                    <input type="text" id="contactName" name="name"
                                        class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                        placeholder="Prof. / Dr. Your Name">
                                    <p id="nameErrorNode" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Name cannot be blank!</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-500 mb-1.5">
                                        <i class="fas fa-envelope mr-1 text-slate-300"></i> Email Address
                                    </label>
                                    <input type="email" id="contactEmail" name="email"
                                        class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                        placeholder="yourname@gmail.com">
                                    <p id="emailErrorNode" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Enter a valid email!</p>
                                </div>
                            </div>

                            {{-- Mobile --}}
                            <div class="mb-4">
                                <label class="block text-xs font-medium text-slate-500 mb-1.5">
                                    <i class="fas fa-mobile-alt mr-1 text-slate-300"></i> Mobile Number
                                </label>
                                <input type="text" id="contactMobile" name="mobile" maxlength="11"
                                    class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                    placeholder="e.g., 01712345678">
                                <p id="mobileErrorNode" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Enter a valid 11-digit number!</p>
                            </div>

                            {{-- Message --}}
                            <div class="mb-5">
                                <label class="block text-xs font-medium text-slate-500 mb-1.5">
                                    <i class="fas fa-comment-alt mr-1 text-slate-300"></i> Message
                                </label>
                                <textarea id="contactMessage" name="message" rows="4"
                                    class="w-full bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 py-3 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all resize-none placeholder-slate-300"
                                    placeholder="Type your query or message here..."></textarea>
                                <p id="messageErrorNode" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Message cannot be empty!</p>
                            </div>

                            {{-- Submit --}}
                            <button type="button" onclick="validateAndSendFeedback()"
                                class="w-full h-11 bg-gradient-to-r from-[#0284C7] to-[#1A4B84] hover:opacity-90 text-white text-sm font-medium rounded-xl flex items-center justify-center gap-2 transition-all shadow-sm shadow-sky-200 cursor-pointer border-0">
                                <i class="fas fa-paper-plane text-xs"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

<script>
    function validateAndSendFeedback() {
        const nameInput    = document.getElementById('contactName');
        const emailInput   = document.getElementById('contactEmail');
        const mobileInput  = document.getElementById('contactMobile');
        const messageInput = document.getElementById('contactMessage');
        const honeypot     = document.getElementById('bactaSecurityField');
        const form         = document.getElementById('bactaContactForm');

        const fields = [nameInput, emailInput, mobileInput, messageInput];
        const errors = ['nameErrorNode','emailErrorNode','mobileErrorNode','messageErrorNode'];

        errors.forEach(id => { document.getElementById(id).classList.add('hidden'); });
        fields.forEach(f => { f.classList.remove('border-red-400','bg-red-50'); f.classList.add('border-[#CFEAF5]','bg-[#F8FBFF]'); });

        if (honeypot.value.trim() !== '') return;

        let isValid = true;

        function shake(el, errorId) {
            el.classList.add('border-red-400','bg-red-50');
            el.classList.remove('border-[#CFEAF5]','bg-[#F8FBFF]');
            document.getElementById(errorId).classList.remove('hidden');
            el.style.animation = 'metricShake 0.4s ease-in-out';
            setTimeout(() => el.style.animation = '', 420);
            isValid = false;
        }

        if (!nameInput.value.trim())                                           shake(nameInput,   'nameErrorNode');
        if (!emailInput.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) shake(emailInput, 'emailErrorNode');
        if (!/^01[3-9]\d{8}$/.test(mobileInput.value.trim()))                 shake(mobileInput, 'mobileErrorNode');
        if (!messageInput.value.trim())                                        shake(messageInput,'messageErrorNode');

        if (isValid) form.submit();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const banner = document.getElementById('contactSuccessBanner');
        if (banner) {
            setTimeout(() => {
                banner.style.opacity = '0'; banner.style.transform = 'translateY(-10px)';
                setTimeout(() => banner.remove(), 500);
            }, 3000);
        }
    });
</script>

@endsection