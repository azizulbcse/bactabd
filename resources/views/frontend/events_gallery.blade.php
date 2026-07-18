@extends('layouts.app')

@section('content')
<!-- =========================================================================
     👑 🔒 বিএসিটিএ অল-ডিভাইস স্মার্ট গ্যালারি হাব: লেজি লোডিং এবং স্ট্যাটাস ২ (LIVE) ফিল্টার নোড ভাই (১/৩)
     ========================================================================= -->
<div class="py-8 md:py-12 bg-[#F8FAFC] min-h-screen border-t border-slate-100 bacta-custom-nav-font">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 🎯 ক) মেগা আল্ট্রা-স্মার্ট হেডার ব্যানার জোন ভাই (রয়্যাল ব্লু ও সায়েন অ্যাকসেন্ট ব্লেন্ড) -->
        <div class="bg-[#1A4B84] text-white rounded-2xl p-6 md:p-10 shadow-xl relative overflow-hidden mb-8 border border-white/10">
            <div class="relative z-10 max-w-3xl">
                <span class="bg-[#00ADB5] text-white text-xs font-black uppercase tracking-wider px-3 py-1 rounded-full">Media Center</span>
                <h1 class="text-3xl md:text-5xl font-black tracking-wide mt-3 mb-4 text-[#93C5FD]">Events & Media Gallery</h1>
                <p class="text-sm md:text-base text-slate-200 font-bold leading-relaxed">
                    বাংলাদেশ অ্যাসোসিয়েশন অব কার্ডিওভাসকুলার অ্যান্ড থোরাসিক অ্যানেশেসিওলজিস্টস (BACTA) এর অধীনে আয়োজিত বিভিন্ন বৈজ্ঞানিক সেমিনার, সম্মেলন এবং অফিসিয়াল ইভেন্টের প্রামাণ্য চিত্র ও ভিডিও গ্যালারি আর্কাইভ ভাই।
                </p>
            </div>
            <!-- ব্যাকগ্রাউন্ড হার্ট-পালস কিউট আভা ভাই -->
            <div class="absolute -right-10 -bottom-10 opacity-10 text-white">
                <svg class="w-44 h-44 md:w-64 md:h-64" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
        </div>

        <!-- 🎯 খ) ওয়ান-ক্লিক জিরো-রিলোড ফিল্টার ট্যাব প্যানেল ভাই (রয়্যাল ব্লু ও সায়েন থিম ম্যাচড) -->
        <div class="flex items-center justify-center gap-2 md:gap-4 mb-10 overflow-x-auto pb-2 whitespace-nowrap">
            <button onclick="switchGalleryMediaTypeFilter('all', this)" class="px-5 py-2 rounded-xl text-xs md:text-sm font-black uppercase tracking-wider transition-all duration-300 shadow-sm border border-[#1A4B84] bg-[#1A4B84] text-white focus:outline-none">
                <i class="fas fa-th-large mr-1.5"></i> All Assets
            </button>
            <button onclick="switchGalleryMediaTypeFilter('photos', this)" class="px-5 py-2 rounded-xl text-xs md:text-sm font-black uppercase tracking-wider transition-all duration-300 shadow-sm border border-slate-200 bg-white text-slate-700 hover:border-[#1A4B84] hover:text-[#1A4B84] focus:outline-none">
                <i class="fas fa-camera mr-1.5"></i> Photos
            </button>
            <button onclick="switchGalleryMediaTypeFilter('videos', this)" class="px-5 py-2 rounded-xl text-xs md:text-sm font-black uppercase tracking-wider transition-all duration-300 shadow-sm border border-slate-200 bg-white text-slate-700 hover:border-[#1A4B84] hover:text-[#1A4B84] focus:outline-none">
                <i class="fas fa-video mr-1.5"></i> Videos
            </button>
        </div>
        <!-- 🎯 গ) মেইন ৩-কলাম আল্ট্রা-স্মার্ট মিডিয়া গ্রিড কন্টেইনার জেনারেটর ভাই -->
        <div id="bactaLiveMediaGridHub" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <!-- ⚡ জাভাস্ক্রিপ্ট এপিআই থেকে শুধুমাত্র STATUS 2 ওয়ালা ডেটা কার্ড আকারে এখানে অটো-রেন্ডার হবে ভাই -->
        </div>

        <!-- 🎯 ঘ) ডাটাবেজ খালি থাকলে কিউট ফালব্যাক এম্পটি বক্স উইন্ডো ভাই -->
        <div id="bactaEmptyGalleryFallback" style="display: none;" class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm mt-4">
            <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2V-5a2 2 0 00-2-2H9l-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <h3 class="text-lg font-black text-slate-700">No Approved Assets Found</h3>
            <p class="text-sm font-bold text-slate-400 mt-1">We are currently updating our repository. Please check back later ভাই!</p>
        </div>

        <!-- 🎯 ঙ) মাউস স্ক্রল করলে লাইভ ডেটা ফেচিং স্পিনার লোডার নোড ভাই -->
        <div id="bactaInfiniteScrollSpinnerLoader" class="flex items-center justify-center py-10 opacity-0 transition-opacity duration-300">
            <div class="animate-spin rounded-full h-8 w-8 border-4 border-[#00ADB5]/20 border-t-[#00ADB5]"></div>
        </div>

    </div>
</div>

<!-- =========================================================================
     👑 🔒 চ) ইউনিভার্সাল লাক্সারি লাইটবক্স ওভারলে উইন্ডো: ছবি ও কাস্টম প্লেয়ার ২-ইন-১ হাব ভাই
     ========================================================================= -->
<div id="bactaUnifiedLightboxOverlay" style="display: none; background: rgba(15, 23, 42, 0.95);" class="fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-md opacity-0 transition-opacity duration-300">
    
    <!-- ওয়ান-ক্লিক ক্লোজ ব্যারিকেড বাটন ভাই (সায়েন হোভার ইফেক্ট) -->
    <button onclick="closeBactaUnifiedLightboxWindow()" class="absolute top-4 right-4 text-white/70 hover:text-[#00ADB5] text-2xl md:text-3xl transition-colors focus:outline-none p-2">
        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l18 18"/></svg>
    </button>

    <!-- মেইন কন্টেন্ট উইন্ডো জোন ভাই (ম্যাক্স সাইজ লকড) -->
    <div class="max-w-5xl w-full max-h-[85vh] flex flex-col items-center justify-center relative">
        
        <!-- ১. ছবি রেন্ডারিং ইমেজ নোড ভাই -->
        <img id="lightboxTargetImageFrame" style="display: none;" class="max-w-full max-h-[80vh] object-contain rounded-xl shadow-2xl border border-white/10" src="" alt="BACTA Live Premium Asset">
        
        <!-- ২. Video রেন্ডারিং আইফ্রেম/ভিডিও কন্টেইনার ভাই -->
        <div id="lightboxTargetVideoWrapper" style="display: none;" class="w-full aspect-video rounded-xl overflow-hidden shadow-2xl border border-white/10 bg-black">
            <!-- জাভাস্ক্রিপ্ট এখানে লাইভ ভিডিও প্লেয়ার ইনজেক্ট করবে ভাই -->
        </div>

        <!-- ৩. মিডিয়া ডাইনামিক ক্যাপশন বা টাইটেল নোড ভাই -->
        <div id="lightboxMediaCaptionNode" class="text-white text-center text-sm md:text-base font-black tracking-wide mt-4 px-4 drop-shadow-md max-w-3xl"></div>
    </div>
</div>
<!-- =========================================================================
     👑 🔒 ছ-১) বিএসিটিএ গ্যালারি ড্রাইভার: ডাটা লোডার এবং জিরো-রিলোড ফিল্টার (১/২)
     ========================================================================= -->
<script>
    let currentGalleryPage = 1;
    let totalGalleryPages = 1;
    let isGalleryStreamLoading = false;
    let activeMediaTypeFilter = 'all';
    let galleryIntersectionObserver = null;

    document.addEventListener("DOMContentLoaded", function() {
        fetchLiveGalleryAssetsFromServer();
        initiateBactaGalleryInfiniteScroll();
    });

    function switchGalleryMediaTypeFilter(filterType, buttonElement) {
        if (activeMediaTypeFilter === filterType || isGalleryStreamLoading) return;
        activeMediaTypeFilter = filterType;
        currentGalleryPage = 1;
        
        let buttons = buttonElement.parentElement.querySelectorAll('button');
        buttons.forEach(function(btn) {
            btn.className = "px-5 py-2 rounded-xl text-xs md:text-sm font-black uppercase tracking-wider transition-all duration-300 shadow-sm border border-slate-200 bg-white text-slate-700 hover:border-[#1A4B84] hover:text-[#1A4B84] focus:outline-none";
        });
        buttonElement.className = "px-5 py-2 rounded-xl text-xs md:text-sm font-black uppercase tracking-wider transition-all duration-300 shadow-sm border border-[#1A4B84] bg-[#1A4B84] text-white focus:outline-none";

        document.getElementById('bactaLiveMediaGridHub').innerHTML = '';
        fetchLiveGalleryAssetsFromServer();
    }

    function fetchLiveGalleryAssetsFromServer() {
        if (isGalleryStreamLoading) return;
        isGalleryStreamLoading = true;

        let spinner = document.getElementById('bactaInfiniteScrollSpinnerLoader');
        if (spinner) spinner.style.opacity = '1';
let targetUrl = "/gallery-stream?page=" + currentGalleryPage + "&type=" + activeMediaTypeFilter;
        
        fetch(targetUrl)
            .then(function(response) { return response.json(); })
            .then(function(data) {
                totalGalleryPages = data.last_page;
                let assetsList = data.data;
                let gridHub = document.getElementById('bactaLiveMediaGridHub');
                let fallbackBox = document.getElementById('bactaEmptyGalleryFallback');

                if (currentGalleryPage === 1 && assetsList.length === 0) {
                    fallbackBox.style.display = 'block';
                } else {
                    fallbackBox.style.display = 'none';
                    
                    assetsList.forEach(function(asset) {
                        let cardElement = document.createElement('div');
                        cardElement.className = "group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100 transition-all duration-300 flex flex-col relative cursor-pointer";
                        
                        let categoryBadge = '';
                        if (asset.type == 1) categoryBadge = '<span class="bg-[#EFF6FF] text-[#1E40AF]">Seminar</span>';
                        else if (asset.type == 2) categoryBadge = '<span class="bg-[#ECFDF5] text-[#065F46]">Photo</span>';
                        else categoryBadge = '<span class="bg-[#FFF7ED] text-[#9A3412]">Video</span>';

                        let mediaCoverHtml = '';
                        if (asset.type == 3) {
                            let videoThumb = asset.media_file ? "/storage/" + asset.media_file : 'https://unsplash.com';
                            mediaCoverHtml = '<div class="relative aspect-video w-full overflow-hidden bg-slate-900"><img src="' + videoThumb + '" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80" alt="' + asset.title + '"><div class="absolute inset-0 flex items-center justify-center"><div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/40 group-hover:scale-110 group-hover:bg-[#00ADB5] transition-all duration-300 shadow-lg"><svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div></div></div>';
                        } else {
                            let imagePath = asset.media_file ? "/storage/" + asset.media_file : 'https://unsplash.com';
                            mediaCoverHtml = '<div class="relative aspect-video w-full overflow-hidden bg-slate-100"><img src="' + imagePath + '" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="' + asset.title + '"></div>';
                        }

                        let venueHtml = asset.venue ? '<p class="text-[11px] font-bold text-slate-400 flex items-center gap-1 mt-auto m-0"><svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span class="truncate">' + asset.venue + '</span></p>' : '';
                        let assetDate = asset.event_date ? new Date(asset.event_date).toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' }) : 'Recent';

                        cardElement.innerHTML = mediaCoverHtml + '<div class="p-5 flex flex-col flex-grow text-left"><div class="flex items-center justify-between gap-2 mb-2 text-[10px] font-black uppercase tracking-wider"><div class="flex items-center gap-1.5 text-slate-400"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg><span>' + assetDate + '</span></div><div class="px-2 py-0.5 rounded font-bold">' + categoryBadge + '</div></div><h3 class="text-sm md:text-base font-black text-slate-800 line-clamp-2 group-hover:text-[#1A4B84] transition-colors leading-snug flex-grow mb-2">' + asset.title + '</h3>' + venueHtml + '</div>';

                        cardElement.addEventListener('click', function() { openBactaUnifiedLightboxWindow(asset); });
                        gridHub.appendChild(cardElement);
                    });
                }
                isGalleryStreamLoading = false;
                if (spinner) spinner.style.opacity = '0';
            })
            .catch(function(err) {
                isGalleryStreamLoading = false;
                if (spinner) spinner.style.opacity = '0';
            });
    }
</script>
<script>
    // 🚀 ২. মডার্ন ইন্টারসেকশন Observer ইনফিনিটি স্ক্রল ট্র্যাকার ইঞ্জিন ভাই
    function initiateBactaGalleryInfiniteScroll() {
        let spinnerNode = document.getElementById('bactaInfiniteScrollSpinnerLoader');
        if (!spinnerNode) return;

        galleryIntersectionObserver = new IntersectionObserver(function(entries) {
            if (entries.isIntersecting && !isGalleryStreamLoading && currentGalleryPage < totalGalleryPages) {
                currentGalleryPage++;
                fetchLiveGalleryAssetsFromServer();
            }
        }, { rootMargin: '150px' });

        galleryIntersectionObserver.observe(spinnerNode);
    }

    // 🚀 ৩. ইউনিভার্সাল লাইটবক্স পপ-আপ ওপেনার উইন্ডো মেথড ভাই
    function openBactaUnifiedLightboxWindow(asset) {
        let lightbox = document.getElementById('bactaUnifiedLightboxOverlay');
        let imgFrame = document.getElementById('lightboxTargetImageFrame');
        let videoWrapper = document.getElementById('lightboxTargetVideoWrapper');
        let captionNode = document.getElementById('lightboxMediaCaptionNode');

        imgFrame.style.display = 'none';
        videoWrapper.style.display = 'none';
        videoWrapper.innerHTML = '';
        captionNode.textContent = asset.title;

        if (asset.type == 3) {
            videoWrapper.style.display = 'block';
            if (asset.video_url) {
                let videoId = '';
                // 🎯 🔒 ওয়ান-ক্লিক পিওর ইউটিউব আইডি এক্সট্রাকশন ফিক্স (অ্যারে ইনডেক্সিং ১০০% সিকিউর নোড ভাই)
                if (asset.video_url.indexOf('youtu.be/') !== -1) {
                    let urlParts = asset.video_url.split('youtu.be/');
                    if (urlParts && urlParts[1]) {
                        let queryParts = urlParts[1].split(/[?#]/);
                        videoId = queryParts[0] || '';
                    }
                } else if (asset.video_url.indexOf('v=') !== -1) {
                    let urlParts = asset.video_url.split('v=');
                    if (urlParts && urlParts[1]) {
                        let queryParts = urlParts[1].split('&');
                        videoId = queryParts[0] || '';
                    }
                }
                videoWrapper.innerHTML = '<iframe class="w-full h-full border-0" src="https://www.youtube.com/embed/' + videoId + '?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } else {
                let localVideoPath = asset.media_file ? "/storage/" + asset.media_file : '';
                videoWrapper.innerHTML = '<video controls autoplay class="w-full h-full object-contain focus:outline-none"><source src="' + localVideoPath + '" type="video/mp4">Your browser does not support the video tag.</video>';
            }
        } else {
            imgFrame.style.display = 'block';
            imgFrame.src = asset.media_file ? "/storage/" + asset.media_file : 'https://unsplash.com';
        }

        lightbox.style.display = 'flex';
        setTimeout(function() { lightbox.classList.remove('opacity-0'); lightbox.classList.add('opacity-100'); }, 50);
        document.body.style.overflow = 'hidden';
    }

    // 🚀 ৪. ওয়ান-ক্লিক লাইটবক্স উইন্ডো ক্লোজার এবং মেমোরি রিলিজ নোড ভাই
    function closeBactaUnifiedLightboxWindow() {
        let lightbox = document.getElementById('bactaUnifiedLightboxOverlay');
        let videoWrapper = document.getElementById('lightboxTargetVideoWrapper');
        
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0');
        
        setTimeout(function() { 
            lightbox.style.display = 'none'; 
            videoWrapper.innerHTML = ''; // ভিডিও প্লে স্টপ ও মেমোরি রিলিজ ভাই
        }, 300);
        document.body.style.overflow = '';
    }
</script>
@endsection
