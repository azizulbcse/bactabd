<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
@extends('adminlte::page')

@section('title', 'BACTA Designations Setup | BACTA')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        {{-- BACTA অফিশিয়াল লোগোর স্কাই ব্লু (#0284C7) আইকন ও টাইটেল --}}
        <h1 class="font-weight-bold text-dark" style="font-size: 24px; font-weight: 700 !important; letter-spacing: -0.5px;"><i class="fas fa-award mr-2 text-[#0284C7]"></i> BACTA Constitutional Designations Setup</h1>
        
        {{-- BACTA অফিশিয়াল লোগোর রয়্যাল ব্লু (#1E40AF) কালার ম্যাচড প্লাস বাটন --}}
        <button type="button" class="btn text-white font-weight-bold shadow-sm mb-2" data-toggle="modal" data-target="#addBactaDesigModal" style="background-color: #1E40AF; border-radius: 4px; font-size: 14px; border: none; transition: 0.3s;">
            <i class="fas fa-plus-circle mr-1"></i> Add New Board Designation
        </button>
    </div>
@stop

@section('content')
{{-- ৩ সেকেন্ড পর অটো-হাইড সাকসেস অ্যালার্ট (আপনার মূল নওগাঁও প্যাটার্ন সিঙ্ক) --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm text-white border-0 m-2 animate__animated animate__fadeInDown" 
         id="success-alert" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); border-radius: 4px; font-weight: 600;">
        <div class="d-flex align-items-center justify-content-between p-2">
            <div><i class="fas fa-check-circle mr-2" style="font-size: 18px;"></i> {{ session('success') }}</div>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="outline: none;"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
@endif

{{-- ল্যারাভেল ব্যাকএন্ড ভ্যালিডেশন এরর অ্যালার্ট (যেমন: ডুপ্লিকেট এন্ট্রি বা ছোট-বড় হাতের অক্ষরের অমিল এলার্ট) --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm text-white border-0 m-2 animate__animated animate__shakeX" 
         style="background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%); border-radius: 4px; font-weight: 600;">
        <div class="d-flex align-items-center justify-content-between p-2">
            <div><i class="fas fa-exclamation-triangle mr-2" style="font-size: 18px;"></i> {{ $errors->first() }}</div>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="outline: none;"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
@endif

<div class="card shadow-sm border-0" style="border-radius: 4px;">
    <div class="card-body p-3">
        
        {{-- 📱 ১০০% মোবাইল ও ট্যাবলেট রেসপন্সিভ কন্টেইনার ডিব --}}
        <div class="table-responsive w-100" style="border-radius: 4px; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered table-striped mb-0 text-center" id="bactaDesigTable" style="background: #fff; font-size: 13px; min-width: 800px;">
                <thead class="bg-light" style="font-size: 12px; font-weight: bold; text-transform: uppercase; color: #1E40AF !important;">
                    <tr>
                        <th style="width: 60px;">SL</th>
                        <th class="text-left">CONSTITUTIONAL BOARD DESIGNATION NAME</th>
                        <th>STATUS</th>
                        <th style="width: 120px;">OPTIONS</th>
                    </tr>
                </thead>
                <tbody style="color: #333; font-weight: 500;">
                    @foreach($bactaDesignations as $key => $row)
                    <tr>
                        <td class="text-muted font-weight-bold">{{ $key + 1 }}</td>
                        <td class="text-left font-weight-bold text-dark" style="font-size: 14px;">{{ $row->title }}</td>
                        <td>
                            <span class="badge badge-success px-2 py-1" style="font-size: 10px; font-weight: bold; border-radius: 2px; background-color: #28a745 !important;">Active</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                {{-- আপনার নিজস্ব অ্যাকশন বাটন - BACTA থিম সিঙ্কড --}}
                                <button type="button" class="btn btn-sm text-white font-weight-bold dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0F172A; border-radius: 4px; font-size: 12px; border: none;">
                                    <i class="fas fa-cog mr-1"></i> Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow-sm" style="font-size: 13px; border-radius: 4px;">
                                    <a class="dropdown-item text-primary font-weight-bold btn-edit-trigger" href="javascript:void(0)"
                                       data-toggle="modal" data-target="#editBactaDesigModal"
                                       data-id="{{ $row->id }}" data-name="{{ $row->title }}"><i class="fas fa-edit mr-2 text-primary"></i> Edit Record</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger font-weight-bold btn-delete-trigger" href="javascript:void(0)"
                                       data-toggle="modal" data-target="#deleteBactaDesigModal"
                                       data-id="{{ $row->id }}" data-name="{{ $row->title }}"><i class="fas fa-trash-alt mr-2 text-danger"></i> Archive / Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 📥 মডাল ১: অ্যাড BACTA ডেজিগনেশন পপ-আপ ফর্ম 📥 --}}
<div class="modal fade" id="addBactaDesigModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white" style="background: #1E40AF;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-award mr-2"></i> Configure New BACTA Designation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.bacta_desig.store') }}" method="POST" id="addForm" autocomplete="off" novalidate onsubmit="return false;">
                @csrf
                <div class="modal-body p-4 bg-white" style="font-size: 13px;">
                    <div id="add-modal-alert" class="alert alert-danger d-none text-sm font-weight-bold border-0 rounded mb-3 animate__animated animate__fadeIn"></div>
                    
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-navy mb-2"><i class="fas fa-network-wired mr-1 text-info"></i> CONSTITUTIONAL DESIGNATION NAME *</label>
                        <div class="input-group shadow-sm bct-input-wrapper" style="border-radius: 4px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="color: #1E40AF;"><i class="fas fa-award"></i></span>
                            </div>
                            <input type="text" name="title" id="add_name_field" class="form-control form-control-sm font-weight-bold border-left-0" required placeholder="e.g. President, General Secretary, Treasurer" style="height: 42px; font-size: 14px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 pt-3">
                    <button type="button" class="btn btn-default btn-sm px-4 shadow-sm" data-dismiss="modal" style="border-radius: 4px; height: 38px; font-weight: 600;"><i class="fas fa-times-circle mr-1.5"></i> Close</button>
                    <button type="button" id="addSaveBtn" onclick="submitBactaAddForm()" class="btn text-white btn-sm px-5 font-weight-bold shadow-sm" style="background-color: #1E40AF; border-radius: 4px; height: 38px;"><i class="fas fa-check-circle mr-1.5"></i> Confirm Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- 🔄 মডাল ২: ডাইনামিক এডিট BACTA ডেজিগনেশন পপ-আপ ফর্ম 🔄 --}}
<div class="modal fade" id="editBactaDesigModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white" style="background: #e41e26;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-edit mr-2"></i> Update Designation Configuration</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST" id="editBactaDesigForm" autocomplete="off" novalidate onsubmit="return false;">
                @csrf
                <div class="modal-body p-4 bg-white" style="font-size: 13px;">
                    <div id="edit-modal-alert" class="alert alert-danger d-none text-sm font-weight-bold border-0 rounded mb-3 animate__animated animate__fadeIn"></div>
                    
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-danger mb-2"><i class="fas fa-network-wired mr-1 text-danger"></i> CONSTITUTIONAL DESIGNATION NAME *</label>
                        <div class="input-group shadow-sm bct-edit-input-wrapper" style="border-radius: 4px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="color: #e41e26;"><i class="fas fa-award"></i></span>
                            </div>
                            <input type="text" name="title" id="edit_name" class="form-control form-control-sm font-weight-bold border-left-0" required style="height: 42px; font-size: 14px; color: #e41e26;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 pt-3">
                    <button type="button" class="btn btn-default btn-sm px-4 shadow-sm" data-dismiss="modal" style="border-radius: 4px; height: 38px; font-weight: 600;"><i class="fas fa-times-circle mr-1.5"></i> Cancel</button>
                    <button type="button" id="editSaveBtn" onclick="submitBactaEditForm()" class="btn btn-danger btn-sm px-5 font-weight-bold shadow-sm" style="background-color: #e41e26; border-color: #e41e26; border-radius: 4px; height: 38px;"><i class="fas fa-check-circle mr-1.5"></i> Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 🗑️ মডাল ৩: ডিলিট কনফার্মেশন পপ-আপ মডাল 🗑️ --}}
<div class="modal fade" id="deleteBactaDesigModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white bg-danger" style="background-color: #be0b12 !important;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Archive</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-4 text-center bg-white">
                <div class="text-danger mb-3" style="font-size: 40px; color: #be0b12 !important;"><i class="fas fa-trash-alt animate__animated animate__bounceIn"></i></div>
                <h5 class="font-weight-bold text-dark">আপনি কি নিশ্চিত?</h5>
                <p class="text-muted" style="font-size: 13px;">কমিটির পদবি: <strong id="delete_title" class="text-danger text-uppercase" style="color: #be0b12 !important;"></strong><br>আর্কাইভ করার পর একে মেইন ডিরেক্টরি লিস্ট থেকে safely লুকিয়ে রাখা হবে।</p>
            </div>
            <div class="modal-footer bg-light justify-content-center pt-3">
                <button type="button" class="btn btn-default btn-sm px-4 mr-2 shadow-sm" data-dismiss="modal" style="border-radius: 4px; height: 38px; font-weight: 600;"><i class="fas fa-times-circle mr-1.5"></i> বাতিল</button>
                <form action="" method="POST" id="finalDeleteForm" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="deleteSaveBtn" class="btn btn-danger btn-sm px-5 font-weight-bold shadow-sm" style="background-color: #be0b12 !important; border-radius: 4px; height: 38px;"><i class="fas fa-trash-alt mr-1"></i> হ্যাঁ, আর্কাইভ করুন!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .text-navy { color: #1E40AF !important; }
    .table td, .table th { vertical-align: middle !important; padding: 12px 8px !important; }
    .btn-group .btn { border: 1px solid #f0f0f0; background: #fff; }
    .dropdown-item { padding: 8px 16px !important; }
    .dropdown-item:hover { background-color: #f0f7ff !important; color: #1E40AF !important; }
    .table-responsive {-webkit-overflow-scrolling: touch;}
    
    .dataTables_filter input { border-radius: 4px; padding: 6px 12px; border: 1px solid #ced4da; width: 220px !important; outline: none; font-size: 13px; font-weight: 500; }
    .dataTables_filter input:focus { border-color: #1E40AF !important; }
    .page-item.active .page-link { background-color: #1E40AF !important; border-color: #1E40AF !important; font-weight: 600; }

    .shake-effect { 
        animation: bctShake 0.4s ease-in-out; 
        border: 1px solid #e41e26 !important; 
        border-radius: 4px; 
    }
    @keyframes bctShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-6px); }
        40%, 80% { transform: translateX(6px); }
    }
</style>
@stop
@section('js')
<script>
    $(document).ready(function() {
        // ১. বিল্ট-ইন সার্চ ও শর্টিং ডাটাটেবল কনফিগারেশন (আপনার মূল ব্লুপ্রিন্ট সিঙ্ক)
        var table = $('#bactaDesigTable').DataTable({
            "destroy": true, 
            "responsive": true, 
            "autoWidth": false, 
            "ordering": true, // কলামের শর্টিং ইঞ্জিন সক্রিয়
            "pageLength": 10,
            "dom": '<"row p-2"<"col-md-6"l><"col-md-6 text-right"f>>rt<"row p-2"<"col-md-5"i><"col-md-7"p>>',
            "language": { 
                "search": "Search:", 
                "searchPlaceholder": "Search designations..." 
            }
        });

        // আপনার নিজস্ব সিরিয়াল নম্বর ইঞ্জিন স্বয়ংক্রিয় সিঙ্ক
        table.on('order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // মডাল ওপেন হওয়ার সাথে সাথে ডিরেক্ট টাইপিং অটো-ফোকাস ট্র্যাকিং
        $('#addBactaDesigModal').on('shown.bs.modal', function () {
            $('#add_name_field').focus();
        });

        // ডাইনামিক এডিট মডাল ডাটা এবং রাউট ইউআরএল পাসিং (আপনার নতুন রাউট অনুযায়ী ফিক্সড)
        $(document).on('click', '.btn-edit-trigger', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            let actionUrl = "{{ route('admin.bacta_desig.update', ':id') }}"; 
            actionUrl = actionUrl.replace(':id', id);
            $('#editBactaDesigForm').attr('action', actionUrl);

            $('#edit_name').val(name);
            $('#edit-modal-alert').addClass('d-none');
            $('#edit_name').removeClass('is-invalid');
        });

        // ডাইনামিক ডিলিট মডাল সিকিউর ফর্ম লিঙ্ক বাইন্ডিং (আপনার নতুন রাউট অনুযায়ী ফিক্সড)
        $(document).on('click', '.btn-delete-trigger', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            let deleteUrl = "{{ route('admin.bacta_desig.delete', ':id') }}";
            deleteUrl = deleteUrl.replace(':id', id);

            $('#delete_title').text(name);
            $('#finalDeleteForm').attr('action', deleteUrl); // সিকিউর ফর্মের অ্যাকশন লিঙ্কিং
        });

        // ৩ সেকেন্ড পর সাকসেস মেসেজ অটো-হাইড লজিক
        if ($('#success-alert').length > 0) {
            setTimeout(function() {
                $('#success-alert').slideUp(500, function() { $(this).remove(); });
            }, 3000);
        }
    });

    // ২. 💡 আল্ট্রা-স্মার্ট অ্যাড ভ্যালিডেশন এবং নে티브 সাবমিশন ইঞ্জিন (BACTA থিম)
    function submitBactaAddForm() {
        let inputName = $('#add_name_field').val().trim();
        
        if (inputName === '') {
            $('#add-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>কমিটির পদবি (Designation Title)</b> টাইপ করুন, তারপর নিচে কনফর্ম বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            $('#add_name_field').addClass('is-invalid').focus();
            
            // ইনপুট বক্সে হালকা ঝাঁকুনি অ্যানিমেশন (আপনার শেকিং ইফেক্ট)
            $('.bct-input-wrapper').addClass('shake-effect');
            setTimeout(function() { $('.bct-input-wrapper').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        // ভ্যালিডেশন পারফেক্ট থাকলে বাটন লক হবে এবং ফর্ম সাবমিট হবে
        $('#addSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving records...');
        document.getElementById('addForm').submit();
    }

    // ৩. 💡 আল্ট্রা-স্মার্ট এডিট ভ্যালিডেশন এবং নেটিভ সাবমিশন ইঞ্জিন (BACTA থিম)
    function submitBactaEditForm() {
        let inputName = $('#edit_name').val().trim();
        
        if (inputName === '') {
            $('#edit-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>কমিটির পদবি</b> টাইপ করুন, তারপর আপডেট বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            $('#edit_name').addClass('is-invalid').focus();
            
            $('.bct-edit-input-wrapper').addClass('shake-effect');
            setTimeout(function() { $('.bct-edit-input-wrapper').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        $('#editSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating changes...');
        document.getElementById('editBactaDesigForm').submit();
    }
</script>
@stop
