@extends('adminlte::page')

@section('title', 'Change Password | BACTA')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center animate__animated animate__fadeIn">
        <h1 style="color: #00496A; font-weight: 700; font-family: 'Poppins', sans-serif;">
            <i class="fas fa-key mr-2" style="color: #00ADEF;"></i> Update Account Security
        </h1>
        <ol class="breadcrumb float-sm-right small text-muted d-none d-sm-flex">
            <li class="breadcrumb-item"><a href="#" style="color: #00496A; font-weight: 600; text-decoration: none;">Profile</a></li>
            <li class="breadcrumb-item active">Security</li>
        </ol>
    </div>
@stop

@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    <style>
        .card {
            border-radius: 20px !important;
            padding: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
            border: none !important;
            background: #ffffff !important;
        }
        .form-label { font-weight: 600; color: #444; font-size: 14px; margin-bottom: 8px; display: block; }
        .form-label::after { content: " *"; color: #dc3545; }
        
        .input-group { 
            position: relative;
            background-color: #f8f9fa; 
            border-radius: 8px; 
            border: 1px solid #ddd; 
            overflow: hidden; 
            transition: 0.3s;
        }
        .input-group:focus-within { border-color: #00496A; box-shadow: 0 0 0 3px rgba(0, 73, 106, 0.15); }
        .is-invalid-border { border: 1px solid #dc3545 !important; }
        
        .input-group-text { background: transparent; border: none; color: #00ADEF; padding-left: 15px; width: 45px; }
        .form-control { background: transparent; border: none; height: 45px; font-size: 15px; color: #222 !important; width: 100%; }
        .form-control:focus { box-shadow: none; background: transparent; color: #222 !important; outline: none; }

        .password-toggle-box {
            position: absolute;
            right: 15px;
            top: 13px;
            z-index: 10;
            color: #a0aec0;
            cursor: pointer;
            font-size: 15px;
            transition: 0.2s;
        }
        .password-toggle-box:hover { color: #00496A; }

        .btn-login { 
            background-color: #00496A !important; 
            border: none; 
            color: white !important; 
            height: 48px;
            border-radius: 8px; 
            font-weight: 600; 
            transition: 0.3s; 
            font-size: 16px;
            letter-spacing: 0.5px;
        }
        .btn-login:hover { 
            background-color: #00ADEF !important; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important; 
        }
    </style>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg mt-3">
                <div class="card-body">
                    
                    {{-- পাসওয়ার্ড সফলভাবে আপডেট হওয়ার স্মার্ট সাকসেস মেসেজ অ্যালার্ট --}}
                    @if(session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 text-left" role="alert" style="border-radius: 8px;">
                            <i class="fas fa-check-circle mr-1"></i> Password updated successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- ভুল পাসওয়ার্ড টাইপ করলে বা কোনো এরর আসলে কাস্টম এরর মেসেজ বক্স --}}
                    @if($errors->updatePassword->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 text-left" role="alert" style="border-radius: 8px;">
                            <i class="fas fa-exclamation-circle mr-1"></i> 
                            {{ $errors->updatePassword->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <p class="text-muted small mb-4">Ensure your account is using a long, random password to stay secure.</p>

                    {{-- Secure Laravel Password Update Action Form --}}
                    <form action="{{ route('password.update') }}" method="post" id="passwordChangeForm" novalidate>
                        @csrf
                        @method('put')

                        {{-- Current Password Field with Smart Toggle Eye Button --}}
                        <div class="form-group mb-4">
                            <label class="form-label">Current Password [বর্তমান পাসওয়ার্ড]</label>
                            <div class="input-group @error('current_password', 'updatePassword') is-invalid-border @enderror" style="position: relative;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="current_password" id="currentPasswordField" class="form-control" placeholder="••••••••" required>
                                <span class="password-toggle-box" id="toggleCurrentPasswordBtn">
                                    <i class="fas fa-eye" id="currentEyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        {{-- Row 2: New Password & Confirm Password (২-কলাম গ্রিড লেআউট) --}}
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label">New Password [নতুন পাসওয়ার্ড]</label>
                                <div class="input-group @error('password', 'updatePassword') is-invalid-border @enderror" style="position: relative;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" id="newPasswordField" class="form-control" placeholder="••••••••" required>
                                    <span class="password-toggle-box" id="toggleNewPasswordBtn">
                                        <i class="fas fa-eye" id="newEyeIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label">Confirm New Password [পাসওয়ার্ড নিশ্চিত করুন]</label>
                                <div class="input-group" style="position: relative;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="confirmPasswordField" class="form-control" placeholder="••••••••" required>
                                    <span class="password-toggle-box" id="toggleConfirmPasswordBtn">
                                        <i class="fas fa-eye" id="confirmEyeIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button with Loader Targets --}}
                        <div class="mt-2 mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="btnSubmit">
                                <i class="fas fa-save mr-2" id="btnIcon"></i>
                                <span id="btnText">SAVE NEW PASSWORD</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function() {
        // অ্যালার্ট নোটিফিকেশন মেসেজ ৩ সেকেন্ড পর অটো ফেড-আউট করার স্ক্রিপ্ট
        setTimeout(function() {
            $(".alert").fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);

        // ১. বর্তমান পাসওয়ার্ড চোখ আইকন টগল করার স্ক্রিপ্ট
        $('#toggleCurrentPasswordBtn').on('click', function() {
            const currentPasswordField = $('#currentPasswordField');
            const currentEyeIcon = $('#currentEyeIcon');
            
            if (currentPasswordField.attr('type') === 'password') {
                currentPasswordField.attr('type', 'text');
                currentEyeIcon.removeClass('fa-eye').addClass('fa-eye-slash'); 
                $(this).css('color', '#00496A');
            } else {
                currentPasswordField.attr('type', 'password');
                currentEyeIcon.removeClass('fa-eye-slash').addClass('fa-eye'); 
                $(this).css('color', '#a0aec0');
            }
        });

        // ২. নতুন পাসওয়ার্ড চোখ আইকন টগল করার স্ক্রিপ্ট
        $('#toggleNewPasswordBtn').on('click', function() {
            const newPasswordField = $('#newPasswordField');
            const newEyeIcon = $('#newEyeIcon');
            
            if (newPasswordField.attr('type') === 'password') {
                newPasswordField.attr('type', 'text');
                newEyeIcon.removeClass('fa-eye').addClass('fa-eye-slash'); 
                $(this).css('color', '#00496A');
            } else {
                newPasswordField.attr('type', 'password');
                newEyeIcon.removeClass('fa-eye-slash').addClass('fa-eye'); 
                $(this).css('color', '#a0aec0');
            }
        });

        // ৩. কনফর্ম পাসওয়ার্ড চোখ আইকন টগল করার স্ক্রিপ্ট
        $('#toggleConfirmPasswordBtn').on('click', function() {
            const confirmPasswordField = $('#confirmPasswordField');
            const confirmEyeIcon = $('#confirmEyeIcon');
            
            if (confirmPasswordField.attr('type') === 'password') {
                confirmPasswordField.attr('type', 'text');
                confirmEyeIcon.removeClass('fa-eye').addClass('fa-eye-slash'); 
                $(this).css('color', '#00496A');
            } else {
                confirmPasswordField.attr('type', 'password');
                confirmEyeIcon.removeClass('fa-eye-slash').addClass('fa-eye'); 
                $(this).css('color', '#a0aec0');
            }
        });

        // স্মার্ট সাবমিটিং বাটন লোডার অ্যানিমেশন
        $('#passwordChangeForm').on('submit', function() {
            if(this.checkValidity()) {
                $('#btnSubmit').attr('disabled', true);
                $('#btnIcon').removeClass('fa-save').addClass('fas fa-spinner fa-spin');
                $('#btnText').text('PROCESSING APPLICATIONS...');
            }
        });
    });
</script>
@stop
