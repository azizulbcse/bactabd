<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon / Browser Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#00496A" />

    <!-- Primary Meta Tags -->
    <meta name="title" content="Register | BACTA" />
    <meta name="description" content="Official Member Registration Portal for Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists."/>
    <meta name="author" content="Matrik" />

    <title>Register | BACTA</title>

    <!-- Google Fonts & Core Icons -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .login-page {
            background-color: #00496A !important;
            display: flex; align-items: center; justify-content: center; min-height: 100vh;
            padding: 30px 0;
        }
        /* Wider Box to beautifully support 2 Column Layout side-by-side */
        .login-box { width: 780px; max-width: 100%; padding: 15px; }
        
        .card {
            border-radius: 20px !important;
            padding: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3) !important;
            border: none !important;
            background: #ffffff !important;
        }
        
        /* Centered Logo Layout Styling Inside Card */
        .logo-container { text-align: center; margin-bottom: 20px; }
        .brand-logo { width: 130px; display: inline-block; margin-bottom: 10px; }
        
        .welcome-text { color: #00496A; font-weight: 700; font-size: 26px; margin-bottom: 5px; text-center; }
        .sub-text { color: #6c757d; font-size: 14px; margin-bottom: 30px; text-center; }
        
        .form-label { font-weight: 600; color: #444; font-size: 14px; margin-bottom: 8px; display: block; }
        .form-label::after { content: " *"; color: #dc3545; }
        
        .input-group { 
            position: relative;
            background-color: #f8f9fa; 
            border-radius: 8px; 
            border: 1px solid #ddd; 
            overflow: hidden; 
        }
        .is-invalid-border { border: 1px solid #dc3545 !important; }
        
        .input-group-text { background: transparent; border: none; color: #00ADEF; padding-left: 15px; width: 45px; }
        .form-control, .form-select { background: transparent; border: none; height: 45px; font-size: 15px; color: #222 !important; width: 100%; }
        .form-control:focus, .form-select:focus { box-shadow: none; background: transparent; color: #222 !important; outline: none; }
        
        select.form-control { -webkit-appearance: none; -moz-appearance: none; appearance: none; padding-right: 30px; }
        .select-icon-box { position: absolute; right: 15px; top: 13px; color: #a0aec0; pointer-events: none; }

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
        
        .matrik-link { color: #00496A; text-decoration: none; transition: 0.3s; }
        .matrik-link:hover { color: #00ADEF; }

        .heartbeat {
            color: #e74c3c;
            animation: blinker 1.2s cubic-bezier(.5, 0, 1, 1) infinite alternate;
        }
        @keyframes blinker {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0.5; transform: scale(1.2); }
        }
    </style>
</head>
<body class="login-page">
<div class="login-box animate__animated animate__fadeIn">
    <div class="card shadow-lg">
        <div class="card-body p-2">
            
            {{-- রেজিস্ট্রেশন সফল হওয়ার স্মার্ট সাকসেস মেসেজ অ্যালার্ট --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 text-left" role="alert" style="border-radius: 8px;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- স্মার্ট ডুপ্লিকেট নোটিফিকেশন প্রোটেকশন অ্যালার্ট (ইমেইল বা বিএমডিসি আগে থাকলে এখানে আইকনসহ দেখাবে) --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 text-left" role="alert" style="border-radius: 8px;">
                    <i class="fas fa-exclamation-circle mr-1"></i> 
                    {{ $errors->first() }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Centered Logo Section Inside Card -->
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="BACTA Logo" class="brand-logo">
                <h2 class="welcome-text">Create BACTA Account</h2>
                <p class="sub-text italic">Please fill in all mandatory fields to apply for membership.</p>
            </div>

            {{-- Secure Laravel Registration Form --}}
            <form action="{{ route('register') }}" method="post" class="text-left" id="registerForm" novalidate>
                @csrf
                
                {{-- Row 1: Full Name & Email Address --}}
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">Full Name [পূর্ণ নাম]</label>
                        <div class="input-group @error('name') is-invalid-border @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Dr. Firstname Lastname" required autofocus>
                        </div>
                        @error('name') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> অনুগ্রহ করে আপনার পূর্ণ নাম লিখুন
                            </small> 
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">Email Address [ইমেইল]</label>
                        <div class="input-group @error('email') is-invalid-border @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="doctor@example.com" required>
                        </div>
                        @error('email') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> একটি সঠিক ও বৈধ ইমেইল এড্রেস লিখুন
                            </small> 
                        @enderror
                    </div>
                </div>

                {{-- Row 2: BMDC Registration No. & Designation --}}
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">BMDC Registration No. [বিএমডিসি নম্বর]</label>
                        <div class="input-group @error('bmdc_reg_no') is-invalid-border @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" name="bmdc_reg_no" class="form-control" value="{{ old('bmdc_reg_no') }}" placeholder="A-12345" required>
                        </div>
                        @error('bmdc_reg_no') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> আপনার বিএমডিসি রেজিস্ট্রেশন নম্বরটি লিখুন
                            </small> 
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">Designation [পদবি]</label>
                        <div class="input-group @error('designation') is-invalid-border @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                            </div>
                            <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="Consultant / Professor" required>
                        </div>
                        @error('designation') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> আপনার বর্তমান চিকিৎসা পদের নাম লিখুন
                            </small> 
                        @enderror
                    </div>
                </div>
                {{-- Row 3: Membership Type Dropdown (Takes full row width for stable alignment) --}}
                <div class="row">
                    <div class="col-md-12 form-group mb-4">
                        <label class="form-label">Membership Type [সদস্যপদের ধরন]</label>
                        <div class="input-group @error('member_type') is-invalid-border @enderror" style="position: relative;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-award"></i></span>
                            </div>
                            <select name="member_type" class="form-control" required>
                                <option value="" disabled selected>Select Membership Type</option>
                                <option value="Lifetime" {{ old('member_type') == 'Lifetime' ? 'selected' : '' }}>Life Time Member</option>
                                <option value="General" {{ old('member_type') == 'General' ? 'selected' : '' }}>General Member</option>
                            </select>
                            <span class="select-icon-box"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        @error('member_type') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> সদস্যপদের ধরন সিলেক্ট করুন
                            </small> 
                        @enderror
                    </div>
                </div>

                {{-- Row 4: Security Password & Confirm Password --}}
                <div class="row">
                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">Security Password [পাসওয়ার্ড]</label>
                        <div class="input-group @error('password') is-invalid-border @enderror" style="position: relative;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" id="passwordField" class="form-control" placeholder="••••••••" required>
                            <span class="password-toggle-box" id="togglePasswordBtn">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        @error('password') 
                            <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i> নূন্যতম ৮ অক্ষরের পাসওয়ার্ড দিন
                            </small> 
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-4">
                        <label class="form-label">Confirm Password [পাসওয়ার্ড নিশ্চিত করুন]</label>
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

                {{-- Submit Button --}}
                <div class="mt-3 mb-2">
                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="btnSubmit">
                        <i class="fas fa-user-plus mr-2" id="btnIcon"></i> 
                        <span id="btnText">SUBMIT MEMBERSHIP APPLICATION</span>
                    </button>
                </div>
            </form>
            {{-- Professional Footer Section with Login Link --}}
            <div class="footer-wrapper mt-4">
                <hr style="border-top: 1px solid #eee; width: 80%; margin: 20px auto;">
                <div class="footer-text text-center">
                    <p class="mb-1 text-muted small font-weight-bold" style="font-size: 13.5px;">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="matrik-link ml-1">Sign In Securely <i class="fas fa-sign-in-alt fa-xs ml-1"></i></a>
                    </p>
                    <p class="mb-1 text-muted small mt-3">
                        Copyright &copy; {{ date('Y') }} <span class="font-weight-bold text-dark">BACTA</span>
                    </p>
                    <p class="small text-muted mb-0">
                        Crafted with <i class="fas fa-heart heartbeat"></i> by 
                        <a href="https://matrik.com.bd" target="_blank" class="matrik-link font-weight-bold">Matrik</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Script Libraries --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Auto-dismiss alert notification after 3 seconds
        setTimeout(function() {
            $(".alert").fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);

        // Toggle visibility for Main Password Field
        $('#togglePasswordBtn').on('click', function() {
            const passwordField = $('#passwordField');
            const eyeIcon = $('#eyeIcon');
            
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash'); 
                $(this).css('color', '#00496A');
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye'); 
                $(this).css('color', '#a0aec0');
            }
        });

        // Toggle visibility for Confirm Password Field
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

        // Smart Submitting Button Loader Animation
        $('#registerForm').on('submit', function() {
            if(this.checkValidity()) {
                $('#btnSubmit').attr('disabled', true);
                $('#btnIcon').removeClass('fa-user-plus').addClass('fas fa-spinner fa-spin');
                $('#btnText').text('PROCESSING APPLICATIONS...');
            }
        });
    });
</script>
</body>
</html>
