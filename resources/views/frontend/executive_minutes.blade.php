<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Executive Minutes & Resolutions | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cloudflare.com">

<header class="bg-[#0F172A] relative overflow-hidden py-12 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-1">Restricted Registry Logs</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">Executive Minutes</h1>
        </div>
        <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-200">Executive Minutes</span>
        </div>
    </div>
</header>

<style>
    .minutes-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 50px 0; box-sizing: border-box; }
    .minutes-container { width: 100%; max-width: 1140px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
    .timeline-wrapper { display: flex; flex-direction: column; gap: 25px; width: 100%; position: relative; box-sizing: border-box; }
    .minutes-node-card { background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 24px; display: flex; align-items: center; gap: 24px; box-shadow: 0 4px 15px rgba(148, 163, 184, 0.02); transition: all 0.3s ease; box-sizing: border-box; }
    .minutes-node-card:hover { transform: translateY(-3px); border-color: #0284C7; box-shadow: 0 12px 25px -5px rgba(2, 132, 199, 0.08); }
    .minutes-date-stamp { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 70px; height: 74px; flex-shrink: 0; }
    .date-stamp-month { font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0284C7; }
    .date-stamp-day { font-size: 22px; font-weight: 800; color: #0F172A; line-height: 1.1; }
    .date-stamp-year { font-size: 10px; font-weight: 600; color: #64748B; }
    .minutes-details-zone { flex-grow: 1; }
    .minutes-node-title { font-size: 15.5px; font-weight: 700; color: #0F172A; margin: 0 0 6px 0; line-height: 1.4; }
    @media (max-width: 640px) { .minutes-node-card { flex-direction: column; align-items: flex-start; gap: 16px; padding: 20px; } .minutes-action-hub-links { width: 100%; justify-content: flex-start !important; } }
</style>
<div class="minutes-body-wrapper">
    <div class="minutes-container">

        <div class="nhcs-page-header" style="text-align: center; margin-bottom: 45px; border-bottom: 2px solid #E2E8F0; padding-bottom: 25px;">
            <h2 style="font-size: 26px; font-weight: 700; color: #0284C7; margin: 0 0 8px 0; text-transform: uppercase;">Executive Resolution Archive</h2>
            <p style="color: #64748B; font-size: 14.5px; margin: 0;">Restricted Registry Log - Authorized Doctors & Members Only</p>
        </div>

        <!-- ==========================================
             🚀 CENTRAL MINUTES TIMELINE GRID
             ========================================== -->
        <div class="timeline-wrapper">
            @forelse($minutes as $row)
                <div class="minutes-node-card">
                    
                    <div class="minutes-date-stamp">
                        <span class="date-stamp-month">{{ $row->created_at->format('M') }}</span>
                        <span class="date-stamp-day">{{ $row->created_at->format('d') }}</span>
                        <span class="date-stamp-year">{{ $row->created_at->format('Y') }}</span>
                    </div>

                    <div class="minutes-details-zone">
                        <h3 class="minutes-node-title">{{ $row->title }}</h3>
                        <div style="display: flex; gap: 15px; align-items: center; font-size: 11.5px; color: #94A3B8; font-weight: 500;">
                            <span><i class="far fa-clock text-[#0284C7] mr-1"></i> {{ $row->created_at->format('h:i A') }}</span>
                            <span><i class="fas fa-shield-alt text-emerald-500 mr-1"></i> EC Authorized</span>
                        </div>
                    </div>

                    <div class="minutes-action-hub-links" style="display: flex; gap: 10px; justify-content: flex-end; flex-shrink: 0;">
                        <a href="{{ asset('storage/' . $row->minute_file) }}" target="_blank" style="background: #ffffff; color: #0284C7; border: 1px solid #CBD5E1; padding: 10px 16px; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease;" onmouseenter="this.style.borderColor='#0284C7'; this.style.background='#F0FDF4';" onmouseleave="this.style.borderColor='#CBD5E1'; this.style.background='#ffffff';">
                            <i class="fas fa-eye"></i> View Resolution
                        </a>
                        <a href="{{ asset('storage/' . $row->minute_file) }}" download style="background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; padding: 10px 16px; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.1);" onmouseenter="this.style.opacity='0.95'; transform: translateY(-1px);" onmouseleave="this.style.opacity='1';">
                            <i class="fas fa-cloud-download-alt"></i> Download
                        </a>
                    </div>

                </div>
            @empty
                <div style="background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 60px 40px; text-align: center; max-w: 600px; margin: 0 auto; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.02); box-sizing: border-box; width: 100%;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 28px; margin: 0 auto 20px; border: 1px dashed #CBD5E1;">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 style="color: #0F172A; font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">No Minutes Logged</h3>
                    <p style="color: #64748B; font-size: 13.5px; margin: 0; font-weight: 500; line-height: 1.6;">There are currently no active registered executive minutes or resolutions published on the board. Please check back later for updates.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
