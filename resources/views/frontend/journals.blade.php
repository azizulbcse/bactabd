<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Scientific Journals & Publications | BACTA Bangladesh')

@section('content')

    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-2">Research & Publications</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Scientific Journals</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">Journals</span>
            </div>
        </div>
    </header>

    <style>
        .jr-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 60px 0; box-sizing: border-box; }
        .jr-container { width: 100%; max-width: 1100px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
        .jr-section-title { font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #64748B; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 8px; }

        .jr-featured-card { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 18px; padding: 30px; display: flex; gap: 30px; box-shadow: 0 10px 30px -8px rgba(2, 132, 199, 0.08); margin-bottom: 60px; flex-wrap: wrap; }
        .jr-cover-lg { width: 220px; height: 300px; object-fit: cover; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); flex-shrink: 0; }
        .jr-cover-lg-placeholder { width: 220px; height: 300px; border-radius: 12px; background: #F1F5F9; border: 1px dashed #CBD5E1; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 40px; flex-shrink: 0; }

        .jr-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
        .jr-card { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 18px; display: flex; flex-direction: column; transition: all 0.25s ease; }
        .jr-card:hover { border-color: #0284C7; box-shadow: 0 15px 30px -10px rgba(2, 132, 199, 0.15); transform: translateY(-3px); }
        .jr-cover-sm { width: 100%; height: 190px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .jr-cover-sm-placeholder { width: 100%; height: 190px; border-radius: 10px; background: #F1F5F9; border: 1px dashed #CBD5E1; display: flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 30px; }

        .jr-article-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 8px 10px; border-radius: 8px; background: #F8FAFC; margin-bottom: 6px; font-size: 12.5px; }
        .jr-article-title { color: #0F172A; font-weight: 600; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .jr-article-actions { display: flex; gap: 6px; flex-shrink: 0; }
        .jr-btn-tiny { padding: 4px 9px; border-radius: 6px; font-size: 10.5px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
        .jr-btn-tiny-read { background: #EFF6FF; color: #0284C7; }
        .jr-btn-tiny-read:hover { background: #DBEAFE; }
        .jr-btn-tiny-download { background: #0284C7; color: #ffffff; }
        .jr-btn-tiny-download:hover { background: #1E40AF; }

        details.jr-accordion > summary { cursor: pointer; list-style: none; }
        details.jr-accordion > summary::-webkit-details-marker { display: none; }
        details.jr-accordion[open] .jr-chevron { transform: rotate(180deg); }
    </style>

    <div class="jr-wrapper">
        <div class="jr-container">

            @if($latestJournal)
                <div class="jr-section-title"><i class="fa-solid fa-star text-amber-400"></i> Current Issue / Latest Volume</div>

                <div class="jr-featured-card">
                    @if(!empty($latestJournal->cover_image) && file_exists(public_path($latestJournal->cover_image)))
                        <img src="{{ asset($latestJournal->cover_image) }}" class="jr-cover-lg" alt="{{ $latestJournal->title }} cover">
                    @else
                        <div class="jr-cover-lg-placeholder"><i class="fa-solid fa-book-open"></i></div>
                    @endif

                    <div style="flex: 1; min-width: 260px;">
                        <span style="display:inline-block; background:#DCFCE7; color:#166534; font-size:11px; font-weight:700; padding:4px 10px; border-radius:999px; margin-bottom:10px;">
                            <i class="fa-solid fa-globe mr-1"></i> Live Catalog
                        </span>
                        <h2 style="font-size: 22px; font-weight: 800; color: #0F172A; margin: 0 0 8px 0;">{{ $latestJournal->title }}</h2>
                        <p style="color:#475569; font-size:13.5px; margin:0 0 4px 0;"><i class="fa-solid fa-user-edit mr-2 text-slate-400"></i>{{ $latestJournal->author_name }}</p>
                        <p style="color:#64748B; font-size:13px; margin:0 0 20px 0;"><i class="fa-solid fa-layer-group mr-2 text-slate-400"></i>{{ $latestJournal->volume_issue }} &nbsp;|&nbsp; <i class="far fa-calendar-alt mr-1 text-slate-400"></i>{{ $latestJournal->publishing_date }}</p>

                        <div style="font-size:11px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; color:#94A3B8; margin-bottom:10px;">Articles In This Issue</div>

                        @if($latestJournal->articles->count() > 0)
                            <div style="max-height: 260px; overflow-y: auto; padding-right: 4px;">
                                @foreach($latestJournal->articles as $article)
                                    <div class="jr-article-row">
                                        <span class="jr-article-title"><i class="fa-solid fa-file-pdf text-red-500 mr-1"></i>{{ $article->article_title }}</span>
                                        <div class="jr-article-actions">
                                            <a href="{{ asset($article->pdf_file) }}" target="_blank" class="jr-btn-tiny jr-btn-tiny-read"><i class="fa-solid fa-eye"></i> Read</a>
                                            <a href="{{ asset($article->pdf_file) }}" download class="jr-btn-tiny jr-btn-tiny-download"><i class="fa-solid fa-circle-arrow-down"></i> Download</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p style="color:#94A3B8; font-size:12.5px; font-style:italic;">Articles are being indexed. Please check back shortly.</p>
                        @endif
                    </div>
                </div>
            @endif

            <div class="jr-section-title"><i class="fa-solid fa-clock-rotate-left"></i> Past Archives & Volumes</div>

            @if($archivedJournals->count() > 0)
                <div class="jr-grid">
                    @foreach($archivedJournals as $archive)
                        <div class="jr-card">
                            @if(!empty($archive->cover_image) && file_exists(public_path($archive->cover_image)))
                                <img src="{{ asset($archive->cover_image) }}" class="jr-cover-sm mb-3" alt="{{ $archive->title }} cover">
                            @else
                                <div class="jr-cover-sm-placeholder mb-3"><i class="fa-solid fa-book"></i></div>
                            @endif

                            <span style="display:inline-block; background:#F1F5F9; color:#475569; font-size:10.5px; font-weight:700; padding:3px 9px; border-radius:999px; margin-bottom:8px; align-self:flex-start;">{{ $archive->volume_issue }}</span>
                            <h3 style="font-size:14.5px; font-weight:700; color:#0F172A; margin:0 0 4px 0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $archive->title }}">{{ $archive->title }}</h3>
                            <p style="color:#94A3B8; font-size:12px; margin:0 0 14px 0;"><i class="fa-solid fa-user mr-1"></i>{{ $archive->author_name }}</p>

                            <details class="jr-accordion" style="margin-top: auto;">
                                <summary style="display:flex; align-items:center; justify-content:space-between; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:9px 12px; font-size:12px; font-weight:700; color:#0284C7;">
                                    <span><i class="fa-solid fa-list-ol mr-1"></i> View Articles ({{ $archive->articles->count() }})</span>
                                    <i class="fa-solid fa-chevron-down jr-chevron" style="transition: transform 0.2s ease; font-size: 10px;"></i>
                                </summary>
                                <div style="margin-top: 8px; max-height: 200px; overflow-y: auto;">
                                    @forelse($archive->articles as $art)
                                        <div class="jr-article-row">
                                            <span class="jr-article-title"><i class="fa-solid fa-file-lines text-red-500 mr-1"></i>{{ $art->article_title }}</span>
                                            <div class="jr-article-actions">
                                                <a href="{{ asset($art->pdf_file) }}" target="_blank" class="jr-btn-tiny jr-btn-tiny-read"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ asset($art->pdf_file) }}" download class="jr-btn-tiny jr-btn-tiny-download"><i class="fa-solid fa-circle-arrow-down"></i></a>
                                            </div>
                                        </div>
                                    @empty
                                        <p style="color:#94A3B8; font-size:11.5px; font-style:italic; padding: 6px 4px;">No articles indexed yet.</p>
                                    @endforelse
                                </div>
                            </details>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background:#ffffff; border:1px solid #E2E8F0; border-radius:16px; padding:60px 40px; text-align:center;">
                    <i class="fa-solid fa-folder-open text-slate-300 mb-3" style="font-size: 40px;"></i>
                    <h3 style="color:#0F172A; font-size:15px; font-weight:700; margin:0 0 6px 0;">No Archived Volumes Yet</h3>
                    <p style="color:#94A3B8; font-size:13px; margin:0;">Previously published journal issues will appear here.</p>
                </div>
            @endif

        </div>
    </div>
@endsection
