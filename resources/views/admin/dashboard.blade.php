@extends('adminlte::page')

@section('title', 'Admin Dashboard | BACTA')

@section('content_header')
    <div style="font-family: 'Poppins', sans-serif; padding-left: 5px;">
        <h1 style="color: #0F172A; font-weight: 800; font-size: 24px; margin: 0;">BACTA Control Center</h1>
    </div>
@stop

@section('content')
<div style="font-family: 'Poppins', sans-serif; padding: 5px 5px 30px;">
    
    <!-- 👑 ওফিসিয়াল ৪-কলাম ড্যাশবোর্ড কার্ড গ্রিড জোন -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; margin-bottom: 20px;">

        <!-- ==========================================
             🔒 কার্ড ১: Pending Applications (সলিড লাল বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-danger" onclick="window.location='{{ route('admin.members.pending') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['pending_apps'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Pending Applications</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear;">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('admin.members.pending') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Review Approvals <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 কার্ড ২: Lifetime Members (ডিপ রয়্যাল ডার্ক ব্লু বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-dark" onclick="window.location='{{ route('admin.members.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #1E293B !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['lifetime_fel'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Lifetime Members</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.12; font-size: 65px; position: absolute; transition: all 0.3s linear;">
                <i class="fas fa-award"></i>
            </div>
            <a href="{{ route('admin.members.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.15); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                View Fellows Directory <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 কার্ড ৩: General Members (উজ্জ্বল আকাশী নীল বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-info" onclick="window.location='{{ route('admin.members.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #0EA5E9 !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['active_mems'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">General Members</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear;">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.members.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Manage Active Roster <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 🏥 কার্ড ৪: Hospitals Registry (মেডিকেল সবুজ বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-success" onclick="window.location='{{ route('admin.hospitals.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #10B981 !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['hospitals'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Hospitals Registry</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear;">
                <i class="fas fa-hospital"></i>
            </div>
            <a href="{{ route('admin.hospitals.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Configure Institutes <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>
        <!-- ==========================================
             🔒 কার্ড ৫: Official Medical & BACTA Designations (পার্পল বক্স ভাই)
             ========================================= -->
        <div class="small-box bg-purple" onclick="window.location='{{ route('admin.med_desig.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #A855F7 !important; color: #ffffff !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['designations'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Official Titles</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear; color: rgba(255,255,255,0.4) !important;">
                <i class="fas fa-id-badge"></i>
            </div>
            <a href="{{ route('admin.med_desig.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Manage Ranks <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 কার্ড ৬: Live Announcements / Notices Dispatch (কমলা বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-warning" onclick="window.location='{{ route('admin.notices.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #EA580C !important; color: #ffffff !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['notices'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Active Notices</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear; color: rgba(255,255,255,0.4) !important;">
                <i class="fas fa-bullhorn"></i>
            </div>
            <a href="{{ route('admin.notices.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Broadcast Bulletin <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 कार्ड ७: Executive Board Minutes & Resolutions (স্টিল গ্রে বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-secondary" onclick="window.location='{{ route('admin.minutes.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #4B5563 !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['minutes'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Resolutions Log</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.12; font-size: 65px; position: absolute; transition: all 0.3s linear;">
                <i class="fas fa-history"></i>
            </div>
            <a href="{{ route('admin.minutes.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.15); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Closed Minutes <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>

        <!-- ==========================================
             🔒 📚 কার্ড ৮: Research Journals & Secretariat Mail Inbox (ম্যাজেন্টা পিঙ্ক বক্স ভাই)
             ========================================== -->
        <div class="small-box bg-maroon" onclick="window.location='{{ route('admin.journals.index') }}'" style="border-radius: 4px; overflow: hidden; margin-bottom: 0; cursor: pointer; background-color: #D946EF !important; color: #ffffff !important; transition: transform 0.2s ease;" onmouseenter="this.style.transform='translateY(-2px)';" onmouseleave="this.style.transform='translateY(0)';">
            <div class="inner" style="padding: 15px 20px 20px;">
                <h3 style="font-size: 38px; font-weight: 700; margin: 0 0 3px 0; line-height: 1;">{{ $counts['journals_mail'] }}</h3>
                <p style="font-size: 13px; font-weight: 600; margin: 0; opacity: 0.9;">Journals & Inbox</p>
            </div>
            <div class="icon" style="top: 15px; right: 15px; opacity: 0.15; font-size: 65px; position: absolute; transition: all 0.3s linear; color: rgba(255,255,255,0.4) !important;">
                <i class="fas fa-book-medical"></i>
            </div>
            <a href="{{ route('admin.journals.index') }}" class="small-box-footer" style="padding: 4px 0; background: rgba(0,0,0,0.1); font-size: 12px; display: block; text-align: center; text-decoration: none; color: rgba(255,255,255,0.8); font-weight: 600;">
                Asset Pipeline <i class="fas fa-arrow-circle-right" style="margin-left: 3px; font-size: 11px;"></i>
            </a>
        </div>
    </div> {{-- গ্রিড কন্টেইনার ক্লোজিং ভাই --}}
    <!-- ==========================================
         👑 আন্তর্জাতিক স্ট্যান্ডার্ড: গ্লোবাল মিনিমালিস্ট লেআউট ফুটার
         ========================================== -->
    <footer style="margin-top: 50px; padding-top: 15px; border-top: 1px solid #E2E8F0; width: 100%; box-sizing: border-box; font-family: 'Poppins';">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; width: 100%;">
            <div style="font-size: 11.5px; font-weight: 600; color: #64748B;">
                &copy; {{ date('Y') }} <a href="https://bactabd.org" target="_blank" style="color: #0284C7; text-decoration: none; font-weight: 700;">BACTA Bangladesh</a>. All Research Rights Reserved.
            </div>
            <div style="display: flex; align-items: center; gap: 15px; font-size: 11.5px; font-weight: 600; color: #94A3B8;">
                <span><i class="fas fa-server text-emerald-400"></i> v3.2.5 Core</span>
                <span><i class="fas fa-lock text-sky-400"></i> SSL Encrypted</span>
            </div>
        </div>
    </footer>

</div> {{-- মেইন কন্টেইনার ক্লোজিং ভাই --}}
@stop
