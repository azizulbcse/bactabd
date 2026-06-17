@extends('adminlte::page')

@section('title', 'Admin Dashboard | BACTA')

@section('content_header')
    {{-- smooth fade-in effect সহ প্রফেশনাল অ্যাডমিন টাইটেল বার --}}
    <div class="d-flex justify-content-between align-items-center animate__animated animate__fadeIn">
        <h1 style="color: #00496A; font-weight: 700; font-family: 'Poppins', sans-serif;">
            <i class="fas fa-chart-pie mr-2" style="color: #00ADEF;"></i> BACTA Control Center
        </h1>
        <ol class="breadcrumb float-sm-right small text-muted d-none d-md-flex">
            <li class="breadcrumb-item"><a href="#" style="color: #00496A; font-weight: 600; text-decoration: none;">Home</a></li>
            <li class="breadcrumb-item active">Admin Dashboard</li>
        </ol>
    </div>
@stop
@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    
    {{-- Top Executive Stats Row --}}
    <div class="row">
        {{-- Card 1: Pending Approvals (আপনার নিয়ম অনুযায়ী লাল রঙে হাইলাইট করা) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm border-0" style="border-radius: 12px; transition: 0.3s ease;">
                <span class="info-box-icon bg-danger elevation-1" style="background-color: #e74c3c !important; border-radius: 10px;">
                    <i class="fas fa-clock fa-xs"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bold text-muted small">Pending Applications</span>
                    <span class="info-box-number h4 font-weight-bold mb-0 text-dark">5</span>
                </div>
            </div>
        </div>

        {{-- Card 2: Lifetime Members (ব্লু থিম) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm border-0" style="border-radius: 12px; transition: 0.3s ease;">
                <span class="info-box-icon bg-primary elevation-1" style="background-color: #00496A !important; border-radius: 10px;">
                    <i class="fas fa-award fa-xs"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bold text-muted small">Lifetime Members</span>
                    <span class="info-box-number h4 font-weight-bold mb-0 text-dark">142</span>
                </div>
            </div>
        </div>

        {{-- Card 3: General Members (লাইট ব্লু থিম) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm border-0" style="border-radius: 12px; transition: 0.3s ease;">
                <span class="info-box-icon bg-info elevation-1" style="background-color: #00ADEF !important; border-radius: 10px;">
                    <i class="fas fa-user-md fa-xs"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bold text-muted small">General Members</span>
                    <span class="info-box-number h4 font-weight-bold mb-0 text-dark">218</span>
                </div>
            </div>
        </div>

        {{-- Card 4: Published Notices (সবুজ থিম) --}}
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm border-0" style="border-radius: 12px; transition: 0.3s ease;">
                <span class="info-box-icon bg-success elevation-1" style="border-radius: 10px;">
                    <i class="fas fa-bullhorn fa-xs"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bold text-muted small">Active Notices</span>
                    <span class="info-box-number h4 font-weight-bold mb-0 text-dark">12</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Main Admin Welcome & Quick Actions Row --}}
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; border-top: 4px solid #00496A !important;">
                <div class="card-body p-4 text-center">
                    <!-- BACTA Animating Logo Layer -->
                    <img src="{{ asset('images/logo.png') }}" alt="BACTA" style="width: 110px; margin-bottom: 15px;" class="animate__animated animate__pulse animate__infinite">
                    
                    <h3 class="font-weight-bold text-dark mb-2">System Administrator Control Center</h3>
                    <p class="text-muted mx-auto" style="max-width: 650px; font-size: 14.5px;">
                        Welcome back! You have secure root privileges over BACTA Bangladesh database. From this control tower, you can instantly approve pending medical credentials, manage global science journals, and track registration audit logs.
                    </p>
                    
                    <!-- Quick Action Button to Route Pending Directory -->
                    <div class="mt-4">
                        <a href="{{ route('admin.members.pending') }}" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" style="background-color: #00496A; border: none; border-radius: 8px; transition: 0.3s;">
                            <i class="fas fa-user-check mr-2"></i> Review Pending Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
    <!-- Animate.css for entrance animations -->
    <link rel="stylesheet" href="https://cloudflare.com"/>
    
    <style>
        /* Info-Box Smooth Floating Interactive Transitions */
        .info-box { 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
        }
        .info-box:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 12px 24px rgba(0, 73, 106, 0.15) !important; 
        }
        
        /* Central Action Button Hover Animation */
        .btn-primary:hover {
            background-color: #00ADEF !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 173, 239, 0.3) !important;
        }
    </style>
@stop

@section('js')
    <script> 
        console.log("BACTA Command Center Loaded and Secured Successfully!"); 
    </script>
    {{-- AdminLTE লগআউট সচল করার জন্য হিডেন লারাভেল সিকিউর ফর্ম --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@stop
