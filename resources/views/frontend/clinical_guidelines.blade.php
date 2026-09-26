<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Clinical Guidelines | BACTA Bangladesh')

@section('content')

<header class="bg-[#0F172A] relative overflow-hidden py-12 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-1">Clinical Resources</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">Clinical Guidelines</h1>
        </div>
        <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-200">Clinical Guidelines</span>
        </div>
    </div>
</header>

<style>
    .cg-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 50px 0; box-sizing: border-box; }
    .cg-container { width: 100%; max-width: 1140px; margin: 0 auto; padding: 0 16px; box-sizing: border-box; }
    .cg-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 22px; width: 100%; }
    .cg-public-card {
        background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 24px;
        box-shadow: 0 4px 15px rgba(148, 163, 184, 0.04); transition: all 0.3s ease; box-sizing: border-box;
        display: flex; flex-direction: column;
    }
    .cg-public-card:hover { transform: translateY(-3px); border-color: #0284C7; box-shadow: 0 12px 25px -5px rgba(2, 132, 199, 0.08); }
    .cg-public-badge {
        background: rgba(2, 132, 199, 0.08); color: #0284C7; padding: 3px 10px; border-radius: 12px;
        font-size: 10.5px; font-weight: 700; text-transform: uppercase; display: inline-block; width: fit-content; margin-bottom: 10px;
    }
    .cg-public-title { font-size: 16.5px; font-weight: 700; color: #0F172A; margin: 0 0 8px 0; line-height: 1.4; }
    .cg-public-desc { font-size: 13px; color: #64748B; line-height: 1.6; flex-grow: 1; white-space: pre-line; }
    .cg-public-footer { margin-top: 16px; padding-top: 14px; border-top: 1px solid #F1F5F9; display: flex; align-items: center; justify-content: space-between; }
    .cg-public-date { font-size: 11px; color: #94A3B8; font-weight: 500; }
    .cg-public-download {
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; padding: 8px 14px; border-radius: 8px;
        font-size: 12px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    }
    @media (max-width: 480px) {
        .cg-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="cg-body-wrapper">
    <div class="cg-container">

        <div style="text-align: center; margin-bottom: 40px; border-bottom: 2px solid #E2E8F0; padding-bottom: 25px;">
            <h2 style="font-size: 24px; font-weight: 700; color: #0284C7; margin: 0 0 8px 0; text-transform: uppercase;">Perioperative Protocols &amp; Standards</h2>
            <p style="color: #64748B; font-size: 14px; margin: 0;">Official clinical guidelines, echo standards, and protocols published by BACTA</p>
        </div>

        <div class="cg-grid">
            @forelse($guidelines as $row)
                <div class="cg-public-card">
                    @if($row->category)
                        <span class="cg-public-badge">{{ $row->category }}</span>
                    @endif
                    <h3 class="cg-public-title">{{ $row->title }}</h3>
                    @if($row->description)
                        <p class="cg-public-desc">{{ $row->description }}</p>
                    @endif
                    <div class="cg-public-footer">
                        <span class="cg-public-date"><i class="far fa-clock"></i> {{ $row->created_at->format('d M, Y') }}</span>
                        @if($row->guideline_file)
                            <a href="{{ asset($row->guideline_file) }}" target="_blank" class="cg-public-download">
                                <i class="fas fa-cloud-download-alt"></i> Download
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 60px 40px; text-align: center; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.02);">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 28px; margin: 0 auto 20px; border: 1px dashed #CBD5E1;">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3 style="color: #0F172A; font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">No Guidelines Published Yet</h3>
                    <p style="color: #64748B; font-size: 13.5px; margin: 0; font-weight: 500; line-height: 1.6;">Please check back later for official clinical guidelines and protocols.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
