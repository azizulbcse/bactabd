{{-- 👑 ফ্রন্টএন্ড মাস্টার লেআউট এক্সটেন্ড নোড (আপনার ওরিজিনাল থিম সিঙ্কড) --}}
@extends('layouts.app')

@section('content')
<!-- ১. গ্লোবাল লাক্সারি অ্যানিমেশন ও প্রফেশনাল ইভেন্ট কার্ড সিএসএস ইন্জেকশন ভাই -->
<link rel="stylesheet" href="https://cloudflare.com"/>
<style>
    .bct-event-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .bct-event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 73, 106, 0.08);
        border-color: #00ADEF;
    }
    .bct-event-banner {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .bct-event-card:hover .bct-event-banner {
        transform: scale(1.04);
    }
    .bct-date-badge {
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 12px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 12px;
    }
</style>

<div class="container py-5" style="font-family: 'Poppins', sans-serif;">
    
    <!-- ==========================================
         🏛️ SECTION ১: UPCOMING ACADEMIC EVENTS (চলতি ও আগামী প্রোগ্রাম উইন্ডো ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeIn">
        <div class="col-12 mb-4 border-b pb-3 d-flex justify-content-between align-items-end">
            <div>
                <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1">BACTA Live Timelines</span>
                <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                    <i class="fas fa-calendar-alt text-info mr-2"></i> Upcoming Scientific Sessions
                </h2>
            </div>
        </div>

        @php
            // 👑 ডাইনামিক ফিল্টার: পিএইচপি আজকে ২১ জুলাই, ২০২৬ তারিখ ট্র্যাক করে আগামী প্রোগ্রামগুলো ফিল্টার করবে ভাই
            $currentDate = date('Y-m-d');
            $upcomingEvents = $events->where('event_date', '>=', $currentDate);
        @endphp

        @forelse($upcomingEvents as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 bct-event-card">
                    <div class="position-relative overflow-hidden" style="height: 240px; bg: #0f172a;">
                        @if(!empty($event->event_banner) && file_exists(public_path($event->event_banner)))
                            <img src="{{ asset($event->event_banner) }}" class="bct-event-banner" alt="Event Banner">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-dark text-white p-4 text-center">
                                <i class="fas fa-chalkboard-teacher text-info mb-2" style="font-size: 42px;"></i>
                                <span class="text-xs text-uppercase font-weight-bold tracking-widest text-slate-400">{{ $event->venue }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bct-date-badge px-3 py-1.5"><i class="far fa-clock mr-1"></i> {{ date('M d, Y', strtotime($event->event_date)) }}</span>
                                <span class="badge badge-success text-uppercase font-weight-bold p-1.5" style="font-size: 9px; letter-spacing: 0.5px;"><i class="fas fa-bell mr-1 animate-pulse"></i> Open</span>
                            </div>
                            <h4 class="font-weight-bold mb-2" style="color: #00496A; font-size: 16px; leading-snug: true;">{{ $event->title }}</h4>
                        </div>
                        <div class="mt-4 pt-3 border-t">
                            <p class="text-muted small m-0 flex items-center gap-1 font-medium"><i class="fas fa-map-marker-alt text-danger mr-1"></i> <strong>Venue:</strong> {{ $event->venue ?? 'Main Secretariat Auditorium' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white border border-dashed rounded-2xl p-4 animate__animated animate__fadeIn">
                <i class="fas fa-calendar-times text-slate-300 mb-3" style="font-size: 54px;"></i>
                <h5 class="text-secondary font-weight-bold">No Upcoming Academic Workshops Scheduled</h5>
                <p class="text-muted small mx-auto mt-2 max-w-sm">The official calendar for cardiovascular perioperative scientific sessions is currently being updated by the central registries board.</p>
            </div>
        @endforelse
    </div> {{-- upcoming row end --}}
    <!-- ==========================================
         🏛️ SECTION ২: PAST SCIENTIFIC ARCHIVES (ইতিমধ্যে শেষ হওয়া প্রোগ্রাম ক্যাটালগ ভাই)
         ========================================== -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4 border-b pb-3">
            <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider block mb-1">Historical Academic Records</span>
            <h3 class="font-weight-bold text-uppercase m-0" style="color: #64748b; font-size: 20px; letter-spacing: 0.5px;">
                <i class="fas fa-history text-secondary mr-2"></i> Past Events Archive
            </h3>
        </div>

        @php
            // 👑 ডাইনামিক রিয়েল-টাইম ট্র্যাকার: তারিখ পার হয়ে যাওয়া পুরনো প্রোগ্রামগুলো এখানে লুপ হবে ভাই
            $pastEvents = $events->where('event_date', '<', $currentDate);
        @endphp

        @forelse($pastEvents as $pEvent)
            <div class="col-lg-4 col-md-6 mb-4 opacity-75">
                <div class="card h-100 bct-event-card" style="background: #f8fafc;">
                    <div class="position-relative overflow-hidden" style="height: 180px;">
                        @if(!empty($pEvent->event_banner) && file_exists(public_path($pEvent->event_banner)))
                            <img src="{{ asset($pEvent->event_banner) }}" class="bct-event-banner filter grayscale" style="filter: grayscale(40%)" alt="Past Event Banner">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary text-white text-center">
                                <i class="fas fa-archive" style="font-size: 32px;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge badge-light border text-muted px-2 py-1 font-weight-bold" style="font-size: 11px;"><i class="far fa-calendar-check mr-1"></i> Concluded</span>
                                <small class="text-secondary font-weight-bold" style="font-size: 11px;">{{ date('M d, Y', strtotime($pEvent->event_date)) }}</small>
                            </div>
                            <h5 class="font-weight-bold text-dark text-truncate mb-1" style="font-size: 15px;" title="{{ $pEvent->title }}">{{ $pEvent->title }}</h5>
                        </div>
                        <div class="mt-3 pt-2 border-t">
                            <small class="text-muted d-block text-truncate"><i class="fas fa-map-marker-alt mr-1"></i> {{ $pEvent->venue ?? 'N/A' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- কোনো পুরনো আর্কাইভ ডাটা না থাকলে ক্লিন ফলব্যাক উইন্ডো নোড ভাই --}}
            <div class="col-12 text-center py-5">
                <i class="fas fa-folder-open text-muted mb-3" style="font-size: 42px;"></i>
                <h6 class="text-secondary font-weight-bold">No Concluded Sessions Stored in Archive</h6>
                <p class="text-muted small">All historical knowledge-sharing timeline records will catalog here automatically.</p>
            </div>
        @endforelse
    </div> {{-- past row end --}}
</div> {{-- container end --}}
@endsection
