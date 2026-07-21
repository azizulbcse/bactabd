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
    .bct-gallery-card {
        border: none;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .gallery-preview-thumb {
        width: 60px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #00ADEF;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    .video-placeholder-icon {
        width: 60px;
        height: 45px;
        border-radius: 6px;
        background: #ea580c;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }
    /* ডাটাটেবিল গ্রিড ভেঙে যাওয়া রোধ করার কোর ফিক্স */
    #bctGalleryTable {
        width: 100% !important;
    }
</style>
@endpush

@section('title', 'Media Gallery Hub | BACTA')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark font-weight-bold text-uppercase" style="color: #00496A !important; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-images mr-2" style="color: #00ADEF;"></i> Scientific Media Gallery Repository
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
        
        {{-- 📁 কলাম ১: বাম পাশের ডেডিকেটেড মিডিয়া গ্যালারি আপলোডার ফর্ম --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white pb-0 border-0">
                    <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-plus-circle text-primary mr-1"></i> Add Gallery Asset</h5>
                    <p class="text-muted small mt-1 mb-0">Upload official scientific group photos or embed professional YouTube links.</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" id="addGalleryForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status_gate" id="gallery_status_gate" value="live">

                        <!-- ইনপুট ১: মিডিয়া ক্যাটাগরি টাইপ সিলেকশন -->
                        <div class="form-group mb-3">
                            <label class="text-secondary small font-weight-bold">Select Asset Type <span class="text-danger">*</span></label>
                            <select name="category_type" id="add_category_type" class="form-control" required>
                                <option value="IMAGE">Scientific Event / Seminar (Image)</option>
                                <option value="VIDEO">Corporate / Event Video (YouTube Link)</option>
                            </select>
                        </div>

                        <!-- ইনপুট ২: অ্যাসেট টাইটেল -->
                        <div class="form-group mb-3">
                            <label class="text-secondary small font-weight-bold">Asset Title / Subject <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., Annual AGM Group Photo..." required>
                        </div>

                        <!-- ইনপুট ৩: ডাইনামিক মিডিয়া সোর্স কন্টেইনার (জেএস দিয়ে ফাইল/ইউআরএল সোয়াপ হবে ভাই) -->
                        <div class="form-group mb-4" id="media_source_container">
                            <label class="text-secondary small font-weight-bold" id="media_label_text">Upload Event Banner (Image) <span class="text-danger">*</span></label>
                            <input type="file" name="media_file" id="add_media_file" class="form-control-file bg-white border rounded p-2" accept="image/*" required>
                        </div>

                        <!-- বাটন নোড: ১০০% ক্লিকেবল একটিভ গেটওয়ে -->
                        <div class="form-group mb-0">
                            <button type="submit" onclick="document.getElementById('gallery_status_gate').value='live';" class="btn btn-primary font-weight-bold btn-block py-2 shadow-sm mb-2" style="background-color: #00496A; border: none; border-radius: 8px;">
                                <i class="fas fa-paper-plane mr-1"></i> Publish Asset Live
                            </button>
                            <button type="submit" onclick="document.getElementById('gallery_status_gate').value='draft';" class="btn btn-outline-secondary font-weight-bold btn-block py-2" style="border-radius: 8px;">
                                <i class="fas fa-archive mr-1"></i> Save as Draft
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- 📊 কলাম ২: ডান পাশের মিডিয়া অ্যান্ড অ্যাসেট লগস ডাটাটেবিল রোল (AdminLTE Built-in) --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-list text-muted mr-1"></i> Asset Logs Registry</h5>
                    <p class="text-muted small mt-1 mb-0">Live gallery asset monitoring with zero-symlink direct physical storage link.</p>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bctGalleryTable" class="table table-bordered table-striped table-hover w-full text-sm">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="width: 50px; vertical-align: middle;">SL</th>
                                    <th style="width: 70px; vertical-align: middle;" class="text-center">Preview</th>
                                    <th style="vertical-align: middle;">Asset Details & Title</th>
                                    <th style="width: 110px; vertical-align: middle;" class="text-center">Category Type</th>
                                    <th style="width: 100px; vertical-align: middle;" class="text-center">Status Gate</th>
                                    <th style="width: 130px; vertical-align: middle;">Created By Audit</th>
                                    <th style="width: 100px; vertical-align: middle;" class="text-center">Action Hub</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 👑 ফিক্সড লুপ ড্রাইভার: এখানে ওরিজিনাল $galleries ভ্যারিয়েবল গেঁথে দেওয়া হলো ভাই --}}
                                @forelse($galleries as $index => $gallery)
                                    <tr id="row-gallery-{{ $gallery->id }}">
                                        <td class="font-weight-bold align-middle">{{ $index + 1 }}</td>
                                        
                                        {{-- জিরো-সিমলিঙ্ক মিডিয়া প্রিভিউ থাম্বনেইল ডিসপ্লে ফিল্টার ভাই --}}
                                        <td class="text-center align-middle">
                                            @if($gallery->category_type === 'IMAGE')
                                                @if(!empty($gallery->media_file) && file_exists(public_path($gallery->media_file)))
                                                    <img src="{{ asset($gallery->media_file) }}" class="gallery-preview-thumb elevation-1" alt="Event Image">
                                                @else
                                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto rounded border" style="width: 60px; height: 45px;"><i class="fas fa-image"></i></div>
                                                @endif
                                            @else
                                                <div class="video-placeholder-icon elevation-1">
                                                    <i class="fab fa-youtube"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark d-block mb-1" style="font-size: 14px;">{{ $gallery->title }}</span>
                                            <small class="text-muted d-block"><i class="fas fa-history mr-1"></i> Recorded Log</small>
                                        </td>
                                        
                                        <td class="align-middle text-center">
                                            @if($gallery->category_type === 'IMAGE')
                                                <span class="badge badge-info px-2 py-1 text-uppercase">Image</span>
                                            @else
                                                <span class="badge badge-warning text-dark px-2 py-1 text-uppercase">Video</span>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            @if($gallery->status == 2)
                                                <span class="badge bg-success font-weight-bold px-2 py-1 text-uppercase">Live</span>
                                            @else
                                                <span class="badge bg-warning text-dark font-weight-bold px-2 py-1 text-uppercase">Draft</span>
                                            @endif
                                        </td>

                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark d-block" style="font-size: 12px;">{{ $gallery->creator->name ?? 'System Admin' }}</span>
                                            <small class="text-muted d-block" style="font-size: 10px;">{{ $gallery->created_at->format('d M, Y h:i A') }}</small>
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            <div class="btn-group btn-group-sm">
    {{-- 👑 ম্যাজিক নোড: স্ট্যাটাস যদি ড্রাফট (১) থাকে, তবেই শুধু এই স্লিক সবুজ বোতামটি স্ক্রিনে একটিভ হবে ভাই --}}
    @if($gallery->status == 1)
        <form action="{{ route('admin.gallery.publish_direct', $gallery->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success font-weight-bold" style="border-radius: 4px 0 0 4px;" title="Make Public Live">
                <i class="fas fa-paper-plane mr-1"></i> Go Live
            </button>
        </form>
    @endif
    
    {{-- 🚀 ওরিজিনাল এডিট বাটন: বাম পাশের রাউন্ডেড বর্ডার ডাইনামিক এডজাস্ট ড্রাইভার ভাই --}}
    <button type="button" class="btn btn-warning font-weight-bold edit-gallery-btn" data-id="{{ $gallery->id }}" style="{{ $gallery->status == 1 ? 'border-radius: 0;' : 'border-radius: 4px 0 0 4px;' }}">
        <i class="fas fa-edit"></i> Edit
    </button>
    
    {{-- ওরিজিনাল ডিলিট বাটন --}}
    <button type="button" class="btn btn-danger font-weight-bold delete-gallery-btn" data-id="{{ $gallery->id }}" data-title="{{ addslashes($gallery->title) }}" style="border-radius: 0 4px 4px 0;">
        <i class="fas fa-trash-alt"></i> Del
    </button>
</div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 bg-white">
                                            <h5 class="text-secondary font-weight-bold">No Media Assets Registered Yet!</h5>
                                        </td>
                                    </tr>
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
     👑 CONFIRM DESTROY MODAL
     ========================================== -->
<div class="modal fade" id="destroyGalleryModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-danger text-white py-2">
                <h6 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Wipe Asset Confirmation</h6>
                <button type="button" class="close text-white" onclick="$('#destroyGalleryModal').modal('hide');"><span>&times;</span></button>
            </div>
            <form id="destroyGalleryForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center bg-light py-4">
                    <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 42px;"></i>
                    <p class="text-dark font-weight-bold mb-1" style="font-size: 15px;">Wipe official asset and its files from storage permanently?</p>
                    <small class="text-muted d-block mt-2 px-2 text-truncate font-weight-bold" id="destroy_asset_title_label" style="color: #dc3545 !important;"></small>
                </div>
                <div class="modal-footer bg-white justify-content-between py-2 border-top-0">
                    <button type="button" class="btn btn-default btn-sm font-weight-bold" onclick="$('#destroyGalleryModal').modal('hide');">Cancel</button>
                    {{-- 👑 ১. ওরিজিনাল ওয়ান-ক্লিক 'OK' সাবমিট বোতাম নোড ভাই --}}
                    <button type="submit" id="destroySubmitBtn" class="btn btn-primary btn-sm font-weight-bold px-3">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // ২. AdminLTE বিল্ট-ইন জেনুইন ক্যাশ-ফ্রি ডাটাটেবিল সচল ইঞ্জিন নোড
        $('#bctGalleryTable').DataTable({ 
            "responsive": true, 
            "ordering": true, 
            "order": [[0, "desc"]],
            "language": { "search": "Quick Filter Records:" }
        });

        // 👑 ৩. আপনার ওরিজিনাল রিকোয়ারমেন্ট: ইমেজ vs ভিডিও টাইপ সিলেকশন অনুযায়ী ইনপুট ফিল্ড ডাইনামিক চেঞ্জার ইঞ্জিন ভাই
        $('#add_category_type').on('change', function() {
            let selectedType = $(this).val();
            let container = $('#media_source_container');
            
            if (selectedType === 'IMAGE') {
                container.html(`
                    <label class="text-secondary small font-weight-bold" id="media_label_text">Upload Event Banner (Image) <span class="text-danger">*</span></label>
                    <input type="file" name="media_file" id="add_media_file" class="form-control-file bg-white border rounded p-2" accept="image/*" required>
                `);
            } else {
                container.html(`
                    <label class="text-secondary small font-weight-bold" id="media_label_text">YouTube Video Embedded Link / URL <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fab fa-youtube text-danger"></i></span></div>
                        <input type="url" name="media_source_url" id="add_media_url" class="form-control" placeholder="e.g., https://youtube.com..." required>
                    </div>
                `);
            }
        });

        // ৪. ওয়ান-ক্লিক ডিলিট রাউট স্পুফিং লিসেনার নোড ভাই
        $(document).on('click', '.delete-gallery-btn', function() {
            let id = $(this).data('id');
            let title = $(this).data('title');
            $('#destroy_asset_title_label').text('Asset: "' + title + '"');
            $('#destroyGalleryForm').attr('action', "{{ url('admin/gallery/delete') }}/" + id);
            $('#destroyGalleryModal').modal('show');
        });

        // ৫. গ্লোবাল অ্যালার্ট ৩ সেকেন্ড পর অটো-হাইড করার ড্রাইভার
        setTimeout(function() { $('#bct-global-success-alert').fadeOut('slow'); }, 3000);
    });
</script>
@stop
