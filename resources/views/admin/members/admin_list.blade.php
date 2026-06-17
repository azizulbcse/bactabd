@extends('adminlte::page')

@section('title', 'Admin & Staff Hub')

{{-- ১. অফিশিয়াল হেডার সেকশন: যেখানে ড্যাশবোর্ড টাইটেল এবং নীল রঙের অ্যাড বাটনটি থাকবে --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center animate__animated animate__fadeIn">
        <h1 style="color: #00496A; font-weight: 700; font-family: 'Poppins', sans-serif;">
            <i class="fas fa-users-cog mr-2" style="color: #00ADEF;"></i> System Admin & Staff Hub
        </h1>
        <button type="button" class="btn btn-primary px-4 py-2 font-weight-bold shadow-sm" id="openAddModalBtn" style="background-color: #00496A; border: none; border-radius: 8px; transition: 0.3s;">
            <i class="fas fa-user-plus mr-2"></i> Add New Staff
        </button>
    </div>
@stop
{{-- ২. মেইন কন্টেন্ট সেকশন শুরু (পুরো ফাইলের ভেতর এটি কেবল একবারই থাকবে ভাই) --}}
@section('content')
<div class="container-fluid animate__animated animate__fadeInUp" style="font-family: 'Poppins', sans-serif;">
    
    {{-- ৪ সেকেন্ড পর অটো-হাইড হওয়া স্মার্ট নোটিফিকেশন কাস্টম টোস্ট বক্স --}}
    <div id="ajax-toast-box" style="position: fixed; top: 25px; right: 25px; z-index: 9999; min-width: 320px; display: none;"></div>

    <!-- DATA TABLE CARD WRAPPER SECTION -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px; border-top: 4px solid #00496A !important;">
        <div class="card-body">
            
            <div class="table-responsive">
                {{-- AdminLTE বিল্ট-ইন পেজিনেশন ও কুইক ফিল্টার ডাটাটেবিল --}}
                <table id="bactaAdminTable" class="table table-bordered table-striped table-hover w-full text-sm">
                    <thead class="bg-light" style="color: #00496A;">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th style="width: 70px;" class="text-center">Photo</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Mobile No</th>
                            <th>Designation</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-table-rows">
                        @foreach($admins as $admin)
                            <tr id="row-user-{{ $admin->id }}">
                                <td class="font-weight-bold">#{{ $admin->id }}</td>
                                <td class="text-center">
                                    @if($admin->profile_pic)
                                        <img src="{{ asset('storage/' . $admin->profile_pic) }}" class="img-circle elevation-1" style="width: 40px; height: 40px; object-fit: cover;" alt="User Image">
                                    @else
                                        <div class="bg-sky-50 text-[#00ADEF] rounded-circle d-inline-flex align-items-center justify-center font-weight-bold elevation-1" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="font-weight-bold text-dark">{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="font-weight-bold text-muted">{{ $admin->mobile_no ?? 'Not Provided' }}</td>
                                <td><span class="badge bg-info p-2">{{ $admin->designation ?? 'Staff' }}</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-warning font-weight-bold edit-staff-btn" data-id="{{ $admin->id }}" style="border-radius: 6px 0 0 6px;">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        <button class="btn btn-danger font-weight-bold delete-staff-btn" data-id="{{ $admin->id }}" style="border-radius: 0 6px 6px 0;">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </div>
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
     ৩. অ্যাড এবং এডিট স্টাফ গ্লোবাল পপআপ মোডাল
     ========================================== -->
<div class="modal fade" id="staffGlobalModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
            <div class="modal-header text-white" id="modalHeaderBg" style="background-color: #00496A; border-radius: 16px 16px 0 0; padding: 18px 25px;">
                <h5 class="modal-title font-weight-bold" id="staffModalTitle">
                    <i class="fas fa-user-plus mr-2"></i> Add New Staff Profile
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; outline: none;">
                    <span aria-hidden="true" style="font-size: 24px;">&times;</span>
                </button>
            </div>
            <!-- মোডাল ফর্ম বডি (AJAX এবং ফাইল আপলোড সাপোর্ট সহ) -->
            <form id="staffForm" autocomplete="off" novalidate enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="staff_id" name="staff_id">

                <div class="modal-body p-4" style="background-color: #f8fafc;">
                    
                    <!-- ছবির স্মার্ট লাইভ প্রিভিউ জোন (মোডালের একদম সেন্টারে লকড) -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <div class="bg-white rounded-circle shadow-sm border d-flex align-items-center justify-center overflow-hidden mx-auto" style="width: 100px; height: 100px; border: 3px solid #00ADEF !important;">
                                <img id="profilePreviewImg" src="" class="w-100 h-100 d-none" style="object-fit: cover;">
                                <div id="avatarFallbackIcon" class="text-muted" style="font-size: 36px; color: #a0aec0 !important;">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <label for="profile_pic" class="btn btn-sm btn-info rounded-circle position-absolute" style="bottom: 0; right: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background-color: #00ADEF; border: 2px solid #fff; cursor: pointer;">
                                <i class="fas fa-camera text-xs"></i>
                            </label>
                            <input type="file" id="profile_pic" name="profile_pic" class="d-none" accept="image/*">
                        </div>
                        <small class="text-muted d-block mt-2 font-weight-bold">Profile Image Preview</small>
                    </div>

                    <!-- Row 1: Full Name & Email Address -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Full Name [পূর্ণ নাম] <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" id="staff_name" name="name" class="form-control bg-white border-left-0" placeholder="Dr. Firstname" required style="border-radius: 0 8px 8px 0;">
                                <div class="invalid-feedback font-weight-bold mt-1"><i class="fas fa-exclamation-circle mr-1"></i> নাম লিখুন</div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Email Address [ইমেইল] <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" id="staff_email" name="email" class="form-control bg-white border-left-0" placeholder="staff@bactabd.org" required style="border-radius: 0 8px 8px 0;">
                                <div class="invalid-feedback font-weight-bold mt-1"><i class="fas fa-exclamation-circle mr-1"></i> বৈধ ইমেইল লিখুন</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Mobile Number & Designation -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Mobile Number [মোবাইল]</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="text" id="staff_mobile" name="mobile_no" class="form-control bg-white border-left-0" placeholder="+880" style="border-radius: 0 8px 8px 0;">
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Designation [পদবি]</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-briefcase"></i></span>
                                </div>
                                <input type="text" id="staff_designation" name="designation" class="form-control bg-white border-left-0" placeholder="Consultant" style="border-radius: 0 8px 8px 0;">
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Password & Membership Type -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3" id="passwordWrapperBlock">
                            <label class="font-weight-bold text-secondary small mb-1">Password [পাসওয়ার্ড] <span class="text-danger" id="passReqStar">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 text-[#00ADEF]"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="staff_password" name="password" class="form-control bg-white border-left-0" placeholder="••••••••" required style="border-radius: 0 8px 8px 0;">
                                <div class="invalid-feedback font-weight-bold mt-1"><i class="fas fa-exclamation-circle mr-1"></i> পাসওয়ার্ড লিখুন</div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-secondary small mb-1">Membership Type [সদস্যপদ]</label>
                            <div class="input-group">
                                <select id="staff_member_type" name="member_type" class="form-control bg-white" style="border-radius: 8px;">
                                    <option value="General" selected>General Member</option>
                                    <option value="Lifetime">Life Time Member</option>
                                    <option value="Executive">Executive Member</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- মোডাল ফুটার অ্যাকশন বাটনস -->
                <div class="modal-footer bg-white border-top justify-content-between p-3" style="border-radius: 0 0 16px 16px;">
                    <button type="button" class="btn btn-secondary px-4 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold" id="btnSubmitForm" style="background-color: #28a745; border: none; border-radius: 8px;">
                        <i class="fas fa-save mr-1"></i> <span id="btnSubmitText">Save Account</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
{{-- ৪. কোরের মেইন জাভাস্ক্রিপ্ট সেটিংস ও ওয়ান-ক্লিক AJAX লজিক --}}
@section('js')
<script>
    $(document).ready(function() {
        // ল্যারাভেলের সিকিউর AJAX টোকেন সেটিংস
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // AdminLTE এর বিল্ট-ইন DataTables অ্যাক্টিভেট করার কাস্টম ইনিশিয়ালাইজার
        var bTable = $('#bactaAdminTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Quick Filter:",
                "lengthMenu": "Show _MENU_ records per page",
            }
        });

        // কাস্টম নোটিফিকেশন টোস্ট অ্যালার্ট (৪ সেকেন্ড পর অটো-হাইড হবে)
        function showBactaToast(message, type = 'success') {
            let bgColor = type === 'success' ? 'bg-emerald-950 border-emerald-500/30' : 'bg-red-950 border-red-500/30';
            let iconColor = type === 'success' ? 'text-emerald-400 bg-emerald-500/20' : 'text-red-400 bg-red-500/20';
            let icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            let title = type === 'success' ? 'Action Successful' : 'Action Failed';

            let toastHtml = `
                <div class="card p-3 shadow-xl ${bgColor} text-white border animate__animated animate__fadeInRight" style="border-radius: 12px; margin-bottom: 10px;">
                    <div class="d-flex align-items-start gap-2">
                        <div class="rounded p-2 ${iconColor} d-inline-flex mr-2">
                            <i class="fas ${icon} fa-md"></i>
                        </div>
                        <div>
                            <h6 class="font-weight-bold mb-0 text-white">${title}</h6>
                            <small class="d-block mt-1 font-weight-bold" style="opacity:0.9;">${message}</small>
                        </div>
                    </div>
                </div>
            `;
            $('#ajax-toast-box').html(toastHtml).fadeIn('fast');
            
            setTimeout(function() {
                $('#ajax-toast-box').fadeOut('slow', function() { $(this).empty(); });
            }, 4000);
        }

        // ওয়ান-ক্লিক রিয়েল-টাইম ইমেজ প্রিভিউ মেকানিজম
        $('#profile_pic').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePreviewImg').attr('src', e.target.result).removeClass('d-none');
                    $('#avatarFallbackIcon').addClass('d-none');
                }
                reader.readAsDataURL(file);
            }
        });

        // অ্যাড নিউスタッフ বাটন ক্লিক লজিক (Fixed: জাভাস্ক্রিপ্ট ফর্ম রিসেট সিনট্যাক্স)
        $('#openAddModalBtn').on('click', function() {
            $('#staffForm')[0].reset(); // ফিক্সড: সঠিক জাভাস্ক্রিপ্ট রিসেট মেথড
            $('#staffForm').removeClass('was-validated');
            $('#staff_id').val('');
            
            $('#staff_password').attr('required', true);
            $('#passReqStar').removeClass('d-none');
            
            $('#profilePreviewImg').addClass('d-none').attr('src', '');
            $('#avatarFallbackIcon').removeClass('d-none');
            
            $('#staffModalTitle').html('<i class="fas fa-user-plus mr-2"></i> Add New Staff Profile');
            $('#modalHeaderBg').css('background-color', '#00496A');
            $('#staffGlobalModal').modal('show');
        });

        // ডাটাবেজ থেকে ওয়ান-ক্লিক AJAX এডিট লজিক (Fixed: জাভাস্ক্রিপ্ট ফর্ম রিসেট সিনট্যাক্স)
        $(document).on('click', '.edit-staff-btn', function() {
            let staffId = $(this).data('id');
            $('#staffForm')[0].reset(); // ফিক্সড: সঠিক জাভাস্ক্রিপ্ট রিসেট মেথড
            $('#staffForm').removeClass('was-validated');

            $('#staff_password').removeAttr('required');
            $('#passReqStar').addClass('d-none');

            $.get("/admin/members/ajax-edit/" + staffId, function(data) {
                $('#staff_id').val(data.id);
                $('#staff_name').val(data.name);
                $('#staff_email').val(data.email);
                $('#staff_mobile').val(data.mobile_no);
                $('#staff_designation').val(data.designation);
                $('#staff_member_type').val(data.member_type || 'General');

                if (data.profile_pic) {
                    $('#profilePreviewImg').attr('src', '/storage/' + data.profile_pic).removeClass('d-none');
                    $('#avatarFallbackIcon').addClass('d-none');
                } else {
                    $('#profilePreviewImg').addClass('d-none').attr('src', '');
                    $('#avatarFallbackIcon').removeClass('d-none');
                }

                $('#staffModalTitle').html('<i class="fas fa-edit mr-2"></i> Edit Staff Profile Details');
                $('#modalHeaderBg').css('background-color', '#e0a800');
                $('#staffGlobalModal').modal('show');
            }).fail(function() {
                showBactaToast("Failed to fetch profile data from server.", "error");
            });
        });

        // ওয়ান-ক্লিক AJAX ফর্ম সেভ ও আপডেট লজিক
        $('#staffForm').on('submit', function(e) {
            e.preventDefault();
            
            let form = this;
            let staffId = $('#staff_id').val();
            
            if (form.checkValidity() === false) {
                e.stopPropagation();
                $(form).addClass('was-validated');
                return false;
            }

            $('#btnSubmitForm').attr('disabled', true);
            $('#btnSubmitText').text('Processing Action...');

            let formData = new FormData(form);
            let targetUrl = staffId ? "/admin/members/ajax-update/" + staffId : "/admin/members/ajax-store";

            $.ajax({
                url: targetUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#staffGlobalModal').modal('hide');
                    showBactaToast(response.success, 'success');
                    
                    setTimeout(function() {
                        location.reload();
                    }, 1200);
                },
                error: function(xhr) {
                    $('#btnSubmitForm').attr('disabled', false);
                    $('#btnSubmitText').text('Save Account');
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let firstError = Object.values(errors);
                        showBactaToast(firstError[0], 'error');
                    } else {
                        showBactaToast("An error occurred while saving records.", 'error');
                    }
                }
            });
        });

        // সিকিউরড পার্মানেন্ট ডিলিট লজিক
        $(document).on('click', '.delete-staff-btn', function() {
            let staffId = $(this).data('id');
            
            let confirmAlert = confirm("⚠️ ATTENTION! Are you absolutely sure you want to permanently delete this staff profile?");
            
            if (confirmAlert) {
                let rowTarget = $(this).closest('tr');
                
                $.ajax({
                    url: "/admin/members/delete/" + staffId,
                    type: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        rowTarget.addClass('animate__animated animate__fadeOutLeft');
                        setTimeout(function() {
                            bTable.row(rowTarget).remove().draw(false);
                        }, 800);
                        
                        showBactaToast(response.success, 'success');
                    },
                    error: function() {
                        showBactaToast("Unauthorized action or server connection failed.", 'error');
                    }
                });
            }
        });
    });
</script>
@stop
