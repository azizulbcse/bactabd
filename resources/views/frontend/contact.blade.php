@extends('layouts.app')

@section('title', 'Contact Us | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-2">Get In Touch</span>
            <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Contact Secretariat</h1>
        </div>
        <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-200">Contact Us</span>
        </div>
    </div>
</header>

<style>
    .contact-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 60px 0; }
    .contact-container { width: 100%; max-width: 1140px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
    .contact-split-grid { display: flex; gap: 40px; align-items: flex-start; width: 100%; }
    .contact-info-column { width: 40%; flex-shrink: 0; }
    .contact-form-column { width: 60%; flex-grow: 1; }
    .contact-premium-card { background: #ffffff; border-radius: 16px; padding: 40px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.03); box-sizing: border-box; position: relative; }
    .info-node-item { display: flex; gap: 20px; margin-bottom: 30px; align-items: flex-start; }
    .info-icon-box { width: 48px; height: 48px; background: #EFF6FF; color: #0284C7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; border: 1px solid #DBEAFE; }
    .info-text-box h4 { margin: 0 0 4px 0; font-size: 15px; font-weight: 700; color: #0F172A; text-transform: uppercase; letter-spacing: 0.3px; }
    .info-text-box p { margin: 0; font-size: 13.5px; color: #475569; line-height: 1.6; font-weight: 500; }
    @keyframes metricShake { 0%, 100% { transform: translateX(0); } 20%, 60% { transform: translateX(-5px); } 40%, 80% { transform: translateX(5px); } }
    @media (max-width: 991px) { .contact-split-grid { flex-direction: column; } .contact-info-column, .contact-form-column { width: 100%; } .contact-premium-card { padding: 30px; } }
</style>
<div class="contact-body-wrapper">
    <div class="contact-container">
        <div class="contact-split-grid">
            <div class="contact-info-column">
                <div class="contact-premium-card" style="background: linear-gradient(135deg, #ffffff 0%, #F8FAFC 100%);">
                    <div style="margin-bottom: 35px; border-bottom: 2px solid #E2E8F0; padding-bottom: 15px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: #0284C7; margin: 0 0 5px 0; text-transform: uppercase; letter-spacing: 0.5px;">Official Secretariat</h3>
                        <p style="color: #64748B; font-size: 12px; margin: 0; font-weight: 500;">Bangladesh Advanced Cardiovascular Track Association</p>
                    </div>
                    <div class="info-node-item">
                        <div class="info-icon-box"><i class="fa-solid fa-building-columns"></i></div>
                        <div class="info-text-box">
                            <h4>Office Secretariat</h4>
                            <p>Department of Cardiac Anesthesia</p>
                            <p style="color: #0F172A; font-weight: 700;">National Heart Foundation Hospital</p>
                            <p>Mirpur-2, Dhaka-1216, Bangladesh</p>
                        </div>
                    </div>
                    <div class="info-node-item">
                        <div class="info-icon-box"><i class="fa-solid fa-phone-volume"></i></div>
                        <div class="info-text-box">
                            <h4>Official Hotline</h4>
                            <p>+880 2-58051351-3</p>
                            <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;"><i class="far fa-clock"></i> Sat to Thu: 09:00 AM - 05:00 PM</p>
                        </div>
                    </div>
                    <div class="info-node-item" style="margin-bottom: 0;">
                        <div class="info-icon-box"><i class="fa-solid fa-envelope-open-text"></i></div>
                        <div class="info-text-box">
                            <h4>Email Communication</h4>
                            <p style="color: #0284C7; font-weight: 600;">info@bactabd.org</p>
                            <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;"><i class="fas fa-shield-alt"></i> 24/7 Secure Network Gate</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form-column">
                <div class="contact-premium-card">
                    @if(session('success'))
                        <div id="contactSuccessBanner" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #ffffff; padding: 14px 18px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2); transition: all 0.5s ease;">
                            <i class="fas fa-check-circle"></i><span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <form id="bactaContactForm" action="{{ route('contact.store') }}" method="POST" novalidate>
                        @csrf
                        
                        <div style="display: none !important;">
                            <input type="text" name="bacta_security_verification_field" id="bactaSecurityField" autocomplete="off" tabindex="-1">
                        </div>

                        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                            <div style="width: 50%;">
                                <label style="display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px;"><i class="fas fa-user-md text-slate-400 mr-1"></i> Full Name</label>
                                <input type="text" id="contactName" name="name" style="width: 100%; height: 42px; background: #ffffff; border: 1px solid #CBD5E1; border-radius: 8px; padding: 0 14px; font-size: 13px; color: #0F172A; outline: none; transition: all 0.3s ease; box-sizing: border-box;" placeholder="Prof. / Dr. Your Name">
                                <div id="nameErrorNode" style="display: none; color: #EF4444; font-size: 11px; font-weight: 600; margin-top: 5px; align-items: center; gap: 4px;"><i class="fas fa-exclamation-triangle"></i> Name field cannot be blank!</div>
                            </div>
                            <div style="width: 50%;">
                                <label style="display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px;"><i class="fas fa-envelope text-slate-400 mr-1"></i> Email Address</label>
                                <input type="email" id="contactEmail" name="email" style="width: 100%; height: 42px; background: #ffffff; border: 1px solid #CBD5E1; border-radius: 8px; padding: 0 14px; font-size: 13px; color: #0F172A; outline: none; transition: all 0.3s ease; box-sizing: border-box;" placeholder="yourname@gmail.com">
                                <div id="emailErrorNode" style="display: none; color: #EF4444; font-size: 11px; font-weight: 600; margin-top: 5px; align-items: center; gap: 4px;"><i class="fas fa-exclamation-triangle"></i> Enter a valid official email address!</div>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px;"><i class="fas fa-mobile-alt text-slate-400 mr-1"></i> Mobile Number</label>
                            <input type="text" id="contactMobile" name="mobile" style="width: 100%; height: 42px; background: #ffffff; border: 1px solid #CBD5E1; border-radius: 8px; padding: 0 14px; font-size: 13px; color: #0F172A; outline: none; transition: all 0.3s ease; box-sizing: border-box;" placeholder="e.g., 01712345678" maxlength="11">
                            <div id="mobileErrorNode" style="display: none; color: #EF4444; font-size: 11px; font-weight: 600; margin-top: 5px; align-items: center; gap: 4px;"><i class="fas fa-exclamation-triangle"></i> Provide a valid 11-digit Bangladeshi mobile number!</div>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; font-size: 12.5px; font-weight: 600; color: #475569; margin-bottom: 6px;"><i class="fas fa-comment-alt text-slate-400 mr-1"></i> Write Message</label>
                            <textarea id="contactMessage" name="message" rows="4" style="width: 100%; background: #ffffff; border: 1px solid #CBD5E1; border-radius: 8px; padding: 12px 14px; font-size: 13px; color: #0F172A; outline: none; transition: all 0.3s ease; resize: none; box-sizing: border-box;" placeholder="Type your query or feedback message here..."></textarea>
                            <div id="messageErrorNode" style="display: none; color: #EF4444; font-size: 11px; font-weight: 600; margin-top: 5px; align-items: center; gap: 4px;"><i class="fas fa-exclamation-triangle"></i> Message box cannot be empty!</div>
                        </div>

                        <button type="button" onclick="validateAndSendFeedback()" style="background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; font-weight: 600; width: 100%; height: 44px; border-radius: 8px; font-size: 13.5px; border: none; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);">
                            <i class="fas fa-paper-plane"></i> Dispatch Official Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateAndSendFeedback() {
        let nameInput = document.getElementById('contactName');
        let emailInput = document.getElementById('contactEmail');
        let mobileInput = document.getElementById('contactMobile');
        let messageInput = document.getElementById('contactMessage');
        let honeypot = document.getElementById('bactaSecurityField');
        
        let nameError = document.getElementById('nameErrorNode');
        let emailError = document.getElementById('emailErrorNode');
        let mobileError = document.getElementById('mobileErrorNode');
        let messageError = document.getElementById('messageErrorNode');
        
        let form = document.getElementById('bactaContactForm');
        let isValid = true;

        nameError.style.display = 'none';
        emailError.style.display = 'none';
        mobileError.style.display = 'none';
        messageError.style.display = 'none';

        if (honeypot.value.trim() !== "") { return; }

        if (!nameInput.value.trim()) {
            nameInput.style.borderColor = '#EF4444'; nameInput.style.backgroundColor = '#FEF2F2'; nameError.style.display = 'flex'; isValid = false;
            nameInput.style.animation = 'metricShake 0.4s ease-in-out'; setTimeout(() => { nameInput.style.animation = ''; }, 420);
        } else { nameInput.style.borderColor = '#CBD5E1'; nameInput.style.backgroundColor = '#ffffff'; }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim() || !emailPattern.test(emailInput.value)) {
            emailInput.style.borderColor = '#EF4444'; emailInput.style.backgroundColor = '#FEF2F2'; emailError.style.display = 'flex'; isValid = false;
            emailInput.style.animation = 'metricShake 0.4s ease-in-out'; setTimeout(() => { emailInput.style.animation = ''; }, 420);
        } else { emailInput.style.borderColor = '#CBD5E1'; emailInput.style.backgroundColor = '#ffffff'; }

        let mobilePattern = /^01[3-9]\d{8}$/;
        if (!mobileInput.value.trim() || !mobilePattern.test(mobileInput.value)) {
            mobileInput.style.borderColor = '#EF4444'; mobileInput.style.backgroundColor = '#FEF2F2'; mobileError.style.display = 'flex'; isValid = false;
            mobileInput.style.animation = 'metricShake 0.4s ease-in-out'; setTimeout(() => { mobileInput.style.animation = ''; }, 420);
        } else { mobileInput.style.borderColor = '#CBD5E1'; mobileInput.style.backgroundColor = '#ffffff'; }

        if (!messageInput.value.trim()) {
            messageInput.style.borderColor = '#EF4444'; messageInput.style.backgroundColor = '#FEF2F2'; messageError.style.display = 'flex'; isValid = false;
            messageInput.style.animation = 'metricShake 0.4s ease-in-out'; setTimeout(() => { messageInput.style.animation = ''; }, 420);
        } else { messageInput.style.borderColor = '#CBD5E1'; messageInput.style.backgroundColor = '#ffffff'; }

        if (isValid) { form.submit(); }
    }

    document.addEventListener("DOMContentLoaded", function() {
        let successBanner = document.getElementById('contactSuccessBanner');
        if (successBanner) {
            setTimeout(function() {
                successBanner.style.opacity = '0'; successBanner.style.transform = 'translateY(-15px)';
                setTimeout(function() { successBanner.remove(); }, 500);
            }, 3000);
        }
    });
</script>
@endsection
