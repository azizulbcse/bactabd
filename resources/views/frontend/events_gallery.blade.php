@extends('layouts.app')

@section('title', 'Scientific Events & Media Gallery | BACTA Bangladesh')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<header class="bg-[#0F172A] relative overflow-hidden py-12 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-1">Media & Scientific Archive</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">Events & Media Gallery</h1>
        </div>
        <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-200">Events & Gallery</span>
        </div>
    </div>
</header>

<style>
    .hub-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 50px 0; box-sizing: border-box; }
    .hub-container { width: 100%; max-width: 1140px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
    
    .hub-central-tabs-nav { display: flex; justify-content: center; gap: 15px; margin-bottom: 40px; border-bottom: 2px solid #E2E8F0; padding-bottom: 15px; }
    .hub-main-tab-btn { background: #ffffff; color: #64748B; border: 1px solid #CBD5E1; padding: 10px 24px; border-radius: 30px; font-size: 13.5px; font-weight: 700; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); }
    .hub-main-tab-btn:hover { border-color: #0284C7; color: #0284C7; }
    .hub-main-tab-btn.active-main-tab { background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff; border-color: transparent; box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.25); }
    
    .hub-sub-filter-bar { display: flex; justify-content: center; gap: 10px; margin-bottom: 35px; }
    .hub-sub-filter-btn { background: #F1F5F9; color: #475569; border: none; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; }
    .hub-sub-filter-btn:hover { background: #E2E8F0; color: #0F172A; }
    .hub-sub-filter-btn.active-sub-filter { background: #0F172A; color: #ffffff; }

    .events-layout-grid, .gallery-layout-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; width: 100%; box-sizing: border-box; }
    .event-premium-card { background: #ffffff; border-radius: 14px; border: 1px solid #E2E8F0; overflow: hidden; box-shadow: 0 4px 15px rgba(148, 163, 184, 0.03); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; height: 100%; position: relative; }
    .event-premium-card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px -8px rgba(2, 132, 199, 0.1); border-color: #0284C7; }
    
    /* 🎯 গ্যালারি মিডিয়া থাম্বনেইল ফ্রেম (১০০% পিক্সেল পারফেক্ট সমান্তরাল উচ্চতা ভাই) */
    .gallery-media-frame { width: 100%; height: 195px; background: #0F172A; overflow: hidden; position: relative; cursor: pointer; }
    .gallery-media-frame img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
    .gallery-media-frame:hover img { transform: scale(1.05); }
    
    /* 🎥 ভিডিও ওভারলে প্লে বাটন উইজেট */
    .video-play-overlay-icon { position: absolute; inset: 0; background: rgba(15, 23, 42, 0.4); display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 42px; opacity: 0.85; transition: all 0.3s ease; }
    .gallery-media-frame:hover .video-play-overlay-icon { opacity: 1; color: #EF4444; font-size: 46px; background: rgba(15, 23, 42, 0.5); }

    /* 👑 আন্তর্জাতিক থিয়েটার মোড লাইটবক্স কন্টেন্ট স্লাইডার সিএসএস */
    .bacta-lightbox-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.98); z-index: 99999; justify-content: center; align-items: center; padding: 20px; box-sizing: border-box; }
    .lightbox-nav-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.1); color: #ffffff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; cursor: pointer; transition: all 0.2s ease; z-index: 100000; outline: none; }
    .lightbox-nav-btn:hover { background: #0284C7; border-color: #0284C7; box-shadow: 0 0 15px rgba(2, 132, 199, 0.4); }
    .lightbox-prev-trigger { left: 30px; }
    .lightbox-next-trigger { right: 30px; }
    .lightbox-close-trigger { position: absolute; top: 25px; right: 30px; background: rgba(255, 255, 255, 0.08); border: none; color: #ffffff; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer; transition: all 0.2s ease; z-index: 100000; }
    .lightbox-close-trigger:hover { background: #EF4444; color: #ffffff; transform: rotate(90deg); }

    @media (max-width: 768px) {
        .hub-central-tabs-nav { flex-direction: column; gap: 10px; }
        .hub-main-tab-btn { width: 100%; justify-content: center; }
        .lightbox-nav-btn { width: 40px; height: 40px; font-size: 14px; }
        .lightbox-prev-trigger { left: 10px; }
        .lightbox-next-trigger { right: 10px; }
    }
</style>
<div class="hub-body-wrapper">
    <div class="hub-container">

        <!-- 🌐 ১. ২-লেয়ার আল্ট্রা-মডার্ন ফ্লুইড ক্যাটাগরি ট্যাব -->
        <div class="hub-central-tabs-nav">
            <button class="hub-main-tab-btn active-main-tab" onclick="switchCentralHubTab('events-zone', this)">
                <i class="fa-solid fa-calendar-check text-xs"></i> Scientific Events
            </button>
            <button class="hub-main-tab-btn" onclick="switchCentralHubTab('gallery-zone', this)">
                <i class="fa-solid fa-photo-film text-xs"></i> Central Media Gallery
            </button>
        </div>

        <!-- ==========================================
             🔒 ট্যাব ১: সায়েন্টিফিক ইভেন্টস পোর্টাল জোন
             ========================================== -->
        <div id="events-zone" class="hub-central-tab-content">
            <div class="events-layout-grid">
                @forelse($records->where('type', 1) as $row)
                    <div class="event-premium-card">
                        <div class="event-image-frame" style="width: 100%; height: 180px; background: #0F172A; overflow: hidden; position: relative;">
                            {{-- 🎯 ল্যাজি লোডিং ট্র্যাকিং: src এর বদলে data-src দিয়ে ইমেজ লক করা হলো ভাই --}}
                            <img class="bacta-lazy-asset" src="data:image/svg+xml;utf8,<svg xmlns='http://w3.org' viewBox='0 0 16 9' fill='%230f172a'/>" data-src="{{ asset('storage/' . $row->media_file) }}" alt="Event Banner" style="width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 0.4s ease;">
                            @if($row->event_date)
                                <div style="position: absolute; top: 12px; left: 12px; background: #0284C7; color: #ffffff; padding: 4px 10px; border-radius: 6px; font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 6px rgba(0,0,0,0.15); z-index: 5;">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($row->event_date)->format('d M, Y') }}
                                </div>
                            @endif
                        </div>
                        <div style="padding: 18px; display: flex; flex-direction: column; flex-grow: 1; box-sizing: border-box;">
                            <h3 style="font-size: 14.5px; font-weight: 700; color: #0F172A; margin: 0 0 10px 0; line-height: 1.4; flex-grow: 1;">{{ $row->title }}</h3>
                            @if($row->venue)
                                <div style="display: flex; align-items: flex-start; gap: 6px; font-size: 12px; color: #475569; font-weight: 500; border-top: 1px solid #F1F5F9; padding-top: 10px; margin-top: auto;">
                                    <i class="fa-solid fa-location-dot text-[#0284C7]" style="margin-top: 2px;"></i>
                                    <span>{{ $row->venue }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; background: #ffffff; border-radius: 14px; border: 1px solid #E2E8F0; padding: 45px 25px; text-align: center; max-w: 450px; margin: 0 auto; box-shadow: 0 4px 15px rgba(148, 163, 184, 0.02); box-sizing: border-box; width: 100%;">
                        <div style="width: 54px; height: 54px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 22px; margin: 0 auto 12px; border: 1px dashed #CBD5E1;"><i class="fa-solid fa-calendar-xmark"></i></div>
                        <h3 style="color: #0F172A; font-size: 14px; font-weight: 700; margin: 0 0 5px 0;">No Active Events Found</h3>
                        <p style="color: #64748B; font-size: 12.5px; margin: 0; font-weight: 500; line-height: 1.5;">There are currently no active registered scientific seminars scheduled on the timeline registry.</p>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- ==========================================
             🔒 ট্যাব ২: সেন্ট্রাল মিডিয়া গ্যালারি জোন
             ========================================== -->
        <div id="gallery-zone" class="hub-central-tab-content" style="display: none;">
            
            {{-- 📸 গ্যালারির ভেতরের সুনির্দিষ্ট সাব-ট্যাব ফিল্টার --}}
            <div class="hub-sub-filter-bar">
                <button class="hub-sub-filter-btn active-sub-filter" onclick="filterGalleryTypeNodes('all-node', this)"><i class="fa-solid fa-list"></i> All Media</button>
                <button class="hub-sub-filter-btn" onclick="filterGalleryTypeNodes('photo-node', this)"><i class="fa-solid fa-image"></i> Photos Only</button>
                <button class="hub-sub-filter-btn" onclick="filterGalleryTypeNodes('video-node', this)"><i class="fa-solid fa-circle-play"></i> Video Clips Only</button>
            </div>

            <div class="gallery-layout-grid">
                @php $galleryRecords = $records->whereIn('type', [2, 3]); @endphp
                @forelse($galleryRecords as $row)
                    <div class="gallery-item-card-wrapper {{ $row->type == 2 ? 'photo-node' : 'video-node' }} all-node" style="background: #ffffff; border-radius: 12px; border: 1px solid #E2E8F0; overflow: hidden; box-shadow: 0 4px 15px rgba(148, 163, 184, 0.02); box-sizing: border-box; transition: all 0.3s ease;">
                        
                        {{-- 🎯 ল্যাজি লোডিং থাম্বনেইল কন্টেইনার জোন --}}
                        <div class="gallery-media-frame">
                            @if($row->type == 2)
                                {{-- 📸 ছবির জন্য স্লাইডার ট্রিগার ভাই --}}
                                <img class="bacta-lazy-asset global-bacta-slide-node" 
                                     src="data:image/svg+xml;utf8,<svg xmlns='http://w3.org' viewBox='0 0 16 9' fill='%230f172a'/>" 
                                     data-src="{{ asset('storage/' . $row->media_file) }}" 
                                     data-type="image" 
                                     data-title="{{ $row->title }}" 
                                     onclick="launchBactaTheaterLightboxEngine(this)" 
                                     style="opacity: 0; transition: opacity 0.4s ease;">
                            @else
                                {{-- 🎥 ভিডিওর জন্য স্লাইডার ও মাল্টি-সোর্স ইউআরএল ডিটেকশন ভাই --}}
                                @php 
                                    $videoSourceUrl = asset('storage/' . $row->media_file);
                                    if ($row->video_url) {
                                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/ ]{11})/', $row->video_url, $match)) {
                                            $videoSourceUrl = "https://youtube.com" . $match[1];
                                        } else {
                                            $videoSourceUrl = $row->video_url;
                                        }
                                    }
                                @endphp
                                <img class="bacta-lazy-asset global-bacta-slide-node" 
                                     src="data:image/svg+xml;utf8,<svg xmlns='http://w3.org' viewBox='0 0 16 9' fill='%230f172a'/>" 
                                     data-src="data:image/svg+xml;utf8,<svg xmlns='http://w3.org' viewBox='0 0 16 9' fill='%231e293b'/>" 
                                     data-type="video" 
                                     data-video-src="{{ $videoSourceUrl }}" 
                                     data-title="{{ $row->title }}" 
                                     onclick="launchBactaTheaterLightboxEngine(this)" 
                                     style="opacity: 0; transition: opacity 0.4s ease;">
                                <div class="video-play-overlay-icon" onclick="this.previousElementSibling.click()"><i class="fa-solid fa-circle-play"></i></div>
                            @endif
                        </div>

                        <div style="padding: 16px; box-sizing: border-box; background: #ffffff;">
                            <h4 style="font-size: 13px; font-weight: 700; color: #0F172A; margin: 0; line-height: 1.4;">{{ $row->title }}</h4>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 50px 30px; text-align: center; max-width: 500px; margin: 0 auto; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.02); box-sizing: border-box; width: 100%;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 24px; margin: 0 auto 15px; border: 1px dashed #CBD5E1;"><i class="fa-solid fa-folder-open"></i></div>
                        <h3 style="color: #0F172A; font-size: 15px; font-weight: 700; margin: 0 0 6px 0;">No Media Assets Found</h3>
                        <p style="color: #64748B; font-size: 13px; margin: 0; font-weight: 500; line-height: 1.5;">The digital media repository containing photos and official recording sessions is currently empty.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div> {{-- .hub-container ক্লোজিং ভাই --}}
</div> {{-- .hub-body-wrapper ক্লোজিং ভাই --}}

<!-- ==========================================
     👑 আন্তর্জাতিক থিয়েটার মোড স্লাইডার লাইটবক্স উইন্ডো (X বাটন ও নেক্সট/প্রিভিয়াস ট্র্যাকার)
     ========================================== -->
<div id="bactaGlobalSliderTheater" class="bacta-lightbox-overlay">
    
    {{-- ❌ ওয়ান-ক্লিক ক্লোজ বাটন --}}
    <button class="lightbox-close-trigger" onclick="shutdownBactaTheaterEngine()"><i class="fa-solid fa-xmark"></i></button>
    
    {{-- ⬅️ প্রিভিয়াস স্লাইড বাটন --}}
    <button class="lightbox-nav-btn lightbox-prev-trigger" onclick="navigateBactaTheaterSlides(-1)"><i class="fa-solid fa-chevron-left"></i></button>
    
    {{-- ➡️ নেক্সট স্লাইড বাটন --}}
    <button class="lightbox-nav-btn lightbox-next-trigger" onclick="navigateBactaTheaterSlides(1)"><i class="fa-solid fa-chevron-right"></i></button>
    
    {{-- 🖥️ ডাইনামিক সেন্ট্রাল মিডিয়া কন্টেন্ট ভিউয়ার এরিয়া --}}
    <div style="max-width: 900px; width: 100%; display: flex; flex-direction: column; align-items: center; gap: 15px; position: relative;">
        <div id="theaterCentralMediaContainer" style="width: 100%; height: 75vh; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 12px; background: #000000; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.7);">
            <!-- JavaScript Will Live Inject Content Here -->
        </div>
        <div id="theaterAssetTitleCaption" style="color: #ffffff; font-family: 'Poppins'; font-size: 14.5px; font-weight: 600; text-align: center; width: 100%; background: rgba(15,23,42,0.6); padding: 10px; border-radius: 8px; box-sizing: border-box; letter-spacing: 0.3px;"></div>
    </div>
</div>
<script>
    let activeSlideIndex = 0;
    let visibleSlideNodesArray = [];

    // ১. আপনার লজিক: মেইন ট্যাব (Events / Gallery) পেজ রিলোড ছাড়া সুইচ করার ইঞ্জিন ভাই
    function switchCentralHubTab(targetZoneId, buttonElement) {
        let contents = document.querySelectorAll('.hub-central-tab-content');
        contents.forEach(node => node.style.display = 'none');
        document.getElementById(targetZoneId).style.display = 'block';
        
        let buttons = document.querySelectorAll('.hub-main-tab-btn');
        buttons.forEach(btn => btn.classList.remove('active-main-tab'));
        buttonElement.classList.add('active-main-tab');
        
        // ট্যাব বদলালে ইনডেক্স ও স্লাইডার মেমোরি রি-ক্যালকুলেট হবে ভাই
        rebuildActiveSlideRegistry();
    }

    // ২. আপনার লজিক: গ্যালারির ভেতর সাব-ট্যাব (Photos / Videos) নিখুঁত আলাদা ফিল্টারিং লুপ ভাই
    function filterGalleryTypeNodes(targetClassName, buttonElement) {
        let items = document.querySelectorAll('.gallery-item-card-wrapper');
        items.forEach(card => {
            if (card.classList.contains(targetClassName)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        let buttons = document.querySelectorAll('.hub-sub-filter-btn');
        buttons.forEach(btn => btn.classList.remove('active-sub-filter'));
        buttonElement.classList.add('active-sub-filter');
        
        // ফিল্টার বদলালে ইনডেক্স ও স্লাইডার মেমোরি রি-ক্যালকুলেট হবে ভাই
        rebuildActiveSlideRegistry();
    }

    // ৩. আপনার লজিক: স্ক্রিনে বর্তমান দৃশ্যমান কার্ডগুলোর স্লাইড ইনডেক্সিং রেজিস্ট্রি উইজেট ভাই
    function rebuildActiveSlideRegistry() {
        visibleSlideNodesArray = [];
        let activeTabZone = document.querySelector('.hub-central-tab-content[style*="display: block"]') || document.querySelector('.hub-central-tab-content:not([style*="display: none"])');
        
        if (activeTabZone) {
            let allSlidesInTab = activeTabZone.querySelectorAll('.global-bacta-slide-node');
            allSlidesInTab.forEach(slide => {
                let cardWrapper = slide.closest('.gallery-item-card-wrapper') || slide.closest('.event-premium-card');
                if (!cardWrapper || cardWrapper.style.display !== 'none') {
                    visibleSlideNodesArray.push(slide);
                }
            });
        }
    }

    // ৪. আপনার লজিক: রাজকীয় থিয়েটার মোড লাইটবক্স স্লাইডার মডাল উইন্ডো ইঞ্জিন ভাই
    function launchBactaTheaterLightboxEngine(clickedSlideNode) {
        rebuildActiveSlideRegistry();
        activeSlideIndex = visibleSlideNodesArray.indexOf(clickedSlideNode);
        if (activeSlideIndex === -1) activeSlideIndex = 0;
        
        renderTheaterTargetSlide();
        document.getElementById('bactaGlobalSliderTheater').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // ব্যাকগ্রাউন্ড স্ক্রলিং লক ভাই
    }

    function renderTheaterTargetSlide() {
        if (visibleSlideNodesArray.length === 0) return;
        let slide = visibleSlideNodesArray[activeSlideIndex];
        let mediaContainer = document.getElementById('theaterCentralMediaContainer');
        let captionContainer = document.getElementById('theaterAssetTitleCaption');
        
        let type = slide.getAttribute('data-type');
        let title = slide.getAttribute('data-title');
        
        captionContainer.textContent = title;
        mediaContainer.innerHTML = '';

        if (type === 'image') {
            let src = slide.getAttribute('data-src') || slide.src;
            let img = document.createElement('img');
            img.src = src;
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            img.style.objectFit = 'contain';
            img.style.borderRadius = '6px';
            mediaContainer.appendChild(img);
        } else if (type === 'video') {
            let videoSrc = slide.getAttribute('data-video-src');
            if (videoSrc.includes('youtube.com') || videoSrc.includes('embed')) {
                let iframe = document.createElement('iframe');
                iframe.src = videoSrc + (videoSrc.includes('?') ? '&' : '?') + 'autoplay=1';
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.border = 'none';
                iframe.setAttribute('allow', 'autoplay; fullscreen');
                iframe.setAttribute('allowfullscreen', '');
                mediaContainer.appendChild(iframe);
            } else {
                let video = document.createElement('video');
                video.src = videoSrc;
                video.controls = true;
                video.autoplay = true;
                video.style.maxWidth = '100%';
                video.style.maxHeight = '100%';
                video.style.objectFit = 'contain';
                mediaContainer.appendChild(video);
            }
        }
    }

    function navigateBactaTheaterSlides(directionSteps) {
        if (visibleSlideNodesArray.length === 0) return;
        activeSlideIndex += directionSteps;
        
        if (activeSlideIndex >= visibleSlideNodesArray.length) {
            activeSlideIndex = 0;
        } else if (activeSlideIndex < 0) {
            activeSlideIndex = visibleSlideNodesArray.length - 1;
        }
        
        renderTheaterTargetSlide();
    }

    function shutdownBactaTheaterEngine() {
        let mediaContainer = document.getElementById('theaterCentralMediaContainer');
        mediaContainer.innerHTML = ''; // আইফ্রেম বা ভিডিও প্লেয়ার স্টপ হবে ভাই
        document.getElementById('bactaGlobalSliderTheater').style.display = 'none';
        document.body.style.overflow = ''; // ব্যাকগ্রাউন্ড স্ক্রলিং রিলিজ ভাই
    }

    // ৫. আপনার লজিক: মাউস স্ক্রলের সাথে সাথে ছবি ও ভিডিও ব্যাকগ্রাউন্ডে অটো-লোড করার ল্যাজি অবজারভার ইঞ্জিন ভাই
    document.addEventListener("DOMContentLoaded", function() {
        rebuildActiveSlideRegistry();

        let lazyAssetsArray = [].slice.call(document.querySelectorAll(".bacta-lazy-asset"));
        
        if ("IntersectionObserver" in window) {
            let assetObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let targetAsset = entry.target;
                        if (targetAsset.getAttribute('data-src')) {
                            targetAsset.src = targetAsset.getAttribute('data-src');
                        }
                        targetAsset.style.opacity = '1';
                        assetObserver.unobserve(targetAsset);
                    }
                });
            }, { rootMargin: "0px 0px 200px 0px" }); // স্ক্রিন স্ক্রল করার ২০০ পিক্সেল আগেই রিকোয়েস্ট লোড লকড ভাই

            lazyAssetsArray.forEach(function(lazyAsset) {
                assetObserver.observe(lazyAsset);
            });
        } else {
            // ওল্ড ব্রাউজার ফলব্যাক মেকানিজম ভাই
            lazyAssetsArray.forEach(function(asset) {
                if (asset.getAttribute('data-src')) {
                    asset.src = asset.getAttribute('data-src');
                }
                asset.style.opacity = '1';
            });
        }

        // 🔒 কিবোর্ড ট্র্যাকিং: ডানে-বামে কি চাপলে স্লাইড চেঞ্জ হবে এবং Esc চাপলে ক্লোজ হবে ভাই ভাই
        document.addEventListener('keydown', function(event) {
            let theaterModal = document.getElementById('bactaGlobalSliderTheater');
            if (theaterModal && theaterModal.style.display === 'flex') {
                if (event.key === 'ArrowRight') {
                    navigateBactaTheaterSlides(1);
                } else if (event.key === 'ArrowLeft') {
                    navigateBactaTheaterSlides(-1);
                } else if (event.key === 'Escape') {
                    shutdownBactaTheaterEngine();
                }
            }
        });

        // লাইটবক্সের ছবির বাইরে ফাঁকা কালো জায়গায় ক্লিক করলে মডাল বন্ধ হবে ভাই
        let theaterOverlay = document.getElementById('bactaGlobalSliderTheater');
        if (theaterOverlay) {
            theaterOverlay.addEventListener('click', function(e) {
                if (e.target === theaterOverlay) {
                    shutdownBactaTheaterEngine();
                }
            });
        }
    });
</script>
@endsection
