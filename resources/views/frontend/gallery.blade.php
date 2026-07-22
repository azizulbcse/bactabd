@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
@section('title', 'Gallery | BACTA Bangladesh')

@section('content')

<style>
    .bct-nav-tabs {
        display: flex !important;
        flex-wrap: wrap;
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .bct-nav-tabs .nav-item {
        list-style: none;
    }
    .bct-nav-tabs .nav-link {
        display: inline-flex;
        align-items: center;
        border: none;
        color: #64748b;
        font-weight: bold;
        padding: 12px 28px;
        border-radius: 30px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        background: #f1f5f9;
        margin-right: 12px;
        text-decoration: none !important;
        cursor: pointer;
    }
    .bct-nav-tabs .nav-link.active {
        background-color: #00496A !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(0, 73, 106, 0.25);
    }
    .bct-gallery-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
        cursor: pointer;
    }
    .bct-gallery-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 73, 106, 0.12);
        border-color: #00ADEF;
    }
    .bct-gallery-img-wrapper {
        position: relative;
        height: 260px;
        overflow: hidden;
        background: #0f172a;
    }
    .bct-gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .bct-gallery-card:hover .bct-gallery-img {
        transform: scale(1.06);
    }
    .bct-hover-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 73, 106, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .bct-gallery-card:hover .bct-hover-overlay {
        opacity: 1;
    }
    .bct-hover-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #ffffff;
        color: #00496A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transform: scale(0.8);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .bct-gallery-card:hover .bct-hover-icon {
        transform: scale(1);
    }
    /* Lightbox */
    .bct-lightbox-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.95);
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
        padding: 20px;
    }
    .lightbox-content-box {
        position: relative;
        width: 100%;
        max-width: 900px;
        max-height: 85vh;
        animation: bctZoomIn 0.3s ease;
    }
    @keyframes bctZoomIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .lightbox-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        color: #ffffff;
        border: 1px solid rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
        z-index: 2;
    }
    .lightbox-nav-btn:hover {
        background: #00ADEF;
        border-color: #00ADEF;
        color: #ffffff;
    }
    /* Desktop: buttons sit outside the content box. Falls back inside on small screens. */
    .lightbox-prev { left: -70px; }
    .lightbox-next { right: -70px; }
    @media (max-width: 991.98px) {
        .lightbox-prev { left: 10px; }
        .lightbox-next { right: 10px; }
    }
    .lightbox-close-btn {
        position: absolute;
        top: -46px;
        right: 0;
        font-size: 32px;
        line-height: 1;
        color: rgba(255,255,255,0.7);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 2;
    }
    .lightbox-close-btn:hover { color: #dc3545; }

    #lightboxMediaRenderBody {
        width: 100%;
        min-height: 260px;
    }
    #lightboxMediaRenderBody img {
        max-width: 100%;
        max-height: 75vh;
        border-radius: 8px;
        object-fit: contain;
    }
    .bct-video-frame-wrap {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 */
        border-radius: 8px;
        overflow: hidden;
    }
    .bct-video-frame-wrap iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Self-contained tab show/hide — does NOT depend on the parent layout's
       Bootstrap version/CSS. If the host theme's Bootstrap JS/CSS differs
       (v4 vs v5) or overrides .fade/.show, tabs used to break (both panels
       showing at once, or neither switching). These rules + the manual JS
       toggle below guarantee correct behaviour regardless of the host page. */
    #galleryTabContent > .tab-pane {
        display: none !important;
    }
    #galleryTabContent > .tab-pane.bct-active {
        display: block !important;
    }

    /* Self-contained gallery grid — does NOT rely on Bootstrap's row/col-*
       classes (those weren't producing a real grid on the live site,
       causing every card to stack full-width, one per row). Flexbox +
       justify-content:center is used (instead of CSS Grid) so that when
       there are fewer items than columns, they sit centered on the page
       rather than left-aligned with a big empty gap on the right. */
    .bct-gallery-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 24px;
    }
    .bct-gallery-item {
        box-sizing: border-box;
        flex: 0 0 calc((100% - 3 * 24px) / 4); /* 4 per row */
        max-width: calc((100% - 3 * 24px) / 4);
    }
    @media (max-width: 1199.98px) {
        .bct-gallery-item {
            flex-basis: calc((100% - 2 * 24px) / 3); /* 3 per row */
            max-width: calc((100% - 2 * 24px) / 3);
        }
    }
    @media (max-width: 767.98px) {
        .bct-gallery-item {
            flex-basis: calc((100% - 24px) / 2); /* 2 per row */
            max-width: calc((100% - 24px) / 2);
        }
    }
    @media (max-width: 575.98px) {
        .bct-gallery-item {
            flex-basis: 100%; /* 1 per row */
            max-width: 100%;
        }
    }
    .bct-gallery-card {
        height: 100%;
    }
    .bct-gallery-empty {
        flex: 1 1 100%;
    }

    /* Self-contained page wrapper — does NOT rely on Bootstrap's .container
       class (that class wasn't applying on the host page, so the whole
       section — heading, tabs, cards — was touching the left browser edge
       with no side padding). This gives consistent centering/padding
       regardless of the host page's CSS. */
    .bct-gallery-wrapper {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 48px 24px;
        box-sizing: border-box;
    }
</style>

<div class="bct-gallery-wrapper" style="font-family: 'Poppins', sans-serif;">

    <div class="row mb-4">
        <div class="col-12 mb-4 border-bottom pb-3">
            <span class="text-uppercase font-weight-bold d-block mb-1" style="font-size: 11px; color: #0284C7; letter-spacing: 1px;">
                BACTA Digital Media Archive
            </span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                <i class="fas fa-images text-info mr-2" aria-hidden="true"></i> Media Gallery Hub
            </h2>
        </div>

        <div class="col-12 mb-5">
            <ul class="nav nav-tabs bct-nav-tabs border-0" id="galleryTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="photos-tab" data-toggle="tab" href="#photos_panel" role="tab" aria-controls="photos_panel" aria-selected="true">
                        <i class="fas fa-camera mr-2" aria-hidden="true"></i> Photo Albums
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos_panel" role="tab" aria-controls="videos_panel" aria-selected="false">
                        <i class="fab fa-youtube mr-2" aria-hidden="true"></i> Video Gallery
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="galleryTabContent">

        {{-- ================= PHOTO ALBUMS ================= --}}
        <div class="tab-pane fade show active bct-active" id="photos_panel" role="tabpanel" aria-labelledby="photos-tab">
            <div class="bct-gallery-grid">
                @php
                    $photoAssets = $galleries->where('category_type', 'IMAGE');

                    // Resolve the file safely and confirm it actually lives inside /public
                    // (blocks path-traversal attempts like ../../.env stored in the DB field).
                    $publicRoot = realpath(public_path());
                @endphp

                @forelse($photoAssets as $photo)
                    @php
                        $mediaFile   = $photo->media_file ?? '';
                        $resolved    = $mediaFile ? realpath(public_path($mediaFile)) : false;
                        $fileIsSafe  = $resolved && $publicRoot && str_starts_with($resolved, $publicRoot);
                    @endphp
                    <div class="bct-gallery-item">
                        <div class="card h-100 bct-gallery-card bct-lightbox-trigger"
                             data-type="image"
                             data-src="{{ $fileIsSafe ? asset($mediaFile) : '' }}"
                             data-title="{{ $photo->title }}"
                             role="button"
                             tabindex="0"
                             aria-label="Open photo: {{ $photo->title }}">
                            <div class="bct-gallery-img-wrapper">
                                @if($fileIsSafe)
                                    <img src="{{ asset($mediaFile) }}" class="bct-gallery-img" alt="{{ $photo->title }}" loading="lazy">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="fas fa-image" style="font-size: 40px;" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <div class="bct-hover-overlay">
                                    <div class="bct-hover-icon"><i class="fas fa-search-plus" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <span class="badge badge-info px-2 py-1 text-uppercase font-weight-bold mb-2" style="font-size: 9px;">
                                    <i class="fas fa-image mr-1" aria-hidden="true"></i> Seminar Photo
                                </span>
                                <h5 class="font-weight-bold text-dark m-0" style="font-size: 15px;">{{ $photo->title }}</h5>
                                <small class="text-muted d-block mt-2">
                                    <i class="far fa-calendar-alt mr-1" aria-hidden="true"></i> {{ optional($photo->created_at)->format('d M, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bct-gallery-empty text-center py-5 bg-white border border-dashed rounded p-4">
                        <i class="fas fa-images text-secondary mb-3" style="font-size: 54px; opacity: .4;" aria-hidden="true"></i>
                        <h5 class="text-secondary font-weight-bold">No Event Photos Uploaded Yet</h5>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ================= VIDEO GALLERY ================= --}}
        <div class="tab-pane fade" id="videos_panel" role="tabpanel" aria-labelledby="videos-tab">
            <div class="bct-gallery-grid">
                @php
                    $videoAssets = $galleries->where('category_type', 'VIDEO');

                    // Extract the YouTube video ID once, server-side. Only a clean 11-char
                    // alphanumeric ID is ever passed to the browser — never the raw stored URL —
                    // so the client can't be tricked into embedding an arbitrary/unsafe source.
                    $extractYoutubeId = function ($url) {
                        if (preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([A-Za-z0-9_-]{11})/i', (string) $url, $m)) {
                            return $m[1];
                        }
                        return null;
                    };
                @endphp

                @forelse($videoAssets as $video)
                    @php $youtubeId = $extractYoutubeId($video->video_url); @endphp
                    <div class="bct-gallery-item">
                        <div class="card h-100 bct-gallery-card bct-lightbox-trigger"
                             data-type="video"
                             data-youtube-id="{{ $youtubeId }}"
                             data-title="{{ $video->title }}"
                             role="button"
                             tabindex="0"
                             aria-label="Play video: {{ $video->title }}">
                            <div class="bct-gallery-img-wrapper">
                                @if($youtubeId)
                                    <img src="https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg" class="bct-gallery-img" alt="{{ $video->title }}" loading="lazy">
                                @else
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-dark text-white p-4">
                                        <i class="fab fa-youtube text-danger mb-2" style="font-size: 42px;" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <div class="bct-hover-overlay" style="background: rgba(234, 88, 12, 0.4) !important;">
                                    <div class="bct-hover-icon" style="color: #ea580c;"><i class="fas fa-play" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <span class="badge badge-warning text-dark px-2 py-1 text-uppercase font-weight-bold mb-2" style="font-size: 9px;">
                                    <i class="fab fa-youtube mr-1 text-danger" aria-hidden="true"></i> Event Video
                                </span>
                                <h5 class="font-weight-bold text-dark m-0" style="font-size: 15px;">{{ $video->title }}</h5>
                                <small class="text-muted d-block mt-2">
                                    <i class="far fa-calendar-alt mr-1" aria-hidden="true"></i> {{ optional($video->created_at)->format('d M, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bct-gallery-empty text-center py-5 bg-white border border-dashed rounded p-4">
                        <i class="fab fa-youtube text-secondary mb-3" style="font-size: 54px; opacity: .4;" aria-hidden="true"></i>
                        <h5 class="text-secondary font-weight-bold">No Event Videos Embedded Yet</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ================= LIGHTBOX MARKUP ================= --}}
<div class="bct-lightbox-overlay" id="bctMasterLightbox" role="dialog" aria-modal="true" aria-label="Media viewer">
    <div class="lightbox-content-box">
        <span class="lightbox-close-btn" id="closeLightboxBtn" role="button" tabindex="0" aria-label="Close">&times;</span>

        <div class="lightbox-nav-btn lightbox-prev" id="prevLightboxBtn" role="button" tabindex="0" aria-label="Previous"><i class="fas fa-chevron-left" aria-hidden="true"></i></div>
        <div class="lightbox-nav-btn lightbox-next" id="nextLightboxBtn" role="button" tabindex="0" aria-label="Next"><i class="fas fa-chevron-right" aria-hidden="true"></i></div>

        <div id="lightboxMediaRenderBody" class="d-flex align-items-center justify-content-center bg-black rounded shadow"></div>
        <h5 class="text-white font-weight-bold mt-3 text-center px-3" id="lightboxMediaTitleLabel" style="letter-spacing: 0.5px;"></h5>
    </div>
</div>

{{-- Only load jQuery if the parent layout hasn't already provided it, to avoid double-loading/conflicts --}}
<script>
    if (typeof window.jQuery === 'undefined') {
        document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-\/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej\/m4=" crossorigin="anonymous"><\/script>');
    }
</script>
<script>
    $(document).ready(function() {

        // ---- Tab switching (self-contained, does not rely on Bootstrap's
        // own tab JS/CSS). This avoids breakage when the parent layout ships
        // a different Bootstrap version or overrides .nav-link/.tab-pane. ----
        $('#galleryTab .nav-link').on('click', function(e) {
            e.preventDefault();
            const $tab = $(this);
            const target = $tab.attr('href');

            $('#galleryTab .nav-link').removeClass('active').attr('aria-selected', 'false');
            $tab.addClass('active').attr('aria-selected', 'true');

            $('#galleryTabContent > .tab-pane').removeClass('show active bct-active');
            $(target).addClass('show active bct-active');
        });

        let activeGalleryItems = [];
        let currentIndex = -1;

        function collectItemFromCard($card) {
            return {
                type: $card.data('type'),
                youtubeId: $card.data('youtube-id') || '',
                src: $card.data('src') || '',
                title: $card.data('title') || ''
            };
        }

        function openLightboxFor($card) {
            activeGalleryItems = [];
            currentIndex = -1;

            const activeTabId = $('.bct-nav-tabs .nav-link.active').attr('href');
            $(activeTabId + ' .bct-lightbox-trigger').each(function(index) {
                activeGalleryItems.push(collectItemFromCard($(this)));
                if (this === $card.get(0)) {
                    currentIndex = index;
                }
            });

            if (currentIndex !== -1) {
                renderLightboxMedia(currentIndex);
                $('#bctMasterLightbox').css('display', 'flex');
                $('body').css('overflow', 'hidden');
            }
        }

        $(document).on('click', '.bct-lightbox-trigger', function() {
            openLightboxFor($(this));
        });
        // Keyboard accessibility for the gallery cards themselves
        $(document).on('keydown', '.bct-lightbox-trigger', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openLightboxFor($(this));
            }
        });

        function renderLightboxMedia(index) {
            if (index < 0 || index >= activeGalleryItems.length) return;

            const item = activeGalleryItems[index];
            const $renderBody = $('#lightboxMediaRenderBody');
            $('#lightboxMediaTitleLabel').text(item.title);
            $renderBody.empty();

            if (item.type === 'image') {
                if (!item.src) return;
                $('<img>', {
                    src: item.src,
                    class: 'img-fluid',
                    alt: item.title
                }).appendTo($renderBody);
            } else {
                // Only a pre-validated 11-char alphanumeric YouTube ID is ever used here —
                // never a raw/unvalidated URL — so this can't be hijacked into loading an
                // arbitrary third-party page inside the iframe.
                const safeId = /^[A-Za-z0-9_-]{11}$/.test(item.youtubeId) ? item.youtubeId : '';
                if (!safeId) return;

                const $wrap = $('<div class="bct-video-frame-wrap"></div>');
                $('<iframe>', {
                    src: 'https://www.youtube.com/embed/' + safeId + '?autoplay=1&rel=0',
                    allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                    allowfullscreen: true,
                    referrerpolicy: 'strict-origin-when-cross-origin'
                }).appendTo($wrap);
                $wrap.appendTo($renderBody);
            }
        }

        function closeLightbox() {
            $('#bctMasterLightbox').fadeOut('fast', function() {
                $('#lightboxMediaRenderBody').empty(); // stop any playing video
                $('body').css('overflow', '');
            });
        }

        $('#nextLightboxBtn').on('click', function(e) {
            e.stopPropagation();
            if (currentIndex < activeGalleryItems.length - 1) {
                currentIndex++;
                renderLightboxMedia(currentIndex);
            }
        });

        $('#prevLightboxBtn').on('click', function(e) {
            e.stopPropagation();
            if (currentIndex > 0) {
                currentIndex--;
                renderLightboxMedia(currentIndex);
            }
        });

        $('#closeLightboxBtn, #bctMasterLightbox').on('click', closeLightbox);
        $('.lightbox-content-box').on('click', function(e) {
            e.stopPropagation();
        });

        $(document).on('keydown', function(e) {
            if ($('#bctMasterLightbox').is(':visible')) {
                if (e.key === 'ArrowRight') $('#nextLightboxBtn').click();
                if (e.key === 'ArrowLeft') $('#prevLightboxBtn').click();
                if (e.key === 'Escape') closeLightbox();
            }
        });
    });
</script>
@endsection
