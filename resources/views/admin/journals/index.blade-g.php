@extends('adminlte::page')

{{-- ১. আপনার ওরিজিনাল প্রিমিয়াম ঝাঁকুনি অ্যানিমেশন এবং ছিমছাম ইনপুট ট্রানজিশন সিএসএস পুশ --}}
@push('css')
<style>
    .shake-effect {
        animation: bctShake 0.5s ease-in-out;
        border: 1px solid #dc3545 !important;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.2) !important;
    }
    @keyframes bctShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-6px); }
        40%, 80% { transform: translateX(6px); }
    }
    .bct-input-wrapper, .bct-edit-input-wrapper, .bct-art-wrapper {
        transition: all 0.3s ease;
    }
    .image-preview-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #00ADEF;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: inline-block;
        vertical-align: middle;
    }
    /* ডাটাটেবিল গ্রিড ভেঙে যাওয়া রোধ করার কোর ফিক্স */
    #bctJournalTable {
        width: 100% !important;
    }
</style>
@endpush

@section('title', 'Scientific Journals | BACTA')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark font-weight-bold text-uppercase" style="color: #00496A !important; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-book mr-2" style="color: #00ADEF;"></i> Scientific Journal Repository
                </h1>
            </div>
        </div>
    </div>
@stop
@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    
    {{-- গ্লোবাল ওয়ান-টাচ কাস্টম অ্যালার্ট টোস্ট ব্যানার কন্টেইনার --}}
    <div id="ajax-toast-box" style="position: fixed; top: 25px; right: 25px; z-index: 9999; min-width: 320px; display: none;"></div>

    {{-- ওরিজিনাল গ্লোবাল সাকসেস ফ্ল্যাশ মেমোরি অ্যালার্ট --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible shadow-sm border-0 animate__animated animate__fadeIn" id="bct-global-success-alert">
            <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check-circle mr-2"></i> Success!</h5>
            {{ session('success') }}
        </div>
    @endif

    {{-- ওরিজিনাল গ্লোবাল ব্যাকএন্ড ভ্যালিডেশন এরর টোস্ট --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible shadow-sm border-0 animate__animated animate__shakeX" id="bct-global-error-alert">
            <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle mr-2"></i> Validation Alert!</h5>
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- পাশাপাশি ২-কলাম মাস্টার গ্রিড লেআউট শুরু --}}
    <div class="row">
        
        {{-- 📁 কলাম ১: বাম পাশের সায়েন্টিফিক জার্নাল আপলোডার ফর্ম প্যানেল --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white pb-0 border-0">
                    <h5 class="font-weight-bold text-dark m-0">
                        <i class="fas fa-file-archive text-warning mr-1"></i> Unpack Journal ZIP
                    </h5>
                    <p class="text-muted small mt-1 mb-0">Upload 1 compressed ZIP and its grand luxury cover page image.</p>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.journals.store') }}" method="POST" id="addJournalForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action_type" id="journal_action_type" value="publish">
                    <!-- ইনপুট ১: জার্নাল টাইটেল -->
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Scientific Journal Title <span class="text-danger">*</span></label>
                        <div class="input-group bct-input-wrapper">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-book-open text-muted"></i></span>
                            </div>
                            <input type="text" name="title" id="add_title_field" class="form-control border-left-0" placeholder="e.g., Bangladesh Journal of..." required>
                        </div>
                    </div>

                    <!-- ইনপুট ২: রাইটার বা প্রিন্সিপাল অথর নেম -->
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Principal Author Name <span class="text-danger">*</span></label>
                        <div class="input-group bct-input-wrapper">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-user-edit text-muted"></i></span>
                            </div>
                            <input type="text" name="author_name" id="add_author_field" class="form-control border-left-0" placeholder="e.g., Prof. ATM. Khalilur Rahman" required>
                        </div>
                    </div>

                    <!-- 👑 ইনপুট ৩: আপনার ফ্রন্ট কাভার ছবি আপলোডার উইন্ডো ও গোল প্রিভিউ সার্কেল নোড ভাই -->
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Journal Front Cover Page (JPG/PNG)</label>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="custom-file bct-input-wrapper">
                                    <input type="file" name="cover_image" id="add_cover_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label border-light text-muted text-truncate" for="add_cover_image">Select cover photo...</label>
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                {{-- ছবি সিলেক্ট করামাত্রই এই গোল গোল উইন্ডোর ভেতর ওটা লাইভ ভেসে উঠবে ভাই --}}
                                <img id="add_cover_preview" src="{{ asset('vendor/adminlte/dist/img/avatar5.png') }}" class="image-preview-circle" alt="Cover Preview" style="border: 2px solid #ffc107; width: 45px; height: 45px;">
                            </div>
                        </div>
                    </div>
                    <!-- ইনপুট ৪: ভলিউম এবং ISSUE ক্যাটালগ কোড -->
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Volume & Issue Catalog <span class="text-danger">*</span></label>
                        <div class="input-group bct-input-wrapper">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-layer-group text-muted"></i></span>
                            </div>
                            <input type="text" name="volume_issue" id="add_volume_field" class="form-control border-left-0" placeholder="e.g., Vol. 13, No. 01" required>
                        </div>
                    </div>

                    <!-- ইনপুট ৫: জার্নাল জিপ ফাইল ফিল্টার -->
                    <div class="form-group mb-4">
                        <label class="text-secondary small font-weight-bold">Journal Compressed Archive (ZIP Only) <span class="text-danger">*</span></label>
                        <div class="custom-file bct-input-wrapper">
                            <input type="file" name="journal_file" id="add_journal_file" class="custom-file-input" accept=".zip" required>
                            <label class="custom-file-label border-light text-muted text-truncate" for="add_journal_file">Select journal_asset.zip...</label>
                        </div>
                    </div>

                    <!-- বাটন নোড: ১০০% টাইপ-লক মুক্ত ডাইরেক্ট সাবমিট ইঞ্জিন ভাই -->
                    <div class="form-group mb-0">
                        <button type="submit" id="bctRealSubmitBtn" onclick="document.getElementById('journal_action_type').value='publish';" class="btn btn-primary font-weight-bold btn-block py-2 shadow-sm mb-2" style="background-color: #00496A; border: none; border-radius: 8px;">
                            <i class="fas fa-unlock-alt mr-1"></i> Extract & Publish Live
                        </button>
                        <button type="submit" id="bctRealDraftBtn" onclick="document.getElementById('journal_action_type').value='draft';" class="btn btn-outline-secondary font-weight-bold btn-block py-2" style="border-radius: 8px;">
                            <i class="fas fa-file-archive mr-1"></i> Unpack as Draft
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        {{-- 📊 কলাম ২: ডান পাশের আল্ট্রা-মডার্ন জার্নাল রেজিস্ট্রি ডাটাটেবিল রোল --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-list-alt text-muted mr-1"></i> Registered Journals Roll</h5>
                    <p class="text-muted small mt-1 mb-0">Live catalog tracking with zero-symlink direct document viewer window.</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- আপনার ওরিজিনাল মেমোরি ট্র্যাক করা ক্যাশ-ফ্রি ডাটাটেবিল আইডি --}}
                        <table id="bctJournalTable" class="table table-bordered table-striped table-hover w-full text-sm">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="width: 50px; vertical-align: middle;">ID</th>
                                    <th style="width: 70px; vertical-align: middle;" class="text-center">Cover</th>
                                    <th style="vertical-align: middle;">Journal Info</th>
                                    <th style="width: 130px; vertical-align: middle;" class="text-center">Volume & Issue</th>
                                    <th style="vertical-align: middle;" class="text-center">Digital Document</th>
                                    <th style="width: 90px; vertical-align: middle;" class="text-center">Status</th>
                                    <th style="width: 150px; vertical-align: middle;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($journals as $journal)
                                    <tr id="row-journal-{{ $journal->id }}">
                                        {{-- ১. আইডি নোড --}}
                                        <td class="font-weight-bold align-middle">#{{ $journal->id }}</td>
                                        
                                        {{-- ২. কাভার পেজ থাম্বনেইল কলাম --}}
                                        <td class="text-center align-middle" style="width: 70px;">
                                            @if(!empty($journal->cover_image) && file_exists(public_path($journal->cover_image)))
                                                <img src="{{ asset($journal->cover_image) }}" 
                                                     class="elevation-1 border shadow-xs" 
                                                     style="width: 50px; height: 65px; object-fit: cover; border-radius: 4px;" 
                                                     alt="Cover">
                                            @else
                                                <div class="bg-light text-muted d-flex align-items-center justify-content-center mx-auto shadow-xs border" style="width: 50px; height: 65px; border-radius: 4px;"><i class="fas fa-book" style="font-size: 20px; color: #00ADEF;"></i></div>
                                            @endif
                                        </td>

                                        {{-- ৩. জিপ থেকে আনপ্যাক হওয়া সব আর্টিকেলের রিয়েল-টাইম লাইভ ট্র্যাকিং লিস্ট গ্রিড --}}
                                        <td class="align-middle">
                                            <span class="font-weight-bold text-dark d-block mb-1" style="font-size: 14px;">
                                                {{ $journal->title }}
                                            </span>
                                            <small class="text-muted font-weight-bold d-block mb-2"><i class="fas fa-user-edit mr-1"></i> Principal Author: {{ $journal->author_name }}</small>

                                            {{-- আনজিপ ড্রাইভ লুপ: জিপ থেকে বের হওয়া প্রতিটি পিডিএফ এখানে অটোমেটিক রেন্ডার হবে ভাই --}}
                                            @if($journal->articles->count() > 0)
                                                <div class="mt-2 pl-2" style="border-left: 2px solid #00ADEF !important;">
                                                    @foreach($journal->articles as $article)
                                                        <div class="d-flex align-items-center justify-content-between bg-light rounded px-2 py-1 mb-1 border shadow-xs animate__animated animate__fadeIn" style="font-size: 12px;">
                                                            <div class="text-truncate mr-2" style="max-width: 80%;">
                                                                <span class="font-weight-bold text-dark d-block text-truncate">{{ $article->article_title }}</span>
                                                            </div>
                                                            <a href="{{ asset($article->pdf_file) }}" target="_blank" class="btn btn-xs btn-outline-danger font-weight-bold px-2 py-0" style="font-size: 10px; border-radius: 4px;"><i class="fas fa-file-pdf"></i> View</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        
                                        {{-- ৪. ভলিউম ক্যাটালগ কোড কলাম --}}
                                        <td class="align-middle">
                                            <span class="badge bg-light text-dark font-weight-bold border d-block py-1 text-center shadow-xs">
                                                <i class="fas fa-layer-group text-muted mr-1"></i> {{ $journal->volume_issue }}
                                            </span>
                                        </td>
                                        
                                        {{-- ৫. মেমোরি ট্র্যাক নোড --}}
                                        <td class="align-middle text-center">
                                            <span class="badge bg-light text-secondary border px-2 py-1 shadow-xs font-weight-bold">
                                                <i class="fas fa-file-archive text-warning mr-1"></i> ZIP Archive
                                            </span>
                                        </td>
                                        
                                        {{-- ৬. পাবলিশ/ড্রাফট স্ট্যাটাস ব্যানার --}}
                                        <td class="text-center align-middle">
                                            @if($journal->status == 2)
                                                <span class="badge bg-success font-weight-bold px-2 py-1"><i class="fas fa-globe mr-1"></i> Live</span>
                                            @else
                                                <span class="badge bg-warning text-dark font-weight-bold px-2 py-1"><i class="fas fa-file-signature mr-1"></i> Draft</span>
                                            @endif
                                        </td>
                                        
                                        {{-- ৭. Actions বাটন গ্রিড --}}
                                        <td class="text-center align-middle">
                                            <button type="button" onclick="openAddArticleModal({{ $journal->id }}, '{{ addslashes($journal->title) }}')" class="btn btn-primary btn-xs font-weight-bold w-full mb-2 shadow-xs py-1" style="background-color: #00496A; border: none; border-radius: 6px;">
                                                <i class="fas fa-plus-circle mr-1"></i> + Add Article
                                            </button>
                                            
                                            <div class="btn-group btn-group-xs w-full">
                                                <button type="button" class="btn btn-warning font-weight-bold edit-journal-btn" data-id="{{ $journal->id }}" style="border-radius: 4px 0 0 4px; font-size: 11px;">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger font-weight-bold delete-journal-btn" data-id="{{ $journal->id }}" style="border-radius: 0 4px 4px 0; font-size: 11px;">
                                                    <i class="fas fa-trash-alt"></i> Del
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 bg-white">
                                            <h5 class="text-secondary font-weight-bold">No Journals ZIP Archives Extracted Yet!</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> {{-- card-body end --}}
            </div> {{-- card end --}}
        </div> {{-- col-md-8 end --}}
    </div> {{-- 👑 AdminLTE অরিজিনাল গ্রিড রো ক্লোজার নোড যা মেনু ভাঙা চিরতরে ফিক্স করল ভাই --}}
</div> {{-- মেইন container fluid ক্লোজার নোড ভাই --}}
<!-- ==========================================
     MODALS SECTION (GENUINE ADMINLTE COMPATIBLE)
     ========================================== -->
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white" style="background-color: #00496A;">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i> Attach Paper / Article</h5>
                <button type="button" class="close text-white" onclick="$('#addArticleModal').modal('hide');"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.journals.articles.store') }}" method="POST" id="addArticleForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="bacta_journal_id" id="art_journal_id">
                <div class="modal-body bg-light py-4">
                    <div class="alert alert-info border-0 mb-3 py-2" style="background-color: #e0f2fe; border-left: 4px solid #00ADEF !important;">
                        <span id="art_journal_title_banner" class="font-weight-bold text-dark" style="font-size: 14px;"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Article / Paper Title <span class="text-danger">*</span></label>
                        <input type="text" name="article_title" id="art_title_field" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Contributor Name <span class="text-danger">*</span></label>
                        <input type="text" name="author_name" id="art_author_field" class="form-control" required>
                    </div>
                    <div class="form-group mb-0">
                        <label class="text-secondary small font-weight-bold">Upload PDF Document <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="pdf_file" id="art_pdf_file" class="custom-file-input" accept="application/pdf" required>
                            <label class="custom-file-label" for="art_pdf_file">Choose article PDF...</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white justify-content-between">
                    <button type="button" class="btn btn-default font-weight-bold" onclick="$('#addArticleModal').modal('hide');">Cancel</button>
                    <button type="submit" id="artSaveBtn" class="btn btn-success font-weight-bold px-4">Attach Paper Live</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editJournalModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i> Update Journal Registry</h5>
                <button type="button" class="close text-white" onclick="$('#editJournalModal').modal('hide');"><span>&times;</span></button>
            </div>
            <form id="editJournalForm" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body bg-light py-4">
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Journal Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Author Name</label>
                        <input type="text" name="author_name" id="edit_author" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-secondary small font-weight-bold">Volume & Issue</label>
                        <input type="text" name="volume_issue" id="edit_volume" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer bg-white"><button type="submit" id="editSaveBtn" class="btn btn-info font-weight-bold px-4"><i class="fas fa-upload mr-1"></i> Update Changes</button></div>
            </form>
        </div>
    </div>
</div>

<!-- 👑 ওরিজিনাল ফিক্সড ডিলিট মোডাল: যা Route::delete জ্যাম চিরতরে খতম করবে ভাই -->
<div class="modal fade" id="destroyJournalModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Wipe Assets</h5>
                <button type="button" class="close text-white" onclick="$('#destroyJournalModal').modal('hide');"><span>&times;</span></button>
            </div>
            
            <form id="destroyJournalForm" method="POST" action="">
                @csrf
                {{-- 👑 ম্যাজিক নোড: আপনার রাউট ফাইলের Route::delete এর সাথে ম্যাচ করানোর জন্য ওরিজিনাল ডিলিট স্পুফিং ট্যাগ ভাই --}}
                @method('DELETE') 
                
                <input type="hidden" name="id" id="destroy_id">
                <div class="modal-body text-center bg-light py-4">
                    <i class="fas fa-trash-alt text-danger mb-3" style="font-size: 40px;"></i>
                    <p class="text-dark font-weight-bold mb-1">Permanently Delete?</p>
                    <p class="text-muted small px-2">This will erase this volume and auto-purge its PDF assets from storage.</p>
                </div>
                <div class="modal-footer bg-white justify-content-between">
                    <button type="button" class="btn btn-default btn-sm font-weight-bold" onclick="$('#destroyJournalModal').modal('hide');">Cancel</button>
                    <button type="submit" id="destroySubmitBtn" class="btn btn-danger btn-sm font-weight-bold px-3">Yes, Wipe Out</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script>
    $(document).ready(function() {
        // ১. জেনুইন মেমোরি ট্র্যাক করা ক্যাশ-ফ্রি ডাটাটেবিল সচল ইঞ্জিন
        $('#bctJournalTable').DataTable({ 
            "responsive": true, 
            "ordering": true, 
            "order": [[0, "desc"]],
            "language": {
                "search": "Quick Find:"
            }
        });

        // 👑 ২. আপনার সেই কাঙ্ক্ষিত আসল সমাধান: ছবি সিলেক্ট করলে গোল উইন্ডোতে লাইভ প্রিভিউ ও বক্সে ওরিজিনাল নাম ভাসানোর ড্রাইভার ভাই
        $('#add_cover_image').on('change', function(e) {
            let fullPath = $(this).val();
            let fileName = fullPath.split('\\').pop().split('/').pop();
            $(this).next('.custom-file-label').html(fileName ? fileName : "Select cover photo...");
            
            if(e.target.files.length) {
                let reader = new FileReader();
                reader.onload = function(ev) { 
                    $('#add_cover_preview').attr('src', ev.target.result); 
                }
                reader.readAsDataURL(e.target.files);
            }
        });

        // 👑 ৩. জিপ ফাইল সিলেক্ট করার সাথে সাথে বক্সে ওরিজিনাল জিপ নাম ভাসানোর ডাইনামিক লাইভ নোড ভাই
        $('#add_journal_file').on('change', function(e) {
            let fullPath = $(this).val();
            let fileName = fullPath.split('\\').pop().split('/').pop();
            $(this).next('.custom-file-label').html(fileName ? fileName : "Select journal_asset.zip...");
        });

        // 👑 ৪. চাইল্ড পিডিএফ ফাইল সিলেক্ট করার সাথে সাথে কনেক্টর বক্সে নাম ভাসানোর লাইভ নোড ভাই
        $(document).on('change', '#art_pdf_file', function(e) {
            let fullPath = $(this).val();
            let fileName = fullPath.split('\\').pop().split('/').pop();
            $(this).next('.custom-file-label').html(fileName ? fileName : "Choose article PDF...");
        });

        // ৫. এডিট মোডাল পপ-আপ ডাটা গেটওয়ে লিসেনার নোড
        $(document).on('click', '.edit-journal-btn', function() {
            let id = $(this).data('id');
            let row = $('#row-journal-' + id);
            let title = row.find('td:eq(2) span').text().trim();
            let author = row.find('td:eq(2) small').text().replace('Principal Author:', '').trim();
            let volume = row.find('td:eq(3) span').text().trim();

            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_author').val(author);
            $('#edit_volume').val(volume);
            $('#editJournalModal').modal('show');
        });

        $(document).on('click', '.delete-journal-btn', function() {
            let id = $(this).data('id');
            $('#destroy_id').val(id);
            
            $('#destroyJournalForm').attr('action', "{{ url('admin/journals/delete') }}/" + id);
            $('#destroyJournalModal').modal('show');
        });

    });

    // 👑 ৭. ওয়ান-ক্লিক চাইল্ড মোডাল ফ্লাই-আউট উইন্ডো কনেক্টর নোড
    window.openAddArticleModal = function(id, title) {
        $('#art_journal_id').val(id);
        $('#art_journal_title_banner').text(title);
        $('#addArticleModal').modal('show');
    };
</script>
@stop