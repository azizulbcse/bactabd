<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Medical Journals & Research Catalog | BACTA Bangladesh')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- 🚀 ১. আপনার নোটিশ ও মিনিট পেজ থেকে নেওয়া প্রিমিয়াম ডার্ক হেডার ব্যানার (টেলউইন্ড সিঙ্কд) -->
    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-2">Scientific Library & Index</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Journals (BACTA)</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">Journals</span>
            </div>
        </div>
    </header>

    <!-- 🚀 ২. ওফিসিয়াল ডিজিটাল সায়েন্টিফিক ক্যাটালগ গ্রিড সিএসএস থিম (NHCS স্ট্যান্ডার্ড) -->
    <style>
        .journals-body-wrapper {
            background-color: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 60px 0;
            box-sizing: border-box;
        }

        .journals-container {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .journals-layout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 30px;
            width: 100%;
            box-sizing: border-box;
        }

        .journal-catalog-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            padding: 28px;
            box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
            box-sizing: border-box;
        }

        .journal-catalog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(2, 132, 199, 0.08);
            border-color: #0284C7;
        }

        .journal-icon-badge {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(2, 132, 199, 0.06);
            color: #0284C7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .journal-catalog-card:hover .journal-icon-badge {
            background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%);
            color: #ffffff;
            box-shadow: 0 8px 15px rgba(2, 132, 199, 0.2);
        }

        .journal-doc-title {
            color: #0F172A;
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 12px 0;
            line-height: 1.5;
            flex-grow: 1;
        }

        @media (max-width: 640px) {
            .journals-layout-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .journal-catalog-card {
                padding: 20px;
            }
        }
    </style>
<div class="journals-body-wrapper">
    <div class="journals-container">

        {{-- আপনার এনএইচসিএস থিমের সেই চিরচেনা ইনার সাব-হেডার কন্টেন্ট ভাই --}}
        <div class="nhcs-page-header" style="text-align: center; margin-bottom: 50px; border-bottom: 2px solid #E2E8F0; padding-bottom: 30px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #0284C7; margin: 0 0 10px 0; text-transform: uppercase;">Scientific Journals Archive</h2>
            <p style="color: #64748B; font-size: 15px; margin: 0;">Peer-Reviewed Publications and Medical Research Registry</p>
        </div>

        <!-- ==========================================
             🚀 CENTRAL JOURNALS DIGITAL CATALOG GRID
             ========================================== -->
        <div class="journals-layout-grid">
            @forelse($journals as $row)
                <div class="journal-catalog-card">
                    
                    {{-- 📚 ডাইনামিক লাইব্রেরি বুক আইকন ব্যাজ উইজেট ভাই --}}
                    <div class="journal-icon-badge">
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>

                    {{-- জার্নাল টাইটেল ও মেটা ক্যাটালগ ইনফো জোন --}}
                    <h3 class="journal-doc-title">{{ $row->title }}</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 12.5px; color: #475569; font-weight: 500; margin-bottom: 24px; border-top: 1px solid #F1F5F9; padding-top: 14px;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #0F172A; font-weight: 600;">
                            <i class="fa-solid fa-user-doctor text-[#0284C7]" style="width: 14px;"></i>
                            <span>{{ $row->author_name }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #1E40AF; font-weight: 600;">
                            <i class="fa-solid fa-bookmark text-indigo-500" style="width: 14px;"></i>
                            <span>{{ $row->volume_issue }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #94A3B8; font-size: 11px;">
                            <i class="far fa-clock text-slate-400" style="width: 14px;"></i>
                            <span>Indexed on {{ $row->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                    {{-- 🎯 জার্নালের নিচে প্রিমিয়াম ওয়ান-ক্লিক অ্যাকশন বাটন কন্ট্রোল হাব ভাই --}}
                    <div style="display: flex; gap: 10px; margin-top: auto; width: 100%; box-sizing: border-box;">
                        <a href="{{ asset('storage/' . $row->journal_file) }}" target="_blank" style="flex: 1; text-center; background: #ffffff; color: #0284C7; border: 1px solid #CBD5E1; padding: 10px 0; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s ease;" onmouseenter="this.style.borderColor='#0284C7'; this.style.background='#EFF6FF';" onmouseleave="this.style.borderColor='#CBD5E1'; this.style.background='#ffffff';">
                            <i class="fa-solid fa-file-lines"></i> View Document
                        </a>
                        <a href="{{ asset('storage/' . $row->journal_file) }}" download style="flex: 1; text-center; background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; padding: 10px 0; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(2, 132, 199, 0.1);" onmouseenter="this.style.opacity='0.95'; transform: translateY(-1px);" onmouseleave="this.style.opacity='1';">
                            <i class="fa-solid fa-circle-arrow-down"></i> Download PDF
                        </a>
                    </div>

                </div> {{-- .journal-catalog-card ক্লোজিং ভাই --}}
            @empty
                {{-- 💡 ডাটাবেজ ফাঁকা থাকলে মেম্বারদের জন্য সুন্দর ফলব্যাক মেসেজ এরিয়া ভাই --}}
                <div style="grid-column: 1 / -1; background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 60px 40px; text-align: center; max-width: 550px; margin: 0 auto; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.02); box-sizing: border-box; width: 100%;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 28px; margin: 0 auto 20px; border: 1px dashed #CBD5E1;">
                        <i class="fa-solid fa-book-medical"></i>
                    </div>
                    <h3 style="color: #0F172A; font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">No Journals Indexed</h3>
                    <p style="color: #64748B; font-size: 13.5px; margin: 0; font-weight: 500; line-height: 1.6;">There are currently no active registered scientific publications or peer-reviewed research papers available in the catalog.</p>
                </div>
            @endforelse
        </div> {{-- .journals-layout-grid ক্লোজিং ভাই --}}

    </div> {{-- .journals-container ক্লোজিং ভাই --}}
</div> {{-- .journals-body-wrapper ক্লোজিং ভাই --}}
@endsection
