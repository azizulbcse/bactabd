<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Official Announcements & Circulars | BACTA Bangladesh')

@section('content')
    <!-- 🚀 ১. আপনার About Us পেজ থেকে নেওয়া প্রিমিয়াম ডার্ক হেডার ব্যানার (টেলউইন্ড সিঙ্কড) -->
    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-2">Official Circulars</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Announcements Board</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">Announcements</span>
            </div>
        </div>
    </header>

    <!-- 🚀 ২. ওফিসিয়াল কর্পোরেট টাইমলাইন এবং ফ্লুইড লিস্ট সিএসএস থিম (NHCS স্ট্যান্ডার্ড) -->
    <style>
        .notice-body-wrapper {
            background-color: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 60px 0;
        }

        .notice-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* রাজকীয় মিনিমালিস্ট ভার্টিকাল টাইমলাইন আর্কিটেকচার */
        .timeline-wrapper {
            position: relative;
            padding-left: 30px;
            margin-bottom: 40px;
        }

        /* টাইমলাইনের মাঝখানের ওফিসিয়াল কানেক্টিং ট্র্যাক লাইন ভাই */
        .timeline-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 7px;
            width: 2px;
            height: 100%;
            background: #E2E8F0;
        }

        /* ধবধবে সাদা প্রিমিয়াম টাইমলাইন লিস্ট নোড কার্ড */
        .notice-node-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 30px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 25px;
            position: relative;
            margin-bottom: 30px;
            box-sizing: border-box;
            width: 100%;
        }

        /* টাইমলাইনের ট্র্যাক নোড গ্লোয়িং ডট */
        .notice-node-card::before {
            content: '';
            position: absolute;
            top: 38px;
            left: -27px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #0284C7;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .notice-node-card:hover {
            transform: translateX(5px);
            box-shadow: 0 20px 35px -10px rgba(2, 132, 199, 0.08);
            border-color: #0284C7;
        }

        .notice-node-card:hover::before {
            background: #1E40AF;
            box-shadow: 0 0 0 6px rgba(30, 64, 175, 0.2);
        }

        /* 📅 কাস্টম ক্যালেন্ডার ডেট স্ট্যাম্প উইজেট */
        .notice-date-stamp {
            width: 75px;
            height: 80px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .date-stamp-month {
            width: 100%;
            background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%);
            color: #ffffff;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            text-align: center;
            padding: 3px 0;
            letter-spacing: 0.5px;
        }

        .date-stamp-day {
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.1;
            margin-top: 4px;
        }

        .date-stamp-year {
            font-size: 10px;
            color: #94A3B8;
            font-weight: 600;
            margin-bottom: 2px;
        }

        /* নোটিশের শিরোনাম কন্টেন্ট জোন */
        .notice-details-zone {
            flex-grow: 1;
        }

        .notice-node-title {
            color: #0F172A;
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 6px 0;
            line-height: 1.4;
            transition: color 0.2s ease;
        }

        .notice-node-card:hover .notice-node-title {
            color: #0284C7;
        }

        /* 📱 ১০০% মোবাইল ও ট্যাবলেট রেসপন্সিভ মিডিয়া কোয়েরি */
        @media (max-width: 768px) {
            .notice-node-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 20px;
            }
            .notice-node-card::before {
                top: 25px;
            }
            .notice-action-hub-links {
                width: 100%;
                justify-content: flex-start !important;
                margin-top: 5px;
            }
        }
    </style>
<div class="notice-body-wrapper">
    <div class="notice-container">

        {{-- আপনার NHCS স্টাইলের সেই চিরচেনা ইনার সাব-হেডার কন্টেন্ট --}}
        <div class="nhcs-page-header" style="text-align: center; margin-bottom: 50px; border-bottom: 2px solid #E2E8F0; padding-bottom: 30px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #0284C7; margin: 0 0 10px 0; text-transform: uppercase;">অফিসিয়াল বিজ্ঞপ্তি বোর্ড</h2>
            <p style="color: #64748B; font-size: 15px; margin: 0;">Welcome to Our Society - Bangladesh Advanced Cardiovascular Track Association</p>
        </div>

        <!-- ==========================================
             🚀 CENTRAL ANNOUNCEMENTS TIMELINE GRID
             ========================================== -->
        <div class="timeline-wrapper">
            @forelse($notices as $row)
                <div class="notice-node-card">
                    
                    {{-- 📅 ডাইনামিক ক্যালেন্ডার ডেট স্ট্যাম্প উইজেট (তারিখ ট্র্যাকার ভাই) --}}
                    <div class="notice-date-stamp">
                        <span class="date-stamp-month">{{ $row->created_at->format('M') }}</span>
                        <span class="date-stamp-day">{{ $row->created_at->format('d') }}</span>
                        <span class="date-stamp-year">{{ $row->created_at->format('Y') }}</span>
                    </div>

                    {{-- নোটিশের শিরোনাম ও ইনফো মেটা জোন --}}
                    <div class="notice-details-zone">
                        <h3 class="notice-node-title">{{ $row->title }}</h3>
                        <div style="display: flex; gap: 15px; align-items: center; font-size: 12px; color: #94A3B8; font-weight: 500;">
                            <span><i class="far fa-clock text-[#0284C7] mr-1"></i> {{ $row->created_at->format('h:i A') }}</span>
                            <span><i class="far fa-file-alt text-[#0284C7] mr-1"></i> Official Circular</span>
                        </div>
                    </div>
                    {{-- 🎯 নোটিশের ডান পাশের প্রিমিয়াম ওয়ান-ক্লিক বাটন কন্ট্রোল হাব ভাই --}}
                    <div class="notice-action-hub-links" style="display: flex; gap: 10px; justify-content: flex-end; flex-shrink: 0;">
                        {{-- সরাসরি ব্রাউজারে অফিশিয়াল পিডিএফ দেখার ওয়ান-ট্যাপ লিঙ্ক উইজেট --}}
                        <a href="{{ asset('storage/' . $row->notice_file) }}" target="_blank" style="background: #ffffff; color: #0284C7; border: 1px solid #CBD5E1; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease;" onmouseenter="this.style.borderColor='#0284C7'; this.style.background='#F0FDF4';" onmouseleave="this.style.borderColor='#CBD5E1'; this.style.background='#ffffff';">
                            <i class="fas fa-eye"></i> View PDF
                        </a>
                        {{-- ওয়ান-ক্লিকে অফিশিয়াল পিডিএফ ডাউনলোড করার সিকিউর উইজেট --}}
                        <a href="{{ asset('storage/' . $row->notice_file) }}" download style="background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.1);" onmouseenter="this.style.opacity='0.95'; transform: translateY(-1px);" onmouseleave="this.style.opacity='1';">
                            <i class="fas fa-cloud-download-alt"></i> Download
                        </a>
                    </div>

                </div> {{-- .notice-node-card ক্লোজিং ভাই --}}
            @empty
                {{-- 💡 ডাটাবেজ ফাঁকা থাকলে মেম্বারদের জন্য সুন্দর ফলব্যাক মেসেজ এরিয়া ভাই --}}
                <div style="background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 60px 40px; text-align: center; max-w: 600px; margin: 0 auto; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.02);">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 28px; margin: 0 auto 20px; border: 1px dashed #CBD5E1;">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 style="color: #0F172A; font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">No Announcements Yet</h3>
                    <p style="color: #64748B; font-size: 13.5px; margin: 0; font-weight: 500; line-height: 1.6;">There are currently no active registered circulars or notices published on the central board. Please check back later for updates.</p>
                </div>
            @endforelse
        </div> {{-- .timeline-wrapper ক্লোজিং ভাই --}}

    </div> {{-- .notice-container ক্লোজিং ভাই --}}
</div> {{-- .notice-body-wrapper ক্লোজিং ভাই --}}
@endsection