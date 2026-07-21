@extends('adminlte::page')
<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
@push('css')
<style>
    .content-wrapper {
        display: block !important;
        clear: both !important;
    }
    .main-sidebar {
        min-height: 100vh !important;
        position: fixed !important;
    }
    .bct-events-card {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .event-preview-thumb {
        width: 60px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #00ADEF;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    /* ডাটাটেবিল গ্রিড ভেঙে যাওয়া রোধ করার কোর ফিক্স */
    #bctEventsTable {
        width: 100% !important;
    }
</style>
@endpush

@section('title', 'Scientific Events Hub | BACTA')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark font-weight-bold text-uppercase" style="color: #00496A !important; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-calendar-alt mr-2" style="color: #00ADEF;"></i> Scientific Events & Seminars Control Hub
                </h1>
            </div>
        </div>
    </div>
@stop
@section('content')
{{-- 👑 মেগা শিল্ড কন্টেইনার: যা আপনার সাইডবার মেনুকে আজীবন এক লাইনে টাইট করে লক রাখবে ভাই --}}
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif; display: block; clear: both;">
    
    {{-- ওরিজিনাল গ্লোবাল সাকসেস ফ্ল্যাশ ব্যানার --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible shadow-sm border-0 animate__animated animate__fadeIn" id="bct-global-success-alert">
            <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check-circle mr-2"></i> Success!</h5>
            {{ session('success') }}
        </div>
    @endif

    {{-- 🔒 ল্যারাভেলের বিল্ট-ইন স্মার্ট সিকিউরিটি ভ্যালিডেশন এরর ব্লকিং নোড ভাই --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible shadow-sm border-0 animate__animated animate__shakeX">
            <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle mr-2"></i> Validation Alert!</h5>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ২-কলাম বুটস্ট্র্যাপ গ্রিড রো শুরু --}}
    <div class="row">
        
        {{-- 📁 কলাম ১: বাম পাশের ডেডিকেটেড ইভেন্ট আপলোডার ফর্ম --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white pb-0 border-0">
                    <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-calendar-plus text-primary mr-1"></i> Log New Event</h5>
                    <p class="text-muted small mt-1 mb-0">Publish official seminars, webinars, and conferences metadata live.</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST" id="addEventForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status_gate" id="event_status_gate" value="live">

                        <div class="form-group mb-3">
                            <label class="text-secondary small font-weight-bold">Event Title / Subject <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., International Seminar on..." required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-secondary small font-weight-bold">Seminar Venue / Location <span class="text-danger">*</span></label>
                            <input type="text" name="venue" class="form-control" placeholder="e.g., Institutional Auditorium, Dhaka" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-secondary small font-weight-bold">Event Execution Date <span class="text-danger">*</span></label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-secondary small font-weight-bold">Upload Event Banner / Poster <span class="text-danger">*</span></label>
                            <input type="file" name="media_file" class="form-control-file bg-white border rounded p-2" accept="image/*" required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" onclick="document.getElementById('event_status_gate').value='live';" class="btn btn-primary font-weight-bold btn-block py-2 shadow-sm mb-2" style="background-color: #00496A; border: none; border-radius: 8px;">
                                <i class="fas fa-unlock-alt mr-1"></i> Publish Event Live
                            </button>
                            <button type="submit" onclick="document.getElementById('event_status_gate').value='draft';" class="btn btn-outline-secondary font-weight-bold btn-block py-2" style="border-radius: 8px;">
                                <i class="fas fa-file-signature mr-1"></i> Save as Draft
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- 📊 কলাম ২: ডান পাশের সায়েন্টিফিক ইভেন্টস ডাটাটেবিল রেজিস্ট্রি রোল (AdminLTE Built-in) --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-list-alt text-muted mr-1"></i> Registered Events Registry</h5>
                    <p class="text-muted small mt-1 mb-0">Real-time event data syncing with automated timestamp ledger.</p>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bctEventsTable" class="table table-bordered table-striped table-hover w-full text-sm">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="width: 50px; vertical-align: middle;">SL</th>
                                    <th style="width: 70px; vertical-align: middle;" class="text-center">Banner</th>
                                    <th style="vertical-align: middle;">Event Subject & Metadata</th>
                                    <th style="width: 100px; vertical-align: middle;" class="text-center">Status</th>
                                    <th style="width: 130px; vertical-align: middle;">Audit Log</th>
                                    <th style="width: 140px; vertical-align: middle;" class="text-center">Action Hub</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 👑 ফিক্সড লুপ ড্রাইভার: এখানে ওরিজিনাল $events ভ্যারিয়েবল গেঁথে দেওয়া হলো ভাই --}}
                                @forelse($events as $index => $event)
                                    <tr id="row-event-{{ $event->id }}">
                                        <td class="font-weight-bold align-middle">{{ $index + 1 }}</td>
                                        <td class="text-center align-middle">
                                            @if(!empty($event->event_banner) && file_exists(public_path($event->event_banner)))
                                                <img src="{{ asset($event->event_banner) }}" class="event-preview-thumb elevation-1" alt="Banner">
                                            @else
                                                <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto rounded border" style="width: 60px; height: 45px;"><i class="fas fa-image"></i></div>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark d-block mb-1" style="font-size: 14px;">{{ $event->title }}</span>
                                            <small class="text-muted d-block"><i class="fas fa-map-marker-alt mr-1 text-danger"></i> <strong>Venue:</strong> {{ $event->venue ?? 'N/A' }}</small>
                                            <small class="text-secondary d-block"><i class="fas fa-calendar-day mr-1 text-info"></i> <strong>Date:</strong> {{ $event->event_date ? date('d M, Y', strtotime($event->event_date)) : 'N/A' }}</small>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($event->status == 2)
                                                <span class="badge bg-success font-weight-bold px-2 py-1 text-uppercase">Live</span>
                                            @else
                                                <span class="badge bg-warning text-dark font-weight-bold px-2 py-1 text-uppercase">Draft</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark d-block" style="font-size: 12px;">{{ $event->creator->name ?? 'Admin' }}</span>
                                            <small class="text-muted d-block" style="font-size: 10px;">{{ $event->created_at->format('d M, Y h:i A') }}</small>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group btn-group-sm">
    {{-- 👑 ম্যাজিক নোড: ইভেন্ট স্ট্যাটাস ড্রাফট থাকলে সরাসরি ওয়ান-ক্লিক লাইভ করার সবুজ বাটন ভাই --}}
    @if($event->status == 1)
        <form action="{{ route('admin.events.publish_direct', $event->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success font-weight-bold" style="border-radius: 4px 0 0 4px;" title="Make Event Live">
                <i class="fas fa-paper-plane mr-1"></i> Go Live
            </button>
        </form>
    @endif
    
    {{-- ওরিজিনাল এডিট বাটন --}}
    <button type="button" class="btn btn-warning font-weight-bold edit-event-btn" data-id="{{ $event->id }}" style="{{ $event->status == 1 ? 'border-radius: 0;' : 'border-radius: 4px 0 0 4px;' }}">
        <i class="fas fa-edit"></i> Edit
    </button>
    
    {{-- ওরিজিনাল ডিলিট বাটন --}}
    <button type="button" class="btn btn-danger font-weight-bold delete-event-btn" data-id="{{ $event->id }}" data-title="{{ addslashes($event->title) }}" style="border-radius: 0 4px 4px 0;">
        <i class="fas fa-trash-alt"></i> Del
    </button>
</div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center py-5 bg-white"><h5 class="text-secondary font-weight-bold">No Scientific Events Logged Yet!</h5></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- row closure end --}}
</div> {{-- container fluid closure end --}}

<!-- ==========================================
     👑 MODALS ACTION INFRASTRUCTURE (EDIT & DELETE)
     ========================================== -->
<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-info text-white py-2">
                <h5 class="modal-title font-weight-bold" style="font-size: 16px;"><i class="fas fa-edit mr-2"></i> Update Event Ledger</h5>
                <button type="button" class="close text-white" onclick="$('#editEventModal').modal('hide');"><span>&times;</span></button>
            </div>
            <form id="editEventForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_event_id">
                <div class="modal-body bg-light py-4">
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Event Title</label>
                        <input type="text" name="title" id="edit_event_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Venue / Location</label>
                        <input type="text" name="venue" id="edit_event_venue" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Event Date</label>
                        <input type="date" name="event_date" id="edit_event_date" class="form-control" required>
                    </div>
                    <div class="form-group mb-0">
                        <label class="text-secondary small font-weight-bold">Change Event Banner (Optional)</label>
                        <input type="file" name="media_file" class="form-control-file bg-white border rounded p-2" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer bg-white"><button type="submit" id="editSaveBtn" class="btn btn-info font-weight-bold px-4"><i class="fas fa-upload mr-1"></i> Update Changes</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="destroyEventModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-danger text-white py-2">
                <h6 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Wipe Event Confirm</h6>
                <button type="button" class="close text-white" onclick="$('#destroyEventModal').modal('hide');"><span>&times;</span></button>
            </div>
            <form id="destroyEventForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center bg-light py-4">
                    <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 42px;"></i>
                    <p class="text-dark font-weight-bold mb-1" style="font-size: 15px;">Wipe event and its physical banner from server permanently?</p>
                    <small class="text-muted d-block mt-2 px-2 text-truncate font-weight-bold" id="destroy_event_title_label" style="color: #dc3545 !important;"></small>
                </div>
                <div class="modal-footer bg-white justify-content-between py-2">
                    <button type="button" class="btn btn-default btn-sm font-weight-bold" onclick="$('#destroyEventModal').modal('hide');">Cancel</button>
                    {{-- 👑 ১. ওরিজিনাল ওয়ান-ক্লিক 'OK' সাবমিট বোতাম নোড ভাই --}}
                    <button type="submit" id="destroyEventSubmitBtn" class="btn btn-primary btn-sm font-weight-bold px-3">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // ২. AdminLTE বিল্ট-ইন জেনুইน ক্যাশ-ফ্রি ডাটাটেবিল সচল ইঞ্জিন নোড
        $('#bctEventsTable').DataTable({ 
            "responsive": true, 
            "ordering": true, 
            "order": [[0, "desc"]],
            "language": { "search": "Quick Filter Records:" }
        });

        // ৩. ওয়ান-ক্লিক এডিট ডাটা গেটওয়ে লিসেনার নোড ভাই
        $(document).on('click', '.edit-event-btn', function() {
            let id = $(this).data('id');
            let row = $('#row-event-' + id);
            let title = row.find('td:eq(2) span').text().trim();
            let venue = row.find('td:eq(2) small:eq(0)').text().replace('Venue:', '').trim();
            let rawDate = row.find('td:eq(2) small:eq(1)').text().replace('Date:', '').trim();
            
            // ডেট ফরম্যাট ডাইনামিক ক্লীনার ড্রাইভার
            let parsedDate = new Date(rawDate);
            let formattedDate = parsedDate.toISOString().split('T')[0];

            $('#edit_event_id').val(id);
            $('#edit_event_title').val(title);
            $('#edit_event_venue').val(venue);
            if(formattedDate && formattedDate !== 'NaN-aN-aN') {
                $('#edit_event_date').val(formattedDate);
            }
            
            // আপডেট অ্যাকশন রাউট সিঙ্ক
            $('#editEventForm').attr('action', "{{ url('admin/events/update') }}/" + id);
            $('#editEventModal').modal('show');
        });

        // ৪. ওয়ান-ক্লিক ডিলিট রাউট স্পুফিং লিসেনার নোড ভাই
        $(document).on('click', '.delete-event-btn', function() {
            let id = $(this).data('id');
            let title = $(this).data('title');
            $('#destroy_event_title_label').text('Event: "' + title + '"');
            $('#destroyEventForm').attr('action', "{{ url('admin/events/delete') }}/" + id);
            $('#destroyEventModal').modal('show');
        });

        // ৫. গ্লোবাল অ্যালার্ট ৩ সেকেন্ড পর অটো-হাইড করার ড্রাইভার
        setTimeout(function() { $('#bct-global-success-alert').fadeOut('slow'); }, 3000);
    });
</script>
@stop
