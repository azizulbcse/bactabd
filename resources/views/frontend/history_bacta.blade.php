@extends('layouts.app')

@section('title', 'History of BACTA | Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists')

@section('content')
<!-- 🚀 ১. আন্তর্জাতিক মেডিকেল স্ট্যান্ডার্ড মার্জিত সিএসএস ইঞ্জিন ভাই -->
<style>
    .history-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 60px 0; box-sizing: border-box; }
    .history-container { width: 100%; max-width: 1000px; margin: 0 auto; padding: 0 24px; box-sizing: border-box; }
    
    /* 👑 ইন্টারঅ্যাক্টিভ মডার্ন কর্পোরেট আর্টিকেল প্যানেল ভাই */
    .history-card-panel { background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.06); padding: 45px; box-sizing: border-box; }
    
    .history-rich-text h2 { font-size: 22px; font-weight: 800; color: #0F172A; margin: 30px 0 15px 0; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid #F1F5F9; padding-bottom: 8px; }
    .history-rich-text p { font-size: 14.5px; line-height: 1.8; color: #475569; font-weight: 500; margin-bottom: 20px; text-align: justify; }
    
    /* 🎯 টাইমলাইন বা বুলেট পয়েন্টের প্রিমিয়াম টাচ নোড ভাই */
    .history-milestone-list { list-style: none; padding: 0; margin: 20px 0; }
    .history-milestone-item { position: relative; padding-left: 26px; margin-bottom: 15px; font-size: 14.5px; line-height: 1.7; color: #334155; font-weight: 600; }
    .history-milestone-item::before { content: ""; position: absolute; left: 0; top: 6px; width: 10px; height: 10px; background-color: #0284C7; border-radius: 50%; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15); }

    @media (max-width: 768px) {
        .history-card-panel { padding: 25px 20px; }
        .history-rich-text p { font-size: 13.5px; text-align: left; }
        .history-rich-text h2 { font-size: 19px; }
    }
</style>

<header class="bg-[#0F172A] relative overflow-hidden py-14 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#38BDF8] uppercase block mb-2">About the Association</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">History of BACTA</h1>
        </div>
    </div>
</header>

<div class="history-body-wrapper">
    <div class="history-container">
        <div class="history-card-panel">
            <div class="history-rich-text">
                
                <h2><i class="fa-solid fa-building-columns text-[#0284C7] text-lg"></i> Foundation & Genesis</h2>
                <p>The Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA) was established with a visionary mission to unify medical pioneers specialized in cardiothoracic and vascular anesthesia across the nation. Recognizing the critical advancements in perioperative cardiac care, BACTA emerged as the premier academic body dedicated to setting international standards of patient safety, clinical protocols, and specialized professional training in Bangladesh.</p>
                
                <h2><i class="fa-solid fa-bullseye text-[#DC2626] text-lg"></i> Academic Mission & Evolution</h2>
                <p>Over the years, BACTA has evolved from an elite medical network into a cornerstone of academic and clinical research. The association plays a pivotal role in organizing national congresses, scientific seminars, advanced echocardiography workshops, and executing continuous medical education (CME) frameworks to equip the next generation of cardiothoracic anesthesiologists with global best practices.</p>
                
                <h2><i class="fa-solid fa-graduation-cap text-[#16A34A] text-lg"></i> Core Objectives & Milestones</h2>
                <p>To further its clinical roadmap, the association strictly operates upon multi-tier baseline parameters aimed at enriching the nationwide medical landscape:</p>
                
                <ul class="history-milestone-list">
                    <li class="history-milestone-item">Formulating and implementing certified, unified cardiovascular perioperative anesthesia standards across all active registered registries in Bangladesh.</li>
                    <li class="history-milestone-item">Fostering breaking research pipelines and compiling global medical journals to represent Bangladesh on prestigious international cardiorespiratory academic platforms.</li>
                    <li class="history-milestone-item">Strengthening collaboration between senior clinical veterans, research fellows, and global healthcare device leaders to catalyze innovation.</li>
                </ul>

                <p class="mt-4 font-semibold text-slate-500 italic">Note: This historical archive is continuously reviewed and curated by the executive committee of BACTA Bangladesh.</p>
            </div>
        </div>
    </div>
</div>
@endsection
