<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Lifetime Fellows | BACTA Bangladesh')

@section('content')
    <!-- 🚀 ১. আপনার About Us পেজ থেকে নেওয়া প্রিমিয়াম ডার্ক হেডার ব্যানার (টেলউইন্ড সিঙ্কড) -->
    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#F59E0B] uppercase block mb-2">Honored Directory</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Lifetime Fellows</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">Lifetime Fellows</span>
            </div>
        </div>
    </header>

    <!-- 🚀 ২. আল্ট্রা-মডার্ন ৪-কলাম কালারফুল গ্রেডিয়েন্ট এবং ভাইব্রেন্ট কার্ড ইউআই থিম (NHCS স্ট্যান্ডার্ড) -->
    <style>
        .modern-body-wrapper {
            background-color: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 50px 0;
        }

        .nhcs-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* আজীবন ফেলোদের জন্য ৪-কলামের স্পেশাল ডিরেক্টরি গ্রিড */
        .fellows-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-bottom: 40px;
        }

        /* ধবধবে সাদা বর্ডারলেস প্রিমিয়াম ফেলো কার্ড */
        .fellow-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            width: calc(25% - 19px); /* আন্তর্জাতিক ৪-কলাম লেআউট লক ভাই */
            max-width: 280px;
            position: relative;
        }

        /* লাইফটাইম ফেলোদের জন্য রাজকীয় গোল্ডেন-অরেঞ্জ টপ বার গ্রেডিয়েন্ট */
        .fellow-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 5px;
            background: linear-gradient(90deg, #D97706, #F59E0B);
        }

        .fellow-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -10px rgba(217, 119, 6, 0.12);
            border-color: #F59E0B;
        }

        /* 📸 ডাইনামিক গোল্ডেন বর্ডারসহ বৃত্তাকার ইমেজ ফ্রেম */
        .fellow-avatar-zone {
            width: 115px;
            height: 115px;
            margin: 0 auto 18px;
            border-radius: 50%;
            padding: 4px;
            background: linear-gradient(135deg, #D97706 0%, #F59E0B 100%);
            box-shadow: 0 6px 15px rgba(217, 119, 6, 0.15);
        }

        .fellow-avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #ffffff;
            background-color: #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fellow-avatar-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fellow-badge-title {
            display: inline-block;
            background: rgba(217, 119, 6, 0.08);
            color: #D97706;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .fellow-doc-name {
            color: #0F172A;
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }

        .fellow-med-title {
            color: #64748B;
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 14px;
        }

        /* কালারফুল ডাইনামিক বড় নাম এবং শর্ট নাম মিক্সড হসপিটাল উইজেট */
        .fellow-hospital-tag {
            font-size: 11.5px;
            color: #1E293B;
            font-weight: 600;
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 10px 12px;
            border-radius: 10px;
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .fellow-short-badge {
            font-size: 9.5px;
            background: linear-gradient(135deg, #D97706 0%, #F59E0B 100%);
            color: #ffffff;
            padding: 1px 7px;
            border-radius: 4px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* 📱 ১০০% মোবাইল ও ট্যাবলেট রেসপন্সিভ মিডিয়া কোয়েরি */
        @media (max-width: 991px) {
            .fellow-card { width: calc(33.333% - 17px); }
        }
        @media (max-width: 768px) {
            .fellow-card { width: calc(50% - 13px); }
        }
        @media (max-width: 480px) {
            .fellow-card { width: 100%; max-width: 100%; }
        }
    </style>
<div class="modern-body-wrapper">
    <div class="nhcs-container">

        {{-- আপনার NHCS স্টাইলের সেই চিরচেনা ইনার সাব-হেডার কন্টেন্ট --}}
        <div class="nhcs-page-header" style="text-align: center; margin-bottom: 50px; border-bottom: 2px solid #E2E8F0; padding-bottom: 30px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #D97706; margin: 0 0 10px 0; text-transform: uppercase;">সম্মানিত আজীবন ফেলোবৃন্দ</h2>
            <p style="color: #64748B; font-size: 15px; margin: 0;">Welcome to Our Society - Bangladesh Advanced Cardiovascular Track Association</p>
        </div>

        <!-- ==========================================
             🚀 LIFETIME FELLOWS CORE PANEL (৪-কলাম গ্রিড)
             ========================================== -->
        {{-- 🎯 এই কন্টেইনারের আইডির ভেতরেই জাভাস্ক্রিপ্ট স্ক্রল ডাটাগুলো সুন্দরভাবে পুশ করবে --}}
        <div class="fellows-grid" id="infinite-fellow-container">
            @foreach($fellows as $row)
                <div class="fellow-card animate__animated animate__fadeIn">
                    <div class="fellow-avatar-zone">
                        <div class="fellow-avatar-inner">
                            @if($row->member_pic)
                                <img src="{{ asset('storage/' . $row->member_pic) }}" alt="{{ $row->name }}" loading="lazy">
                            @else
                                <div style="font-size:32px; color:#64748B;"><i class="fas fa-user-md"></i></div>
                            @endif
                        </div>
                    </div>
                    <div><span class="fellow-badge-title">{{ $row->bactaDesignation->title ?? 'Lifetime Fellow' }}</span></div>
                    <h3 class="fellow-doc-name">{{ $row->name }}</h3>
                    <div class="fellow-med-title">{{ $row->medicalDesignation->title ?? 'N/A' }}</div>
                    
                    {{-- 💡 বড় নাম এবং শর্ট নাম উইজেট সিঙ্ক --}}
                    <div class="fellow-hospital-tag">
                        <span class="text-center" style="font-size: 11px;"><i class="fas fa-hospital text-[#D97706] mr-1"></i> {{ $row->hospital->name ?? 'N/A' }}</span>
                        @if($row->hospital->short_name)
                            <span class="fellow-short-badge">({{ $row->hospital->short_name }})</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{-- ⏳ সাইলেন্ট গর্জিয়াস স্ক্রল লোডার এলিমেন্ট (মাউস নিচে নামলে এটি ট্রিপ করবে) --}}
        <div id="scroll-infinity-loader" class="text-center my-4 d-none" style="padding: 20px 0;">
            <div class="spinner-border" role="status" style="width: 2.5rem; height: 2.5rem; color: #D97706 !important; border: .25em solid currentColor; border-right-color: transparent; display: inline-block; border-radius: 50%; animation: spinner-border .75s linear infinite;">
                <span class="sr-only">Loading more fellows...</span>
            </div>
            <p class="text-muted mt-2 font-weight-bold" style="font-size: 13px; letter-spacing: 0.5px;">Loading more honored fellows...</p>
        </div>

    </div> {{-- .nhcs-container ক্লোজিং --}}
</div> {{-- .modern-body-wrapper ক্লোজিং --}}
{{-- 🚀 আল্ট্রা-স্মার্ট ইনফিনিটি স্ক্রল অবজার্ভার জাভাস্ক্রিপ্ট জোন --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ল্যারাভেলের পেজিনেশন ট্র্যাকিং ভেরিয়েবল (কন্ট্রোলার থেকে ডাইনামিক লিংক রিড)
        let nextPageUrl = "{{ method_exists($fellows, 'nextPageUrl') ? $fellows->nextPageUrl() : '' }}";
        let container = document.getElementById('infinite-fellow-container');
        let loader = document.getElementById('scroll-infinity-loader');
        let isLoading = false;

        // যদি কোনো কারণে পেজ লিংক না থাকে, তবে অবজার্ভার রান করার দরকার নেই
        if (!nextPageUrl) return;

        // আন্তর্জাতিক মানের নেটিভ ইন্টারসেকশন অবজার্ভার ইঞ্জিন
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px 300px 0px', // ইউজার নিচে পৌঁছানোর ৩০০ পিক্সেল আগেই ডাটা লোড শুরু হবে ভাই
            threshold: 0
        };

        const scrollObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                // ইউজার যখনই স্ক্রল করে লোডারের কাছাকাছি যাবে এবং কোনো রানিং লোড থাকবে না
                if (entry.isIntersecting && !isLoading && nextPageUrl) {
                    loadMoreFellowsData();
                }
            });
        }, observerOptions);

        // লোডার এলিমেন্টটিকে অবজার্ভারের ট্র্যাকিং লিস্টে যুক্ত করা হলো
        scrollObserver.observe(loader);

        function loadMoreFellowsData() {
            isLoading = true;
            loader.classList.remove('d-none'); // সাইলেন্ট স্পিনার চালু হলো

            // ব্রাউজারের সিকিউর ভ্যানিলা ফেচ এপিআই (Fetch API) দিয়ে ডাটা কল
            fetch(nextPageUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // ফেচ করা HTML টেক্সট থেকে শুধু নতুন মেম্বার কার্ডের পার্টটুকু ফিল্টার করা হলো
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                let newCards = doc.getElementById('infinite-fellow-container');

                if (newCards && newCards.children.length > 0) {
                    // নতুন কার্ডগুলো আমাদের মেইন লেআউট গ্রিডের নিচে সুন্দর নতুন হাসপাতালের ডাবল ট্যাগসহ যুক্ত করে দেওয়া হলো
                    Array.from(newCards.children).forEach(card => {
                        container.appendChild(card);
                    });
                }

                // ল্যারাভেলের পরবর্তী পেজের ইউআরএল ব্যাকএন্ড থেকে রি-আপডেট
                let paginationNextElement = doc.querySelector('a[rel="next"]');
                nextPageUrl = paginationNextElement ? paginationNextElement.getAttribute('href') : '';

                isLoading = false;
                loader.classList.add('d-none'); // লোডিং শেষ, স্পিনার হাইড হলো

                // যদি আর কোনো ডাটা না থাকে, তবে অবজার্ভার বন্ধ হয়ে যাবে ভাই
                if (!nextPageUrl) {
                    scrollObserver.unobserve(loader);
                }
            })
            .catch(error => {
                console.error("Infinity scroll gating error:", error);
                isLoading = false;
                loader.classList.add('d-none');
            });
        }
    });
</script>

@endsection
