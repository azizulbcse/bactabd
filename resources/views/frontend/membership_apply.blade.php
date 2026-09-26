@extends('layouts.app')

@section('title', 'Apply for Membership | BACTA Bangladesh')

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
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Join BACTA</span>
                <h1 class="text-3xl lg:text-4xl font-semibold tracking-tight text-[#0F172A]">Apply for Membership</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">Apply for Membership</span>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <section class="py-14" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm p-7">

                <div class="mb-6 pb-5 border-b border-[#CFEAF5] text-center">
                    <h3 class="text-base font-semibold text-[#0F172A] tracking-tight">Membership Application Form</h3>
                    <p class="text-xs text-slate-400 mt-1">Fill in your details below — our secretariat will review your application and get in touch with you.</p>
                </div>

                @if(session('success'))
                    <div id="membershipSuccessBanner" class="flex items-center gap-3 bg-emerald-500 text-white text-xs font-medium px-4 py-3 rounded-xl mb-6 shadow-sm transition-all duration-500">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form id="bactaMembershipForm" action="{{ route('membership.apply.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- Honeypot --}}
                    <div class="hidden">
                        <input type="text" name="bacta_security_verification_field" id="membershipSecurityField" autocomplete="off" tabindex="-1">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-user-md mr-1 text-slate-300"></i> Full Name</label>
                            <input type="text" id="mName" name="name" value="{{ old('name') }}"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                placeholder="Prof. / Dr. Your Name">
                            <p id="mNameError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Name cannot be blank!</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-envelope mr-1 text-slate-300"></i> Email Address</label>
                            <input type="email" id="mEmail" name="email" value="{{ old('email') }}"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                placeholder="yourname@gmail.com">
                            <p id="mEmailError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Enter a valid email!</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-mobile-alt mr-1 text-slate-300"></i> Mobile Number</label>
                            <input type="text" id="mMobile" name="mobile_no" maxlength="11" value="{{ old('mobile_no') }}"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                placeholder="e.g., 01712345678">
                            <p id="mMobileError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Enter a valid 11-digit number!</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-id-card mr-1 text-slate-300"></i> BMDC Registration No.</label>
                            <input type="text" id="mBmdc" name="bmdc_reg_no" value="{{ old('bmdc_reg_no') }}"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all placeholder-slate-300"
                                placeholder="e.g., A-12345">
                            <p id="mBmdcError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> BMDC registration number is required!</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-user-graduate mr-1 text-slate-300"></i> Designation</label>
                            <select id="mDesignation" name="designation"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all">
                                <option value="">Select designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->title }}" {{ old('designation') == $designation->title ? 'selected' : '' }}>{{ $designation->title }}</option>
                                @endforeach
                            </select>
                            <p id="mDesignationError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Please select a designation!</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-id-badge mr-1 text-slate-300"></i> Membership Type</label>
                            <select id="mMemberType" name="member_type"
                                class="w-full h-10 bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all">
                                <option value="">Select type</option>
                                <option value="Lifetime" {{ old('member_type') == 'Lifetime' ? 'selected' : '' }}>Lifetime</option>
                                <option value="Active" {{ old('member_type') == 'Active' ? 'selected' : '' }}>Active</option>
                            </select>
                            <p id="mMemberTypeError" class="hidden text-red-500 text-[11px] mt-1 flex items-center gap-1"><i class="fas fa-exclamation-triangle"></i> Please select a membership type!</p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-medium text-slate-500 mb-1.5"><i class="fas fa-comment-alt mr-1 text-slate-300"></i> Message (optional)</label>
                        <textarea id="mMessage" name="message" rows="3" maxlength="2000"
                            class="w-full bg-[#F8FBFF] border border-[#CFEAF5] rounded-xl px-3.5 py-3 text-sm text-slate-800 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all resize-none placeholder-slate-300"
                            placeholder="Anything you'd like the secretariat to know...">{{ old('message') }}</textarea>
                    </div>

                    <button type="button" onclick="validateAndSubmitMembership()"
                        class="w-full h-11 bg-gradient-to-r from-[#0284C7] to-[#1A4B84] hover:opacity-90 text-white text-sm font-medium rounded-xl flex items-center justify-center gap-2 transition-all shadow-sm shadow-sky-200 cursor-pointer border-0">
                        <i class="fas fa-paper-plane text-xs"></i> Submit Application
                    </button>
                    <p class="text-[11px] text-slate-400 text-center mt-3">
                        <i class="fas fa-shield-alt mr-1"></i> This only submits an application for review — it does not create a login account.
                    </p>
                </form>
            </div>
        </div>
    </section>

<script>
    function validateAndSubmitMembership() {
        const nameInput        = document.getElementById('mName');
        const emailInput       = document.getElementById('mEmail');
        const mobileInput      = document.getElementById('mMobile');
        const bmdcInput        = document.getElementById('mBmdc');
        const designationInput = document.getElementById('mDesignation');
        const memberTypeInput  = document.getElementById('mMemberType');
        const honeypot         = document.getElementById('membershipSecurityField');
        const form             = document.getElementById('bactaMembershipForm');

        const fields = [nameInput, emailInput, mobileInput, bmdcInput, designationInput, memberTypeInput];
        const errors = ['mNameError', 'mEmailError', 'mMobileError', 'mBmdcError', 'mDesignationError', 'mMemberTypeError'];

        errors.forEach(id => { document.getElementById(id).classList.add('hidden'); });
        fields.forEach(f => { f.classList.remove('border-red-400', 'bg-red-50'); f.classList.add('border-[#CFEAF5]', 'bg-[#F8FBFF]'); });

        if (honeypot.value.trim() !== '') return;

        let isValid = true;

        function shake(el, errorId) {
            el.classList.add('border-red-400', 'bg-red-50');
            el.classList.remove('border-[#CFEAF5]', 'bg-[#F8FBFF]');
            document.getElementById(errorId).classList.remove('hidden');
            el.style.animation = 'metricShake 0.4s ease-in-out';
            setTimeout(() => el.style.animation = '', 420);
            isValid = false;
        }

        if (!nameInput.value.trim())                                                         shake(nameInput, 'mNameError');
        if (!emailInput.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) shake(emailInput, 'mEmailError');
        if (!/^01[3-9]\d{8}$/.test(mobileInput.value.trim()))                                  shake(mobileInput, 'mMobileError');
        if (!bmdcInput.value.trim())                                                           shake(bmdcInput, 'mBmdcError');
        if (!designationInput.value)                                                           shake(designationInput, 'mDesignationError');
        if (!memberTypeInput.value)                                                            shake(memberTypeInput, 'mMemberTypeError');

        if (isValid) form.submit();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const banner = document.getElementById('membershipSuccessBanner');
        if (banner) {
            setTimeout(() => {
                banner.style.opacity = '0'; banner.style.transform = 'translateY(-10px)';
                setTimeout(() => banner.remove(), 500);
            }, 4000);
        }
    });
</script>

@endsection
