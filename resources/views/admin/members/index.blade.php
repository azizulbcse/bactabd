{{-- ওরিজিনাল লোগো আইকন লিংকার --}}
<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 

@extends('adminlte::page')

{{-- ১. আপনার ওরিজিনাল প্রিমিয়াম ঝাঁকুনি এবং মডার্ন রাউন্ডেড শ্যাডো ইনজেকশন --}}
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
    .bct-input-wrapper, .bct-edit-input-wrapper {
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
</style>
@endpush

@section('title', 'Admin & Staff Hub')

{{-- ২. অফিশিয়াল হেডার সেকশন: যেখানে ড্যাশবোর্ড টাইটেল এবং নীল রঙের অ্যাড বাটনটি থাকবে --}}
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
                            <th style="width: 50px;">SL</th>
                            <th style="width: 70px;" class="text-center">Photo</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Mobile No</th>
                            <th>Designation</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="admin-table-rows">
                        {{-- কন্ট্রোলারের ওরিজিনাল $records এবং ডাটাবেজ পাথ অনুযায়ী নিখুঁত সিঙ্কড লুপ --}}
                        @foreach($records as $admin)
                            <tr id="row-user-{{ $admin->id }}">
                                <td class="font-weight-bold align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">
                                    {{-- কোনো সিমলিংক ছাড়া সরাসরি কন্ট্রোলারের ডাটাবেজ পাথ থেকে ছবি ভাসিয়ে দেওয়ার ম্যাজিক নোড --}}
                                    @if(!empty($admin->profile_pic) && file_exists(public_path($admin->profile_pic)))
                                        <img src="{{ asset($admin->profile_pic) }}" 
                                             class="img-circle elevation-1 border shadow-xs" 
                                             style="width: 40px; height: 40px; object-fit: cover;" 
                                             alt="User Image" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="bg-sky-50 text-[#00ADEF] rounded-circle d-none align-items-center justify-content-center font-weight-bold elevation-1 mx-auto" style="width: 40px; height: 40px; background-color: #e0f2fe;">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                    @else
                                        {{-- ডাটাবেজে ছবি না থাকলে ওরিজিনাল স্কাই-ব্লু ফলব্যাক আইকন উইন্ডো --}}
                                        <div class="bg-sky-50 text-[#00ADEF] rounded-circle d-inline-flex align-items-center justify-content-center font-weight-bold elevation-1" style="width: 40px; height: 40px; background-color: #e0f2fe;">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="font-weight-bold text-dark align-middle">{{ $admin->name }}</td>
                                <td class="align-middle">{{ $admin->email }}</td>
                                <td class="font-weight-bold text-muted align-middle">{{ $admin->mobile_no ?? 'Not Provided' }}</td>
                                <td class="align-middle"><span class="badge bg-info p-2">{{ $admin->designation ?? 'Staff' }}</span></td>
                                <td class="align-middle">
                                    {{-- আপনার ওরিজিনাল ২-বাটন স্লিক কম্বাইন গ্রিড --}}
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
</div> {{-- Main content end section --}}
<!-- ==========================================
     ১. ADD NEW STAFF MODAL (BACTA MODERN THEME)
     ========================================== -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white" style="background-color: #00496A;">
                <h5 class="modal-title font-weight-bold" id="addStaffModalLabel">
                    <i class="fas fa-user-plus mr-2"></i> Register New Staff Profile
                </h5>
                <button type="button" class="close text-white" aria-label="Close" onclick="$('#addStaffModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="addForm" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body bg-light py-4">
                    {{-- ইনলাইন মোডাল ফ্ল্যাশ মেমোরি স্মার্ট এলার্ট কন্টেইনার --}}
                    <div id="add-modal-alert" class="alert alert-danger d-none border-0 shadow-sm mb-3"></div>
                    
                    <div class="row">
                        {{-- বাম কলাম: বেসিক আইডেন্টিটি ইনফো --}}
                        <div class="col-md-6 border-right">
                            <h6 class="font-weight-bold text-uppercase mb-3" style="color: #00496A; letter-spacing: 0.5px;">
                                <i class="fas fa-id-card mr-1"></i> Identity & Placement
                            </h6>
                            
                            <!-- ইনপুট ১: ফুল নেম -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" id="add_name_field" class="form-control border-left-0" placeholder="Type full name here" required>
                                </div>
                            </div>
                            
                            <!-- ইনপুট ২: চিকিৎসা পদবি -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Designation Title <span class="text-danger">*</span></label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user-md text-muted"></i></span>
                                    </div>
                                    <input type="text" name="designation" id="add_designation_field" class="form-control border-left-0" placeholder="e.g. Senior Consultant" required>
                                </div>
                            </div>

                            <!-- ইনপুট ৩: মেম্বার ক্যাটাগরি টাইপ -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Membership Category <span class="text-danger">*</span></label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-layer-group text-muted"></i></span>
                                    </div>
                                    <select name="member_type" id="add_member_type" class="form-control border-left-0" required>
                                        <option value="general">General Member</option>
                                        <option value="premium">Premium Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- ডান কলাম: কন্টাক্ট চ্যানেল ও প্রোফাইল ইমেজ উইন্ডো --}}
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-uppercase mb-3" style="color: #00496A; letter-spacing: 0.5px;">
                                <i class="fas fa-address-book mr-1"></i> Communication & Security
                            </h6>
                            
                            <!-- ইনপুট ৪: ইমেইল এড্রেস -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" id="add_email_field" class="form-control border-left-0" placeholder="username@domain.com" required>
                                </div>
                            </div>
                            
                            <!-- ইনপুট ৫: মোবাইল নম্বর -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Mobile Number</label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-phone text-muted"></i></span>
                                    </div>
                                    <input type="text" name="mobile_no" id="add_phone_field" class="form-control border-left-0" placeholder="e.g. +88017xxxxxxxx">
                                </div>
                            </div>

                            <!-- ইনপুট ৬: অ্যাকাউন্ট পাসওয়ার্ড ফিল্ড (যা ডাটাবেজ সেভের জ্যাম ছুটোবে) -->
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Account Password <span class="text-danger">*</span></label>
                                <div class="input-group bct-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password" id="add_password_field" class="form-control border-left-0" placeholder="Minimum 8 characters" required>
                                </div>
                            </div>

                            <!-- ইনপুট ৭: ওরিজিনাল ও ছিমছাম গোল লাইভ প্রিভিউ উইন্ডো নোড -->
                            <div class="form-group mb-0">
                                <label class="text-secondary small font-weight-bold">Profile Picture (JPG/PNG)</label>
                                <div class="d-flex align-items-center">
                                    <div class="custom-file bct-input-wrapper flex-grow-1 mr-3">
                                        <input type="file" name="profile_pic" id="add_profile_pic" class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label border-light text-muted text-truncate" for="add_profile_pic">Choose pic...</label>
                                    </div>
                                    <div class="text-center" style="width: 55px;">
                                        <img id="add_preview_window" src="{{ asset('vendor/adminlte/dist/img/avatar5.png') }}" class="image-preview-circle" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div> {{-- row end --}}
                    </div>
                </div>
                
                {{-- অ্যাকশন কন্ট্রোলার বাটন: স্মার্ট সেভ বাটন আইকন নোড --}}
                <div class="modal-footer bg-white border-top-0 justify-content-between">
                    <button type="button" class="btn btn-default font-weight-bold" onclick="$('#addStaffModal').modal('hide');">Close</button>
                    <button type="button" id="addSaveBtn" onclick="submitBactaAddForm();" class="btn btn-primary font-weight-bold px-4 shadow-sm" style="background-color: #00496A; border: none;">
                        <i class="fas fa-check-circle mr-1"></i> Save Member Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ==========================================
     ২. EDIT MEMBER MODAL (GENUINE MODERN THEME)
     ========================================== -->
<div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold" id="editMemberModalLabel">
                    <i class="fas fa-edit mr-2"></i> Update Staff Corporate Profile
                </h5>
                <button type="button" class="close text-white" aria-label="Close" onclick="$('#editMemberModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="editMedDesigForm" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body bg-light py-4">
                    <div id="edit-modal-alert" class="alert alert-danger d-none border-0 shadow-sm mb-3"></div>
                    
                    <div class="row">
                        <div class="col-md-6 border-right">
                            <h6 class="text-info font-weight-bold text-uppercase mb-3" style="letter-spacing: 0.5px;">
                                <i class="fas fa-id-card mr-1"></i> Identity & Placement
                            </h6>
                            
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group bct-edit-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" id="edit_name" class="form-control border-left-0" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Designation Title <span class="text-danger">*</span></label>
                                <div class="input-group bct-edit-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user-md text-muted"></i></span>
                                    </div>
                                    <input type="text" name="designation" id="edit_designation" class="form-control border-left-0" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Membership Category <span class="text-danger">*</span></label>
                                <div class="input-group bct-edit-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-layer-group text-muted"></i></span>
                                    </div>
                                    <select name="member_type" id="edit_member_type" class="form-control border-left-0" required>
                                        <option value="general">General Member</option>
                                        <option value="premium">Premium Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="text-info font-weight-bold text-uppercase mb-3" style="letter-spacing: 0.5px;">
                                <i class="fas fa-address-book mr-1"></i> Communication & Profile
                            </h6>
                            
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group bct-edit-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" id="edit_email" class="form-control border-left-0" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="text-secondary small font-weight-bold">Mobile Number</label>
                                <div class="input-group bct-edit-input-wrapper">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-phone text-muted"></i></span>
                                    </div>
                                    <input type="text" name="mobile_no" id="edit_phone" class="form-control border-left-0">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label class="text-secondary small font-weight-bold">Update Profile Picture</label>
                                <div class="d-flex align-items-center">
                                    <div class="custom-file bct-edit-input-wrapper flex-grow-1 mr-3">
                                        <input type="file" name="profile_pic" id="edit_profile_pic" class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label border-light text-muted text-truncate" for="edit_profile_pic">Change picture...</label>
                                    </div>
                                    <div class="text-center" style="width: 55px;">
                                        <img id="edit_preview_window" src="" class="image-preview-circle" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-white border-top-0 justify-content-between">
                    <button type="button" class="btn btn-default font-weight-bold" onclick="$('#editMemberModal').modal('hide');">Close</button>
                    <button type="button" id="editSaveBtn" onclick="submitBactaEditForm();" class="btn btn-info text-white font-weight-bold px-4 shadow-sm">
                        <i class="fas fa-upload mr-1"></i> Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     ৩. CONFIRM DELETE MODAL
     ========================================== -->
<div class="modal fade" id="archiveMemberModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Delete</h5>
                <button type="button" class="close text-white" onclick="$('#archiveMemberModal').modal('hide');">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="archiveForm">
                @csrf
                <input type="hidden" name="id" id="archive_id">
                <div class="modal-body text-center bg-light py-4">
                    <i class="fas fa-trash-alt text-danger mb-3 animate__animated animate__bounce animate__infinite" style="font-size: 40px;"></i>
                    <p class="text-dark font-weight-bold mb-1" style="font-size: 16px;">Are you sure?</p>
                    <p class="text-muted small px-2">You are permanently deleting <span id="archive_member_name" class="text-danger font-weight-bold"></span>. This action cannot be undone.</p>
                </div>
                <div class="modal-footer bg-white border-top-0 justify-content-between py-2">
                    <button type="button" class="btn btn-default btn-sm font-weight-bold" onclick="$('#archiveMemberModal').modal('hide');">Cancel</button>
                    <button type="submit" id="archiveSubmitBtn" class="btn btn-danger btn-sm font-weight-bold px-3 shadow-sm">
                        <i class="fas fa-trash-alt mr-1"></i> Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // 🔧 fix: আগে এই শর্তটা উল্টো ছিল (isDataTable() টেবিল আগে থেকেই DataTable হলে true দেয়,
        // কিন্তু প্রথম পেজ লোডে টেবিলটা তখনো DataTable হয়ইনি, তাই এটা সবসময় false হতো এবং
        // ভেতরের পুরো ব্লক - showBactaToast ফাংশন ডিফাইনেশন + ছবি প্রিভিউ হ্যান্ডলার - কখনোই
        // রান হতো না। এখন "!" যোগ করে শর্তটা ঠিক করা হলো: DataTable এখনো initialize না
        // হয়ে থাকলেই (স্বাভাবিক প্রথম লোড) ভেতরের কোড রান হবে।
        if (!$.fn.DataTable.isDataTable('#bactaAdminTable')) {
        // ১. থিমের বিল্ট-ইন জেনুইন ডাটাটেবিল সার্চ বক্স ও পেজ নম্বর ফেরত আনার গ্যারান্টেড মেকানিজম
        $('#bactaAdminTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "order": [],
            // 🔧 SL কলামটা এখন আর DB আইডি দেখাচ্ছে না, শুধু ক্রমিক নম্বর। তাই এই কলামে
            // sorting বন্ধ রাখা হলো, আর প্রতিটা row-এর নম্বর এখন তার বর্তমান পেজ/পজিশন
            // অনুযায়ী নিজে থেকে recalculate হবে - sort/search/pagination করলেও ঠিক ১, ২, ৩...
            // ক্রমেই দেখাবে।
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "render": function (data, type, row, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            }],
            "language": {
                "search": "Quick Find:",
                "paginate": {
                    "previous": "<i class='fas fa-angle-left'></i>",
                    "next": "<i class='fas fa-angle-right'></i>"
                }
            }
        });

        // ২. কাস্টম আল্ট্রা-স্মার্ট টোস্ট নোটিফিকেশন ইঞ্জিন (কোনো সিমলিংক ছাড়া মেসেজ উইন্ডো)
        window.showBactaToast = function(type, message) {
            let bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
            let iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
            
            let toastHtml = `
                <div class="toast show animate__animated animate__fadeInRight border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 8px; overflow: hidden;">
                    <div class="toast-header text-white ${bgClass} border-0 py-2">
                        <i class="fas ${iconClass} mr-2"></i>
                        <strong class="mr-auto">System Notification</strong>
                        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close" onclick="$('#ajax-toast-box').fadeOut();">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body bg-white font-weight-bold text-dark p-3">
                        ${message}
                    </div>
                </div>
            `;
            $('#ajax-toast-box').html(toastHtml).fadeIn();
            setTimeout(function() { $('#ajax-toast-box').fadeOut('slow'); }, 4000);
        };

        // ৩. আপনার ওরিজিনাল গোল সার্কেল উইন্ডো ইমেজ প্রিভিউ ইঞ্জিন (Add Form)
        $('#add_profile_pic').on('change', function(e) {
            let fileName = e.target.files.length ? e.target.files[0].name : "Choose pic...";
            $(this).next('.custom-file-label').html(fileName);
            
            if(e.target.files.length) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#add_preview_window').attr('src', event.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // ৪. আপনার ওরিজিনাল গোল সার্কেল উইন্ডো ইমেজ প্রিভিউ ইঞ্জিন (Edit Form)
        $('#edit_profile_pic').on('change', function(e) {
            let fileName = e.target.files.length ? e.target.files[0].name : "Change picture...";
            $(this).next('.custom-file-label').html(fileName);
            
            if(e.target.files.length) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#edit_preview_window').attr('src', event.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }
    });

    // ৫. ওরিজিনাল অ্যাড মোডাল ওপেনিং রিসেট নোড ড্রাইভার
    $('#openAddModalBtn').on('click', function() {
        $('#add-modal-alert').addClass('d-none').html('');
        $('.bct-input-wrapper').removeClass('shake-effect');
        $('.form-control').removeClass('is-invalid');
        document.getElementById('addForm').reset();
        $('#add_preview_window').attr('src', '{{ asset("vendor/adminlte/dist/img/avatar5.png") }}');
        $('#add_profile_pic').next('.custom-file-label').html("Choose pic...");
        $('#addStaffModal').modal('show');
    });
    // ৬. ডাটাটেবিল জ্যাম-মুক্ত শতভাগ গ্যারান্টিড ওয়ান-ক্লিক এডিট পপ-আপ গেটওয়ে
    $(document).on('click', '.edit-staff-btn', function() {
        let userId = $(this).data('id');
        
        // ক্লিনআপ
        $('#edit-modal-alert').addClass('d-none').html('');
        $('.bct-edit-input-wrapper').removeClass('shake-effect');
        $('.form-control').removeClass('is-invalid');

        // আপনার ওরিজিনাল রো গ্রিড থেকে ডাটাবেজ নোড রিড
        let row = $('#row-user-' + userId);
        let name = row.find('td:eq(2)').text().trim();
        let email = row.find('td:eq(3)').text().trim();
        let mobile = row.find('td:eq(4)').text().trim();
        if(mobile === 'Not Provided') mobile = '';
        let designation = row.find('td:eq(5)').text().trim();
        let imgUrl = row.find('td:eq(1) img').attr('src') || '{{ asset("vendor/adminlte/dist/img/avatar5.png") }}';

        // মোডাল ইনপুট ফিল্ড ডাইরেক্ট ম্যাপিং
        $('#edit_id').val(userId);
        $('#edit_name').val(name);
        $('#edit_designation').val(designation);
        $('#edit_email').val(email);
        $('#edit_phone').val(mobile);
        $('#edit_preview_window').attr('src', imgUrl);
        $('#edit_profile_pic').next('.custom-file-label').html("Change picture...");
        
        $('#editMemberModal').modal('show');
    });

    // ৭. স্মার্ট ডিলিট মোডাল ওয়ান-ক্লিক লিসেনার পপ-আপ গেটওয়ে
    $(document).on('click', '.delete-staff-btn', function() {
        let userId = $(this).data('id');
        let userName = $('#row-user-' + userId).find('td:eq(2)').text().trim();
        
        $('#archive_id').val(userId);
        $('#archive_member_name').text(userName);
        $('#archiveMemberModal').modal('show');
    });

    // ৮. আল্ট্রা-স্মার্ট অ্যাড ভ্যালিডেশন এবং এজাক্স সাবমিশন ইঞ্জিন (আপনার ওরিজিনাল ঝাঁকুনি লজিক)
    function submitBactaAddForm() {
        let name = $('#add_name_field').val().trim();
        let designation = $('#add_designation_field').val().trim();
        let email = $('#add_email_field').val().trim();
        let password = $('#add_password_field').val().trim();
        
        $('#add-modal-alert').addClass('d-none').html('');
        $('.bct-input-wrapper').removeClass('shake-effect');
        $('.form-control').removeClass('is-invalid');

        if (name === '' || designation === '' || email === '' || password === '') {
            $('#add-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>আবশ্যিক ফিল্ডসমূহ (*)</b> সঠিক নিয়মে টাইপ করুন, তারপর নিচে সেভ বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            
            if(name === '') $('#add_name_field').addClass('is-invalid');
            if(designation === '') $('#add_designation_field').addClass('is-invalid');
            if(email === '') $('#add_email_field').addClass('is-invalid');
            if(password === '') $('#add_password_field').addClass('is-invalid');
            
            $('.bct-input-wrapper').addClass('shake-effect');
            setTimeout(function() { $('.bct-input-wrapper').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        $('#addSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving records...');
        
        let formData = new FormData(document.getElementById('addForm'));
        $.ajax({
            url: "{{ route('admin.members.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#addStaffModal').modal('hide');
                showBactaToast('success', 'New staff profile successfully indexed into live grid!');
                setTimeout(function() { location.reload(); }, 1500);
            },
            error: function(xhr) {
                $('#addSaveBtn').prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Save Member Profile');
                // 🔧 fix: xhr.responseJSON undefined হলে (session expire / 500 error / non-JSON response)
                // এখন fallback message দেখাবে, UI আটকে থাকবে না।
                let errorMsg = '';
                if (xhr.status === 419) {
                    errorMsg = 'আপনার সেশন মেয়াদ শেষ হয়ে গেছে। পেজটি রিফ্রেশ করে আবার লগইন করুন।';
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) { errorMsg += value + '<br>'; });
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else {
                    errorMsg = 'কিছু একটা ভুল হয়েছে (Error ' + xhr.status + ')। আবার চেষ্টা করুন অথবা পেজ রিফ্রেশ করুন।';
                }
                $('#add-modal-alert').removeClass('d-none').html(errorMsg);
            }
        });
    }

    // ৯. আল্ট্রা-স্মার্ট এডিট ভ্যালিডেশন এবং এজাক্স সাবমিশন ইঞ্জিন (আপনার ওরিজিনাল BACTA থিম লজিক)
    function submitBactaEditForm() {
        let name = $('#edit_name').val().trim();
        let designation = $('#edit_designation').val().trim();
        let email = $('#edit_email').val().trim();
        
        // ক্লিনআপ
        $('#edit-modal-alert').addClass('d-none').html('');
        $('.bct-edit-input-wrapper').removeClass('shake-effect');
        $('.form-control').removeClass('is-invalid');
        
        if (name === '' || designation === '' || email === '') {
            $('#edit-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>আবশ্যিক ফিল্ডসমূহ</b> টাইপ করুন, তারপর আপডেট বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            
            if(name === '') $('#edit_name').addClass('is-invalid');
            if(designation === '') $('#edit_designation').addClass('is-invalid');
            if(email === '') $('#edit_email').addClass('is-invalid');
            
            $('.bct-edit-input-wrapper').addClass('shake-effect');
            setTimeout(function() { $('.bct-edit-input-wrapper').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        $('#editSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating changes...');
        
        let formData = new FormData(document.getElementById('editMedDesigForm'));
        let id = $('#edit_id').val();
        
        $.ajax({
            url: "{{ url('admin/members/update-ajax') }}/" + id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editMemberModal').modal('hide');
                showBactaToast('success', 'Staff profile changes successfully synchronized live!');
                setTimeout(function() { location.reload(); }, 1500);
            },
            error: function(xhr) {
                $('#editSaveBtn').prop('disabled', false).html('<i class="fas fa-upload mr-1"></i> Update Changes');
                // 🔧 fix: xhr.responseJSON undefined হলে (session expire / 500 error / non-JSON response)
                // এখন fallback message দেখাবে, UI আটকে থাকবে না।
                let errorMsg = '';
                if (xhr.status === 419) {
                    errorMsg = 'আপনার সেশন মেয়াদ শেষ হয়ে গেছে। পেজটি রিফ্রেশ করে আবার লগইন করুন।';
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) { errorMsg += value + '<br>'; });
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else {
                    errorMsg = 'কিছু একটা ভুল হয়েছে (Error ' + xhr.status + ')। আবার চেষ্টা করুন অথবা পেজ রিফ্রেশ করুন।';
                }
                $('#edit-modal-alert').removeClass('d-none').html(errorMsg);
            }
        });
    }

    // ১০. সিকিউর ডিলিট সাবমিশন ইঞ্জিন
    $('#archiveForm').on('submit', function(e) {
        e.preventDefault();
        $('#archiveSubmitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Deleting...');
        
        let id = $('#archive_id').val();
        $.ajax({
            url: "{{ url('admin/members/destroy') }}/" + id,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                $('#archiveMemberModal').modal('hide');
                $('#row-user-' + id).fadeOut('slow');
                showBactaToast('success', 'Staff profile permanently deleted!');
            },
            error: function() {
                $('#archiveSubmitBtn').prop('disabled', false).html('<i class="fas fa-trash-alt mr-1"></i> Yes, Delete');
                showBactaToast('error', 'Failed to delete member profile! Try again.');
            }
        });
    });
</script>
@stop