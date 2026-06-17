@extends('adminlte::page')

@section('title', 'Hospitals Master Registry')

{{-- ১. অফিশিয়াল হেডার সেকশন: যেখানে ড্যাশবোর্ড টাইটেল এবং নীল রঙের অ্যাড বাটনটি থাকবে --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center animate__animated animate__fadeIn">
        <h1 style="color: #00496A; font-weight: 700; font-family: 'Poppins', sans-serif;">
            <i class="fas fa-hospital mr-2" style="color: #00ADEF;"></i> Hospitals Master Registry
        </h1>
        <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" id="openHospitalModalBtn" style="background-color: #00496A; border: none; border-radius: 8px; transition: 0.3s;">
            <i class="fas fa-plus-circle mr-2"></i> Add New Hospital
        </button>
    </div>
@stop

{{-- ২. মেইন কন্টেন্ট সেকশন শুরু --}}
@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    
    {{-- ৪ সেকেন্ড পর অটো-হাইড হওয়া স্মার্ট নোটিফিকেশন কাস্টম টোস্ট এরিয়া --}}
    <div id="ajax-toast-box" style="position: fixed; top: 25px; right: 25px; z-index: 9999; min-width: 320px; display: none;"></div>

    <!-- DATA TABLE CARD WRAPPER -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
        <div class="card-body">
            
            <div class="table-responsive">
                <table id="hospitalMasterTable" class="table table-bordered table-striped table-hover w-full text-sm">
                    <thead class="bg-light" style="color: #00496A;">
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th>Hospital Institution Full Name</th>
                            <th style="width: 200px;">Short Name</th>
                            <th style="width: 150px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="hospital-table-rows">
                        @foreach($hospitals as $hospital)
                            <tr id="row-hospital-{{ $hospital->id }}">
                                <td class="font-weight-bold">#{{ $hospital->id }}</td>
                                <td class="font-weight-bold text-dark">{{ $hospital->name }}</td>
                                <td><span class="badge bg-secondary p-2">{{ $hospital->short_name ?? 'N/A' }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger font-weight-bold delete-hospital-btn" data-id="{{ $hospital->id }}" style="border-radius: 6px;">
                                        <i class="fas fa-archive mr-1"></i> Archive
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- ==========================================
     ২. অ্যাড হসপিটাল গ্লোবাল পপআপ মোডাল
     ========================================== -->
<div class="modal fade" id="hospitalGlobalModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
            
            <!-- মোডাল হেডার -->
            <div class="modal-header text-white" style="background-color: #00496A; border-radius: 16px 16px 0 0; padding: 18px 25px;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-hospital mr-2"></i> Register New Hospital Institution
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; outline: none;">
                    <span aria-hidden="true" style="font-size: 24px;">&times;</span>
                </button>
            </div>

            <!-- মোডাল ফর্ম বডি (১টি লাইনে ২টি কলাম গ্রিড লেআউট) -->
            <form id="hospitalForm" autocomplete="off" novalidate>
                @csrf
                <div class="modal-body p-4" style="background-color: #f8fafc;">
                    <div class="row">
                        <!-- কলাম ১: হসপিটালের পূর্ণ নাম -->
                        <div class="col-md-8 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Hospital Full Name [হসপিটালের পূর্ণ নাম] <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-university"></i></span>
                                </div>
                                <input type="text" id="hospital_name" name="name" class="form-control bg-white border-left-0" placeholder="e.g., National Institute of Cardiovascular Diseases" required style="border-radius: 0 8px 8px 0;">
                                <div class="invalid-feedback font-weight-bold mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Please enter the official hospital full name.
                                </div>
                            </div>
                        </div>

                        <!-- কলাম ২: হসপিটালের সংক্ষিপ্ত নাম -->
                        <div class="col-md-4 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Short Name [সংক্ষিপ্ত রূপ]</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" id="hospital_short" name="short_name" class="form-control bg-white border-left-0" placeholder="e.g., NICVD" style="border-radius: 0 8px 8px 0;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- মোডাল ফুটার অ্যাকশন বাটনস -->
                <div class="modal-footer bg-white border-top justify-content-between p-3" style="border-radius: 0 0 16px 16px;">
                    <button type="button" class="btn btn-secondary px-4 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold" id="btnSubmitHospital" style="background-color: #28a745; border: none; border-radius: 8px;">
                        <i class="fas fa-save mr-1"></i> <span id="btnSubmitText">Save Institution</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
{{-- ৩. স্মার্ট ওয়ান-ক্লিক AJAX কোর জাভাস্ক্রিপ্ট কন্ট্রোল ইঞ্জিন --}}
@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // AdminLTE বিল্ট-ইন ডাটাটেবিল ইনিশিয়ালাইজার
        var hTable = $('#hospitalMasterTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Quick Search:",
                "lengthMenu": "Display _MENU_ records per page"
            }
        });

        // ৪ সেকেন্ড অটো-হাইড স্মার্ট ইংরেজি নোটিফিকেশন টোস্ট বক্স
        function showBactaToast(message, type = 'success') {
            let bgColor = type === 'success' ? 'bg-emerald-950 border-emerald-500/30' : 'bg-red-950 border-red-500/30';
            let iconColor = type === 'success' ? 'text-emerald-400 bg-emerald-500/20' : 'text-red-400 bg-red-500/20';
            let icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            let title = type === 'success' ? 'System Notification' : 'Action Blocked';

            let toastHtml = `
                <div class="card p-3 shadow-xl ${bgColor} text-white border animate__animated animate__fadeInRight" style="border-radius: 12px; margin-bottom: 10px;">
                    <div class="d-flex align-items-start gap-2">
                        <div class="rounded p-2 ${iconColor} d-inline-flex mr-2"><i class="fas ${icon} fa-md"></i></div>
                        <div>
                            <h6 class="font-weight-bold mb-0 text-white">${title}</h6>
                            <small class="d-block mt-1 font-weight-bold" style="opacity: 0.95;">${message}</small>
                        </div>
                    </div>
                </div>
            `;
            $('#ajax-toast-box').html(toastHtml).fadeIn('fast');
            setTimeout(function() {
                $('#ajax-toast-box').fadeOut('slow', function() { $(this).empty(); });
            }, 4000);
        }

        // অ্যাড নিউ হসপিটাল বাটন ট্রিগার (ফিক্সড রিসেট মেথড)
        $('#openHospitalModalBtn').on('click', function() {
            $('#hospitalForm')[0].reset();
            $('#hospitalForm').removeClass('was-validated');
            $('#hospitalGlobalModal').modal('show');
        });

        // ওয়ান-ক্লিক AJAX সেভ এবং ডাইনামিক অটো-রিস্টোর অপারেশন
        $('#hospitalForm').on('submit', function(e) {
            e.preventDefault();
            let form = this;

            if (form.checkValidity() === false) {
                e.stopPropagation();
                $(form).addClass('was-validated');
                return false;
            }

            $('#btnSubmitHospital').attr('disabled', true);
            $('#btnSubmitText').text('Verifying Credentials...');

            $.ajax({
                url: "{{ route('admin.hospitals.store') }}",
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    $('#hospitalGlobalModal').modal('hide');
                    showBactaToast(response.success, 'success');
                    setTimeout(function() { location.reload(); }, 1200);
                },
                error: function(xhr) {
                    $('#btnSubmitHospital').attr('disabled', false);
                    $('#btnSubmitText').text('Save Institution');
                    if (xhr.status === 422) {
                        let errorResponse = xhr.responseJSON.error ? xhr.responseJSON.error : "Validation error occurred.";
                        showBactaToast(errorResponse, 'error');
                    } else {
                        showBactaToast("System internal registry error failed.", 'error');
                    }
                }
            });
        });

        // কড়া সতর্কবার্তা সহ ওয়ান-ক্লিক সফট ডিলিট মেকানিজম
        $(document).on('click', '.delete-hospital-btn', function() {
            let hospitalId = $(this).data('id');
            let rowTarget = $(this).closest('tr');

            let confirmAlert = confirm("⚠️ SECURITY WARNING! Are you absolutely sure you want to deactivate and archive this hospital institution record? It will be safely stored in the backup logs.");
            
            if (confirmAlert) {
                $.ajax({
                    url: "/admin/hospitals/delete/" + hospitalId,
                    type: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        rowTarget.addClass('animate__animated animate__fadeOutLeft');
                        setTimeout(function() { hTable.row(rowTarget).remove().draw(false); }, 800);
                        showBactaToast(response.success, 'success');
                    },
                    error: function() {
                        showBactaToast("Security compliance blocked this deactivation track.", 'error');
                    }
                });
            }
        });
    });
</script>
@stop
