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
            background: radial-gradient(ellipse 1200px 800px at 20% 0%, rgba(2, 132, 199, 0.10) 0%, transparent 60%),
                        radial-gradient(ellipse 1000px 900px at 100% 100%, rgba(30, 64, 175, 0.08) 0%, transparent 60%),
                        #eef2f7 !important;
            display: flex; align-items: center; justify-content: center; min-height: 100vh;
            position: relative; overflow: hidden;
        }

        .login-box { width: 450px; max-width: 92vw; padding: 15px; position: relative; z-index: 1; animation: loginCardIn 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes loginCardIn {
            from { opacity: 0; transform: translateY(24px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @media (max-width: 480px) {
            .card { padding: 20px 12px; }
            .brand-logo-wrap { width: 92px; height: 92px; }
            .brand-logo { width: 76px; height: 76px; }
            .welcome-text { font-size: 21px; }
        }

        @keyframes cgShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        .field-shake { animation: cgShake 0.4s ease-in-out; }
        .live-error-msg { display: none; color: #dc3545; font-size: 11.5px; font-weight: 700; margin-top: 6px; align-items: center; gap: 5px; }

        /* Premium, restrained card design */
        .card {
            border-radius: 18px !important;
            padding: 25px 20px;
            box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.16) !important;
            border: none !important;
            background: #ffffff !important;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, #0284C7 0%, #1E40AF 100%);
        }

        .brand-logo-wrap {
            width: 108px; height: 108px; margin: 0 auto 14px; border-radius: 50%; position: relative;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.15);
        }
        .brand-logo { width: 100px; height: 100px; object-fit: contain; position: relative; z-index: 1; border-radius: 50%; }

        .welcome-text { color: #0F172A; font-weight: 800; font-size: 25px; margin-bottom: 4px; letter-spacing: -0.3px; }
        .sub-text { color: #718096; font-size: 13.5px; margin-bottom: 25px; }
        .sub-text i { color: #0284C7; }

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
            background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%) !important;
            border: none;
            color: white !important;
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.25) !important;
        }
        .btn-login:hover {
            box-shadow: 0 10px 24px rgba(2, 132, 199, 0.35) !important;
            filter: brightness(1.05);
        }
        .btn-login:disabled { opacity: 0.75; }

        .security-note {
            display: flex; align-items: flex-start; justify-content: center; gap: 6px;
            margin-top: 14px; font-size: 11px; font-weight: 500; color: #94A3B8;
            line-height: 1.5; text-align: center; padding: 0 8px;
        }
        .security-note i { color: #94A3B8; margin-top: 2px; flex-shrink: 0; }

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
            <div class="brand-logo-wrap">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
            </div>

            <h2 class="welcome-text">Welcome to BACTA!</h2>
            <p class="sub-text"><i class="fas fa-shield-halved mr-1"></i> Sign in to securely access your executive dashboard.</p>

            <form action="{{ route('login') }}" method="post" class="text-left" id="loginForm" novalidate>
                @csrf

                {{-- Email Address Input Field --}}
                <div class="form-group mb-4">
                    <label class="form-label">Email Address</label>
                    <div class="input-group @error('email') is-invalid-border @enderror" id="emailGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" id="emailField" class="form-control" value="{{ old('email') }}" placeholder="yourname@gmail.com" required autofocus>
                    </div>
                    <small id="emailLiveError" class="live-error-msg">
                        <i class="fas fa-exclamation-circle"></i> <span>Please enter a valid email address.</span>
                    </small>
                    @error('email')
                        <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                            <i class="fas fa-exclamation-circle mr-1"></i> ব্যবহারকারীর নাম অথবা ইমেইলটি লিখুন
                        </small>
                    @enderror
                </div>

                {{-- Password Input Field with Eye Toggle --}}
                <div class="form-group mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group @error('password') is-invalid-border @enderror" id="passwordGroup" style="position: relative;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="password" id="passwordField" class="form-control" placeholder="••••••••" required>
                        <span class="password-toggle-box" id="togglePasswordBtn">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <small id="passwordLiveError" class="live-error-msg">
                        <i class="fas fa-exclamation-circle"></i> <span>Please enter your password.</span>
                    </small>
                    @error('password')
                        <small class="text-danger font-weight-bold ml-1 mt-1 d-block">
                            <i class="fas fa-exclamation-circle mr-1"></i> গোপন পাসওয়ার্ডটি সঠিকভাবে লিখুন
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

            <div class="security-note">
                <i class="fas fa-lock fa-xs"></i>
                <span>This connection is encrypted and secure. Never share your password with anyone.</span>
            </div>

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
                    <p class="small text-muted mb-0 text-center">
                        @include('partials.branding-credit')
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $(document).ready(function() {
        // পাসওয়ার্ড চোখ আইকন টগল করার স্ক্রিপ্ট
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

        // স্মার্ট ইনলাইন ভ্যালিডেশন হেল্পার
        function showFieldError(groupId, errorId) {
            $('#' + groupId).addClass('is-invalid-border field-shake');
            $('#' + errorId).css('display', 'flex');
            setTimeout(function () { $('#' + groupId).removeClass('field-shake'); }, 420);
        }
        function clearFieldError(groupId, errorId) {
            $('#' + groupId).removeClass('is-invalid-border');
            $('#' + errorId).css('display', 'none');
        }

        $('#emailField').on('input', function () { clearFieldError('emailGroup', 'emailLiveError'); });
        $('#passwordField').on('input', function () { clearFieldError('passwordGroup', 'passwordLiveError'); });

        // আন্তর্জাতিক মানের স্মার্ট লোডিং বাটন + ইনলাইন ভ্যালিডেশন স্ক্রিপ্ট
        $('#loginForm').on('submit', function(e) {
            const emailVal = $('#emailField').val().trim();
            const passwordVal = $('#passwordField').val();
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
            let isValid = true;

            clearFieldError('emailGroup', 'emailLiveError');
            clearFieldError('passwordGroup', 'passwordLiveError');

            if (!emailValid) {
                showFieldError('emailGroup', 'emailLiveError');
                isValid = false;
            }
            if (!passwordVal) {
                showFieldError('passwordGroup', 'passwordLiveError');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return false;
            }

            $('#btnSubmit').attr('disabled', true);
            $('#btnIcon').removeClass('fa-sign-in-alt').addClass('fas fa-spinner fa-spin');
            $('#btnText').text('PROCESSING...');
        });

        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                type: 'success',
                title: @json(session('success')),
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                type: 'error',
                title: 'Sign in failed',
                text: @json($errors->first()),
                confirmButtonColor: '#0284C7'
            });
        @endif
    });
</script>
</body>
</html>
