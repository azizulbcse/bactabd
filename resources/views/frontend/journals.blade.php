{{-- 👑 ফ্রন্টএন্ড মাস্টার লেআউট এক্সটেন্ড নোড (আপনার ওরিজিনাল থিম সিঙ্কড) --}}
@extends('layouts.app')

@section('content')
<!-- ১. গ্লোবাল লাক্সারি অ্যানিমেশন ও ট্রানজিশন সিএসএস ইন্জেকশন ভাই -->
<link rel="stylesheet" href="https://cloudflare.com"/>
<style>
    .bct-luxury-card {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }
    .bct-luxury-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 73, 106, 0.1);
    }
    .bct-cover-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .bct-archive-cover {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .bct-btn-read {
        background-color: #00496A;
        color: #ffffff !important;
        border-radius: 6px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .bct-btn-read:hover {
        background-color: #00ADEF;
    }
    .bct-btn-download {
        background-color: #dc3545;
        color: #ffffff !important;
        border-radius: 6px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .bct-btn-download:hover {
        background-color: #bd2130;
    }
</style>

<div class="container py-5" style="font-family: 'Poppins', sans-serif;">
    <!-- ==========================================
         👑 SECTION ১: CURRENT ISSUE / LATEST VOLUME (টপ উইন্ডো ভাই)
         ========================================== -->
    @if($latestJournal)
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-12 mb-4">
                <h3 class="font-weight-bold text-uppercase border-bottom pb-2" style="color: #00496A; letter-spacing: 1px;">
                    <i class="fas fa-star text-warning mr-2"></i> Current Issue / Latest Volume
                </h3>
            </div>
            
            <div class="col-md-12">
                <div class="card bct-luxury-card p-4" style="border-left: 5px solid #00496A !important;">
                    <div class="row align-items-center">
                        {{-- বাম পাশে: আপনার সেই রাজকীয় কাভার পেজ বড় থাম্বনেইল ভাই --}}
                        <div class="col-md-4 text-center">
                            @if(!empty($latestJournal->cover_image) && file_exists(public_path($latestJournal->cover_image)))
                                <img src="{{ asset($latestJournal->cover_image) }}" class="bct-cover-img" alt="Journal Cover">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded shadow" style="width: 100%; height: 380px; max-width: 270px;">
                                    <i class="fas fa-book-open text-muted" style="font-size: 64px; color: #00ADEF !important;"></i>
                                </div>
                            @endif
                        </div>
                        
                        {{-- ডান পাশে: জার্নাল মেইন ডিরেক্টরি পরিচিতি প্যানেল --}}
                        <div class="col-md-8 mt-4 mt-md-0">
                            <span class="badge badge-success px-3 py-2 mb-2 font-weight-bold text-uppercase"><i class="fas fa-globe mr-1"></i> Live Catalog</span>
                            <h2 class="font-weight-bold mb-2" style="color: #00496A; font-size: 26px;">{{ $latestJournal->title }}</h2>
                            <p class="text-muted mb-1" style="font-size: 15px;"><i class="fas fa-user-edit mr-2"></i><strong>Principal Author:</strong> {{ $latestJournal->author_name }}</p>
                            <p class="text-secondary mb-3" style="font-size: 14px;"><i class="fas fa-layer-group mr-2"></i><strong>Master Volume:</strong> {{ $latestJournal->volume_issue }} | <i class="fas fa-calendar-alt mr-1"></i> Released: {{ $latestJournal->publishing_date }}</p>
                            {{-- জিপ থেকে আনপ্যাক হওয়া প্রতিটা আর্টিকেলের লাইভ লিস্ট উইন্ডো নোড ভাই --}}
                            <h5 class="font-weight-bold text-secondary mt-4 mb-2 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Extracted PDF Articles Inside:</h5>
                            @if($latestJournal->articles->count() > 0)
                                <div class="accordion shadow-xs border rounded bg-white p-2" id="latestAccordion" style="max-height: 250px; overflow-y: auto;">
                                    @foreach($latestJournal->articles as $index => $article)
                                        <div class="d-flex align-items-center justify-content-between border-bottom py-2 px-2 animate__animated animate__fadeIn" style="font-size: 13px;">
                                            <div class="text-truncate mr-2" style="max-width: 60%;">
                                                <span class="font-weight-bold text-dark d-block text-truncate"><i class="fas fa-file-pdf text-danger mr-2"></i>{{ $article->article_title }}</span>
                                            </div>
                                            
                                            <div class="d-flex gap-1">
                                                {{-- 🚀 ১. জিরো-বাফারিং গুগল ডক্স আইফ্রেম এম্বেডেড লাইভ রিডার গেটওয়ে বোতাম ভাই --}}
                                                <a href="https://google.com{{ urlencode(asset($article->pdf_file)) }}&embedded=true" target="_blank" class="btn btn-xs bct-btn-read px-2 py-1 text-xs mr-1">
                                                    <i class="fas fa-book-reader"></i> Read
                                                </a>
                                                {{-- 👑 ২. আপনার চাওয়া সেই রাজকীয় ডাইরেক্ট হাই-স্পিড সিকিউর ডাউনলোড বোতাম ভাই --}}
                                                <a href="{{ asset($article->pdf_file) }}" download class="btn btn-xs bct-btn-download px-2 py-1 text-xs">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-light border small text-muted"><i class="fas fa-info-circle mr-1"></i> Scientific chapters are being indexed by administration.</div>
                            @endif
                        </div> {{-- col-md-8 end --}}
                    </div> {{-- row align-items-center end --}}
                </div> {{-- card end --}}
            </div> {{-- col-md-12 end --}}
        </div> {{-- row mb-5 end --}}
    @endif
    <!-- ==========================================
         👑 SECTION ২: PAST ARCHIVES / VOLUMES LIST (৩-কলাম ক্যাটালগ গ্রিড ভাই)
         ========================================== -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <h3 class="font-weight-bold text-uppercase border-bottom pb-2" style="color: #64748b; letter-spacing: 1px;">
                <i class="fas fa-history text-secondary mr-2"></i> Past Archives & Volumes List
            </h3>
        </div>

        @forelse($archivedJournals as $archive)
            {{-- ৩-কলামের পিক্সেল-পারফেক্ট রেসপন্সিভ গ্রিড কন্টেইনার ভাই --}}
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bct-luxury-card h-100 p-3 d-flex flex-column justify-content-between">
                    <div class="text-center mb-3">
                        @if(!empty($archive->cover_image) && file_exists(public_path($archive->cover_image)))
                            <img src="{{ asset($archive->cover_image) }}" class="bct-archive-cover" alt="Archive Cover">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center mx-auto rounded shadow-xs" style="width: 100%; height: 220px;">
                                <i class="fas fa-book text-muted" style="font-size: 48px; color: #cbd5e1 !important;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <span class="badge badge-light border text-muted px-2 py-1 mb-2 font-weight-bold" style="font-size: 11px;">{{ $archive->volume_issue }}</span>
                        <h5 class="font-weight-bold text-dark text-truncate mb-1" style="font-size: 15px;" title="{{ $archive->title }}">{{ $archive->title }}</h5>
                        <small class="text-muted d-block mb-3"><i class="fas fa-user mr-1"></i> {{ $archive->author_name }}</small>
                    </div>

                    {{-- ওয়ান-টাচ একর্ডিয়ন ড্রপডাউন বোতাম যা ফোল্ডার জ্যাম সাফ রাখবে ভাই --}}
                    <div class="dropdown mt-auto">
                        <button class="btn btn-block btn-sm btn-outline-secondary dropdown-toggle font-weight-bold" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-list-ol mr-1"></i> View Articles ({{ $archive->articles->count() }})
                        </button>
                        <div class="dropdown-menu dropdown-menu-right w-100 shadow border-light p-2" style="max-height: 200px; overflow-y: auto; font-size: 12px;">
                            @forelse($archive->articles as $art)
                                <div class="dropdown-item d-flex justify-content-between align-items-center border-bottom py-2" style="gap: 5px;">
                                    <span class="text-truncate mr-2 font-weight-bold" style="max-width: 55%;"><i class="fas fa-file-alt text-danger mr-1"></i> {{ $art->article_title }}</span>
                                    <div class="d-flex shrink-0">
                                        {{-- ১. লাইভ ফাস্ট রিডার --}}
                                        <a href="https://google.com{{ urlencode(asset($art->pdf_file)) }}&embedded=true" target="_blank" class="badge badge-info p-1 mr-1 text-uppercase" style="font-size: 9px;"><i class="fas fa-eye"></i> Read</a>
                                        {{-- ২. হাই-স্পিড সিকিউর ডাউনলোড --}}
                                        <a href="{{ asset($art->pdf_file) }}" download class="badge badge-danger p-1 text-uppercase" style="font-size: 9px;"><i class="fas fa-download"></i> Down</a>
                                    </div>
                                </div>
                            @empty
                                <small class="text-muted p-2 d-block text-center">No indexed papers.</small>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- ডাটাবেজে কোনো আর্কাইভ ডেটা না থাকলে ফলব্যাক ব্যানার নোড --}}
            <div class="col-12 text-center py-5">
                <i class="fas fa-folder-open text-muted mb-3" style="font-size: 48px;"></i>
                <h5 class="text-secondary font-weight-bold">No Archived Volumes Registered Yet!</h5>
                <p class="text-muted small">All previously unpacked compressed scientific documents will auto-catalog here.</p>
            </div>
        @endforelse
    </div> {{-- row mt-5 end --}}
</div> {{-- container py-5 end --}}
@endsection
