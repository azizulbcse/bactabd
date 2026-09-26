<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#00496A" />

    <!-- Primary Meta Tags -->
    <meta name="title" content="Forgot Password | BACTA" />
    <meta name="description" content="Official Password Recovery Portal for Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists."/>
    <meta name="author" content="Matrik" />

    <title>Forgot Password | BACTA</title>

    <!-- Google Fonts & Icons -->
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
        }
        .login-box { width: 450px; padding: 15px; }
        
        .card {
            border-radius: 20px !important;
            padding: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3) !important;
            border: none !important;
            background: #ffffff !important;
        }
        .brand-logo { width: 120px; margin-bottom: 15px; }
        .welcome-text { color: #00496A; font-weight: 700; font-size: 24px; margin-bottom: 8px; }
        .sub-text { color: #6c757d; font-size: 13.5px; margin-bottom: 25px; line-height: 1.5; }
        
        .form-label { font-weight: 600; color: #444; font-size: 14px; margin-bottom: 8px; display: block; }
        
        .input-group { 
            position: relative;
            background-color: #f8f9fa; 
            border-radius: 8px; 
            border: 1px solid #ddd; 
            overflow: hidden; 
        }
        .is-invalid-border { border: 1px solid #dc3545 !important; }
        
        .input-group-text { background: transparent; border: none; color: #00ADEF; padding-left: 15px; }
        .form-control { background: transparent; border: none; height: 45px; font-size: 15px; color: #222 !important; }
        .form-control:focus { box-shadow: none; background: transparent; color: #222 !important; }

        .btn-login { 
            background-color: #00496A !important; 
            border: none; 
            color: white !important; 
            height: 45px;
            border-radius: 6px; 
            font-weight: 600; 
            transition: 0.3s; 
        }
        .btn-login:hover { 
            background-color: #00ADEF !important; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important; 
        }
        
        .matrik-link { color: #00496A; text-decoration: none; transition: 0.3s; font-weight: 600; }
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
        <div class="card-body text-center p-2">
            
            {{-- রিসেট লিংক ইমেইলে সফলভাবে চলে গেলে সাকসেস মেসেজ অ্যালার্ট --}}
            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 text-left" role="alert" style="border-radius: 8px;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- ইমেইলটি ডাটাবেজে না থাকলে বা ভুল হলে কাস্টম এরর মেসেজ অ্যালার্ট --}}
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
                <h2 class="welcome-text">Forgot Password?</h2>
                <p class="sub-text">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
            </div>

            {{-- Secure Laravel Password Reset Link Form --}}
            <form action="{{ route('password.email') }}" method="post" class="text-left" id="forgotPasswordForm" novalidate>
                @csrf
                
                {{-- Email Address Input Field --}}
                <div class="form-group mb-4">
                    <label class="form-label">Email Address [ইমেইল]</label>
                    <div class="input-group @error('email') is-invalid-border @enderror">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="doctor@example.com" required autofocus>
                    </div>
                </div>
                {{-- Submit Button with Loader Targets --}}
                <div class="mt-4 mb-2">
                    <button type="submit" class="btn btn-primary btn-block btn-login shadow-sm" id="btnSubmit">
                        <i class="fas fa-paper-plane mr-2" id="btnIcon"></i>
                        <span id="btnText">EMAIL PASSWORD RESET LINK</span>
                    </button>
                </div>
            </form>

            {{-- Back to Sign In Link --}}
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="matrik-link small">
                    <i class="fas fa-arrow-left fa-xs mr-1"></i> Back to Secure Sign In
                </a>
            </div>

            {{-- Footer Section --}}
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
{{-- Script Libraries --}}
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

        // আন্তর্জাতিক মানের স্মার্ট লোডিং বাটন স্ক্রিপ্ট
        $('#forgotPasswordForm').on('submit', function() {
            // ফর্ম ভ্যালিড থাকলে বাটনটি ডিজেবল করে স্পিনার অ্যানিমেশন চালু করবে
            if(this.checkValidity()) {
                $('#btnSubmit').attr('disabled', true);
                $('#btnIcon').removeClass('fa-paper-plane').addClass('fas fa-spinner fa-spin');
                $('#btnText').text('PROCESSING REQUEST...');
            }
        });
    });
</script>
</body>
</html>
