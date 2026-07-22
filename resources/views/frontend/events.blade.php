@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
@section('title', 'Events | BACTA Bangladesh')

@section('content')
<style>
    /* 👑 পুরো পেজ ও কন্টেন্ট মাঝ বরাবর (Centered) লক করার কোর বাউন্ডারি ফ্রেম */
    .bct-events-main-container {
        max-width: 1200px !important;
        margin-left: auto !important;
        margin-right: auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
    .bct-event-card {
        border: none !important;
        border-radius: 20px !important;
        background: #ffffff !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        width: 100% !important;
        cursor: pointer;
    }
    
    /* 👑 আপনার রিকোয়ারমেন্ট: মাউস হোভার ট্রানজিশন ও কালারফুল গ্লোয়িং বর্ডার ইফেক্ট ভাই */
    .bct-event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 45px rgba(0, 173, 239, 0.15) !important;
        border-color: #00ADEF !important;
    }
    
    /* 👑 ইমেজ যেন পিক্সেল-পারফেক্ট ফুল বাউন্ডারিতে স্মার্ট লুকে ফিট থাকে ভাই */
    .bct-img-frame-box {
        position: relative !important;
        width: 100% !important;
        height: 220px !important; 
        overflow: hidden !important;
        background: #0f172a !important;
    }
    .bct-event-banner {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important; 
        background-color: #0f172a !important;
        transition: transform 0.5s ease !important;
    }
    .bct-event-card:hover .bct-event-banner {
        transform: scale(1.05) !important;
    }
    
    /* লাক্সারি কালারফুল হোভার ওভারলে নোড ভাই */
    .bct-colorful-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 73, 106, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .bct-event-card:hover .bct-colorful-overlay {
        opacity: 1;
    }
    .bct-action-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #00ADEF;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 15px rgba(0, 173, 239, 0.4);
    }
    
    /* আপনার সেই সিগনেচার কার্বন ক্যালেন্ডার আইকন ফ্রেম স্টাইল */
    .bct-carbon-calendar-box {
        flex: none !important;
        width: 60px !important;
        height: 75px !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02) !important;
    }
    .bct-event-card:hover .bct-carbon-calendar-box {
        border-color: #0284C7 !important;
        background: #f0f9ff !important;
    }

    /* 👑 রাজকীয় লাইটবক্স থিয়েটার উইন্ডো সিএসএস প্যানেল ভাই */
    .bct-events-lightbox {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.96);
        z-index: 999999;
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }
    .lightbox-theater-box {
        position: relative;
        width: 85%;
        max-width: 900px;
        max-height: 85vh;
        animation: bctPopupZoom 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes bctPopupZoom {
        from { transform: scale(0.96); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .theater-close-btn {
        position: absolute;
        top: -45px;
        right: 0;
        font-size: 34px;
        color: rgba(255,255,255,0.7);
        cursor: pointer;
        transition: color 0.2s;
    }
    .theater-close-btn:hover { color: #ef4444; }
</style>
{{-- 👑 পুরো কন্টেন্ট মাঝ বরাবর (Center) সোজা লক রাখার মেইন কন্টেইনার ভাই --}}
<div class="bct-events-main-container py-5 animate__animated animate__fadeIn">
    
    <!-- ==========================================
         🏛️ SECTION ১: UPCOMING ACADEMIC EVENTS (চলতি ও আগামী প্রোগ্রাম উইন্ডো ভাই)
         ========================================== -->
    <div class="row mb-5 justify-content-center">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Live Academic Schedules</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-hourglass-start text-success mr-2"></i> Upcoming Scientific Sessions
            </h4>
        </div>

        @php
            // 👑 রিয়েল-টাইম ডাইনামিক ফিল্টার নোড: আজকের তারিখ ট্র্যাক করে আগামী প্রোগ্রামগুলো আলাদা করা ভাই
            $currentDate = date('Y-m-d');
            $upcomingEvents = $events->where('event_date', '>=', $currentDate);
        @endphp

        @forelse($upcomingEvents as $event)
            @php
                $eventCarbon = $event->event_date ? \Carbon\Carbon::parse($event->event_date) : null;
                $eventDay = $eventCarbon ? $eventCarbon->format('d') : date('d');
                $eventMonth = $eventCarbon ? $eventCarbon->format('M') : date('M');
            @endphp
            
            <div class="col-lg-6 col-md-12 mb-4">
                {{-- 👑 লাইটবক্স ট্রিগার অ্যাকশন গেঁথে দেওয়া হলো ভাই --}}
                <div class="card h-100 bct-event-card bct-event-lightbox-trigger" data-src="{{ asset($event->event_banner) }}" data-title="{{ $event->title }}">
                    <div class="row no-gutters h-100">
                        
                        <!-- ১. বাম পাশের স্মার্ট ইমেজ বক্স নোড ভাই -->
                        <div class="col-md-5">
                            <div class="bct-img-frame-box">
                                @if(!empty($event->event_banner) && file_exists(public_path($event->event_banner)))
                                    <img src="{{ asset($event->event_banner) }}" class="bct-event-banner" alt="Event Banner">
                                @else
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-dark text-white p-3 text-center">
                                        <i class="fas fa-chalkboard-teacher text-info mb-2" style="font-size: 32px;"></i>
                                        <span class="text-uppercase font-weight-bold text-muted" style="font-size: 9px;">BACTA SESSION</span>
                                    </div>
                                @endif
                                <div class="bct-colorful-overlay">
                                    <div class="bct-action-icon"><i class="fas fa-expand-arrows-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ২. ডান পাশের ডাটা মেটা এবং কার্বন ক্যালেন্ডার আইকন নোড ভাই (মাঝ বরাবর সমান এলাইনড লক) -->
                        <div class="col-md-7 d-flex flex-column justify-content-between p-4 bg-white">
                            <div class="d-flex align-items-start" style="gap: 16px;">
                                
                                {{-- 👑 আপনার সেই সিগনেচার কার্বন ক্যালেন্ডার বক্স ফিজিক্যালি রেন্ডার নোড ভাই --}}
                                <div class="bct-carbon-calendar-box">
                                    <span class="text-uppercase font-black tracking-wider d-block w-100" style="font-size: 11px; color: #0284C7; font-weight: 900; line-height: 1;">{{ $eventMonth }}</span>
                                    <span class="font-black text-slate-800 d-block w-100 mt-1" style="font-size: 26px; color: #1e293b; font-weight: 900; line-height: 1;">{{ $eventDay }}</span>
                                </div>
                                
                                <div style="flex: 1;">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0284C7] d-block mb-1" style="font-size: 10px; color: #0284C7; font-weight: 800;">BACTA Official Session</span>
                                    <h4 class="font-weight-bold leading-snug m-0 hover:text-[#0284C7] transition-colors" style="font-size: 15px; color: #00496A;">
                                        {{ $event->title }}
                                    </h4>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-3 border-t">
                                @if($event->venue)
                                    <p class="text-muted small m-0 flex items-start gap-1 font-medium leading-relaxed" style="font-size: 12px; color: #64748b;">
                                        <i class="fas fa-map-marker-alt text-danger mr-1 mt-0.5"></i>
                                        <span><strong>Venue:</strong> {{ $event->venue }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white border border-dashed rounded-2xl p-4 w-100">
                <i class="fas fa-calendar-times text-slate-300 mb-3" style="font-size: 48px;"></i>
                <h5 class="text-secondary font-weight-bold">No Upcoming Academic Workshops Scheduled</h5>
                <p class="text-muted small mx-auto mt-2 max-w-sm">The official calendar for cardiovascular perioperative scientific sessions is currently being updated by the central registries board.</p>
            </div>
        @endforelse
    </div>
    <!-- ==========================================
         🏛️ SECTION ২: PAST SCIENTIFIC ARCHIVES (ইতিমধ্যে শেষ হওয়া প্রোগ্রাম ক্যাটালগ ভাই)
         ========================================== -->
    <div class="row mt-5 justify-content-center">
        <div class="col-12 mb-4 border-b pb-3">
            <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider block mb-1" style="font-size: 11px; color: #94a3b8; font-weight: 800;">Historical Academic Records</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #64748b; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-history text-secondary mr-2"></i> Past Events Archive
            </h4>
        </div>

        @php
            // 👑 ডাইনামিক রিয়েল-টাইম ট্র্যাকার: তারিখ পার হয়ে যাওয়া পুরনো প্রোগ্রামগুলো এখানে লুপ হবে ভাই
            $pastEvents = $events->where('event_date', '<', $currentDate);
        @endphp

        @forelse($pastEvents as $pEvent)
            @php
                $pEventCarbon = $pEvent->event_date ? \Carbon\Carbon::parse($pEvent->event_date) : null;
                $pEventDay = $pEventCarbon ? $pEventCarbon->format('d') : date('d');
                $pEventMonth = $pEventCarbon ? $pEventCarbon->format('M') : date('M');
            @endphp
            
            <div class="col-lg-6 col-md-12 mb-4 opacity-75">
                {{-- ওরিজিনাল থিয়েটার লাইটবক্স অ্যাকশন গেটওয়ে ভাই --}}
                <div class="card h-100 bct-event-card bct-event-lightbox-trigger" data-src="{{ asset($pEvent->event_banner) }}" data-title="{{ $pEvent->title }}">
                    <div class="row no-gutters h-100">
                        
                        <!-- ১. বাম পাশের স্মার্ট ইমেজ বক্স নোড ভাই -->
                        <div class="col-md-5">
                            <div class="bct-img-frame-box">
                                @if(!empty($pEvent->event_banner) && file_exists(public_path($pEvent->event_banner)))
                                    <img src="{{ asset($pEvent->event_banner) }}" class="bct-event-banner" style="filter: grayscale(15%) !important;" alt="Past Event Banner">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary text-white text-center">
                                        <i class="fas fa-archive" style="font-size: 32px;"></i>
                                    </div>
                                @endif
                                <div class="bct-colorful-overlay">
                                    <div class="bct-action-icon" style="background:#64748b; box-shadow: 0 4px 15px rgba(100,116,139,0.4);"><i class="fas fa-expand-arrows-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ২. ডান পাশের ডাটা মেটা এবং কার্বন ক্যালেন্ডার আইকন নোড ভাই (মাঝ বরাবর সমান এলাইনড লক) -->
                        <div class="col-md-7 d-flex flex-column justify-content-between p-4 bg-white">
                            <div class="d-flex align-items-start" style="gap: 16px;">
                                
                                {{-- 👑 আপনার সেই সিগনেচার কার্বন ক্যালেন্ডার বক্স ফিজিক্যালি রেন্ডার নোড ভাই --}}
                                <div class="bct-carbon-calendar-box" style="background: #f1f5f9 !important; border-color: #cbd5e1 !important;">
                                    <span class="text-uppercase font-black tracking-wider d-block w-100" style="font-size: 11px; color: #64748b; font-weight: 900; line-height: 1;">{{ $pEventMonth }}</span>
                                    <span class="font-black d-block w-100 mt-1" style="font-size: 26px; color: #475569; font-weight: 900; line-height: 1;">{{ $pEventDay }}</span>
                                </div>
                                
                                <div style="flex: 1;">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 d-block mb-1" style="font-size: 10px; color: #94a3b8; font-weight: 800;">Concluded Session</span>
                                    <h5 class="font-weight-bold leading-snug m-0" style="font-size: 14px; color: #475569;">
                                        {{ $pEvent->title }}
                                    </h5>
                                </div>
                            </div>
                            
                            <div class="mt-3 pt-2 border-t">
                                <small class="text-muted d-block text-truncate" style="font-size: 11px; color: #64748b;"><i class="fas fa-map-marker-alt mr-1"></i> {{ $pEvent->venue ?? 'N/A' }}</small>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white border border-dashed rounded-2xl p-4 w-100">
                <i class="fas fa-folder-open text-muted mb-3" style="font-size: 42px;"></i>
                <h6 class="text-secondary font-weight-bold">No Concluded Sessions Stored in Archive</h6>
            </div>
        @endforelse
    </div>

</div> {{-- bct-events-main-container closure end --}}

<!-- ==========================================
     👑 劇場 LIGHTBOX MASTER THEATER (JPG / PDF ডাইনামিক সুইচ ইঞ্জিন ভাই)
     ========================================== -->
<div class="bct-events-lightbox" id="bctEventsLightboxPanel">
    <div class="lightbox-theater-box">
        <span class="theater-close-btn" id="closeEventsLightboxBtn">&times;</span>
        {{-- 👑 এই ডাইনামিক ডিভের ভেতর পিডিএফ এবং ইমেজ অটো-সুইচ হয়ে ১ সেকেন্ডে রেন্ডার হবে ভাই --}}
        <div id="eventsTheaterRenderBody" class="bg-black rounded shadow d-flex align-items-center justify-content-center" style="width: 100%; min-height: 500px; height: 75vh; overflow: hidden; border: 4px solid rgba(255,255,255,0.1);"></div>
        <h5 class="text-white font-weight-bold mt-3 text-center px-2" id="eventsTheaterTitleLabel" style="font-size: 16px; letter-spacing: 0.5px;"></h5>
    </div>
</div>

<!-- ওরিজিনাল পিওর জেকোয়েরি ড্রাইভার লাইব্রেরি নোড ভাই -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // 👑 নো-কনফ্লিক্ট প্রোটেকশন শীল্ড: যা টেইলউইন্ড থিমের গ্লোবাল জ্যাম এক সেকেন্ডে বাইপাস করবে ভাই
    jQuery.noConflict();
    (function($) {
        $(document).ready(function() {
            
            // 👑 ওয়ান-ক্লিক লাইভ লাইটবক্স ওপেনার ও ফাইল টাইপ চেকার ড্রাইভার ভাই
            $(document).on('click', '.bct-event-lightbox-trigger', function(e) {
                e.preventDefault();
                
                var fileUrl = $(this).data('src');
                var titleText = $(this).data('title');
                var renderTarget = $('#eventsTheaterRenderBody');
                
                $('#eventsTheaterTitleLabel').text(titleText);
                
                // ফাইলের এক্সটেনশন ট্র্যাক করার রেজেক্স প্রটেকশন নোড ভাই
                var fileExtension = fileUrl.split('.').pop().toLowerCase();
                
                if (fileExtension === 'pdf') {
                    // ফাইলটি যদি ওরিজিনাল PDF হয়, তবে ব্রাউজার ডাইরেক্ট এইচডি পিডিএফ রিডার ওপেন করবে ভাই
                    renderTarget.html('<iframe src="' + fileUrl + '" style="width: 100%; height: 100%; border: none;" allow="autoplay"></iframe>');
                } else {
                    // FILEটি যদি JPG / PNG বা নরমাল ইমেজ হয়, তবে ওরিজিনাল প্রিভিউ উইন্ডো ভাসবে ভাই
                    renderTarget.html('<img src="' + fileUrl + '" class="img-fluid animate__animated animate__zoomIn" style="max-width: 100%; max-height: 100%; object-fit: contain;">');
                }
                
                $('#bctEventsLightboxPanel').css('display', 'flex').addClass('animate__animated animate__fadeIn');
            });

            // ওয়ান-ক্লিক ক্লোজার নোড এবং মেমোরি ফ্লাশ ড্রাইভার ভাই
            $(document).on('click', '#closeEventsLightboxBtn, #bctEventsLightboxPanel', function() {
                $('#bctEventsLightboxPanel').fadeOut('fast', function() {
                    $('#eventsTheaterRenderBody').html(''); // আইফ্রেমের পিডিএফ বা ইমেজ মেমোরি থেকে কমপ্লিট কিল ভাই
                });
            });

            $(document).on('click', '.lightbox-theater-box', function(e) {
                e.stopPropagation(); // কন্টেন্ট বক্সে টাচ করলে উইন্ডো যেন খোলা থাকে ভাই
            });
            
            // কিবোর্ডের এস্কেপ (ESC) বোতাম সিঙ্ক প্রটেকশন ভাই
            $(document).on('keydown', function(e) {
                if ($('#bctEventsLightboxPanel').is(':visible') && e.keyCode === 27) {
                    $('#closeEventsLightboxBtn').click();
                }
            });
            
        });
    })(jQuery);
</script>
@endsection