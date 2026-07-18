<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#008cd3" />

    <!-- Primary Meta Tags -->
    <meta name="title" content="Login | BACTA" />
    <meta name="description" content="Official Administration and Member Management system for Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists."/>
    <meta name="author" content="Matrik" />

    <title>Login | BACTA</title>

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .login-page {
            background-color: #008cd3 !important; /* BACTA Logo Blue Color */
            display: flex; align-items: center; justify-content: center; min-height: 100vh;
        }
        .login-box { width: 450px; padding: 15px; }
        
        /* Glassmorphism Luxury Card Design */
        .card {
            border-radius: 24px !important;
            padding: 25px 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            background: #ffffff !important;
            transition: transform 0.3s ease;
        }
        
        .brand-logo { width: 110px; margin-bottom: 12px; }
        .welcome-text { color: #008cd3; font-weight: 700; font-size: 24px; margin-bottom: 4px; }
        .sub-text { color: #718096; font-size: 13.5px; margin-bottom: 25px; }
        
        .form-label { font-weight: 600; color: #4a5568; font-size: 13.5px; margin-bottom: 8px; display: block; }
        
        /* Modernized Input Group with Global Focus Transitions */
        .input-group { 
            position: relative;
            background-color: #f7fafc; 
            border-radius: 10px; 
            border: 1px solid #e2e8f0; 
            overflow: hidden; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-group:focus-within {
            border-color: #008cd3 !important;
            box-shadow: 0 0 0 3px rgba(0, 140, 211, 0.15);
            background-color: #ffffff;
        }
        .is-invalid-border { border: 1px solid #dc3545 !important; }
        
        .input-group-text { background: transparent; border: none; color: #00b0ff; padding-left: 15px; }
        .form-control { background: transparent; border: none; height: 46px; font-size: 15px; color: #2d3748 !important; }
        .form-control:focus { box-shadow: none; background: transparent; color: #2d3748 !important; }

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
        .password-toggle-box:hover { color: #008cd3; }

        /* Smooth Sliding Underline Effect for Links */
        .smart-link {
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            position: relative;
            transition: 0.3s;
        }
        .smart-link:hover { color: #008cd3; }
        .smart-link::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #008cd3;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }
        .smart-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* Modern Custom Checkbox/Switch Style */
        .custom-switch .custom-control-label::before {
            background-color: #e2e8f0;
            border: none;
            box-shadow: none !important;
            height: 1.45rem;
            width: 2.5rem;
            border-radius: 2rem;
        }
        .custom-switch .custom-control-label::after {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            height: calc(1.45rem - 4px);
            width: calc(1.45rem - 4px);
            border-radius: 2rem;
            transition: transform .25s ease;
        }
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #008cd3 !important;
        }

        /* Action Buttons with Advanced Loading State Transitions */
        .btn-login { 
            background-color: #008cd3 !important; 
            border: none; 
            color: white !important; 
            height: 48px;
            border-radius: 10px; 
            font-weight: 600; 
            letter-spacing: 0.5px;
            transition: all 0.3s ease; 
        }
        .btn-login:hover { 
            background-color: #005a87 !important; 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(0, 140, 211, 0.3) !important; 
        }
        
        /* Extra Membership Pitch Box Outer Layer */
        .membership-pitch-box {
            background-color: #f7fafc;
            border-radius: 14px;
            padding: 12px;
            margin-top: 25px;
            border: 1px solid #edf2f7;
        }

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
        <div class="card-body text-center p-2">
                        <!-- BACTA Official Premium Logo Location -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
            
            <h2 class="welcome-text">Welcome to BACTA!</h2>
            <p class="sub-text">Sign in to securely access your executive dashboard.</p>
            {{-- সাকসেস সেশন নোটিফিকেশন অ্যালার্ট --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 10px;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- স্মার্ট লকার ও পেন্ডিং এরর মেসেজ অ্যালার্ট --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3 text-left" role="alert" style="border-radius: 10px;">
                    <i class="fas fa-exclamation-circle mr-1"></i> 
                    {{ $errors->first() }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="text-left" id="loginForm" novalidate>
                @csrf
                
                {{-- Email Address Input Field --}}
                <div class="form-group mb-4">
                    <label class="form-label">Email Address</label>
                    <div class="input-group @error('email') is-invalid-border @enderror">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="yourname@gmail.com" required autofocus>
                    </div>
                    @error('email') 
                        <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                            <i class="fas fa-exclamation-circle mr-1"></i> ব্যবহারকারীর নাম অথবা ইমেইলটি লিখুন
                        </small> 
                    @enderror
                </div>

                {{-- Password Input Field with Eye Toggle --}}
                <div class="form-group mb-4">
                    <label class="form-label">Password</label>
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
                            <i class="fas fa-exclamation-circle mr-1"></i> গোপন পাসওয়ার্ডটি সঠিকভাবে লিখুন
                        </small> 
                    @enderror
                </div>

                {{-- Premium iOS Switch Button & Sliding Link --}}
                <div class="d-flex justify-content-between align-items-center mb-4 pt-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember" style="cursor: pointer;">
                        <label class="custom-control-label small text-muted font-weight-bold pl-2" for="rememberMe" style="cursor: pointer; font-size: 13px; user-select: none; padding-top: 2px;">Remember Me</label>
                    </div>
                    <!--<a href="{{ route('password.request') }}" class="small smart-link" style="font-size: 13px;">Forgot Password?</a>-->
                </div>

                {{-- Secure Sign In Button with Loader Target ID --}}
                <div class="mt-4 mb-2">
                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="btnSubmit">
                        <i class="fas fa-sign-in-alt mr-2" id="btnIcon"></i>
                        <span id="btnText">SECURE SIGN IN</span>
                    </button>
                </div>
            </form>

            {{-- International Corporate Membership Pitch Box --}}
            <!--<div class="membership-pitch-box text-center">
                <p class="small text-muted mb-0 font-weight-bold" style="font-size: 13px;">
                    Are you a Cardiovascular Anesthesiologist? 
                    <a href="{{ route('register') }}" class="smart-link text-primary ml-1">Apply for Membership <i class="fas fa-arrow-right fa-xs ml-1"></i></a>
                </p>
            </div>-->

            {{-- Footer Layer --}}
            <div class="footer-wrapper mt-4">
                <hr style="border-top: 1px solid #eee; width: 80%; margin: 20px auto;">
                <div class="footer-text">
                    <p class="mb-1 text-muted small">
                        Copyright &copy; {{ date('Y') }} <span class="font-weight-bold text-dark">BACTA</span>
                    </p>
                    <p class="small text-muted mb-0">
                        Crafted with <i class="fas fa-heart heartbeat"></i> by 
                        <a href="https://www.facebook.com/fringebytetech" target="_blank" class="smart-link text-dark font-weight-bold">FringeByte Technologies</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // অ্যালার্ট নোটিফিকেশন মেসেজ ৩ সেকেন্ড পর অটো ফেড-আউট করার স্ক্রিপ্ট
        setTimeout(function() {
            $(".alert").fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);

        // পাসওয়ার্ড চোখ আইকন টগল করার স্ক্রিপ্ট
        $('#togglePasswordBtn').on('click', function() {
            const passwordField = $('#passwordField');
            const eyeIcon = $('#eyeIcon');
            
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash'); 
                $(this).css('color', '#008cd3');
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye'); 
                $(this).css('color', '#a0aec0');
            }
        });

        // আন্তর্জাতিক মানের স্মার্ট লোডিং বাটন স্ক্রিপ্ট
        $('#loginForm').on('submit', function() {
            // ফর্ম ভ্যালিড থাকলে বাটনটি ডিজেবল করে স্পিনার অ্যানিমেশন চালু করবে
            if(this.checkValidity()) {
                $('#btnSubmit').attr('disabled', true);
                $('#btnIcon').removeClass('fa-sign-in-alt').addClass('fas fa-spinner fa-spin');
                $('#btnText').text('PROCESSING...');
            }
        });
    });
</script>
</body>
</html>
