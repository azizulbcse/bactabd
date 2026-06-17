@extends('adminlte::page')

@section('title', 'Membership Hub Setup | BACTA')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap animate__animated animate__fadeIn">
        <h1 class="font-weight-bold text-dark" style="font-size: 24px; font-weight: 700 !important; letter-spacing: -0.5px;">
            <i class="fas fa-shield-alt mr-2 text-[#0284C7]"></i> Governance & Membership Hub
        </h1>
        <button type="button" class="btn text-white font-weight-bold shadow-sm mb-2" data-toggle="modal" data-target="#addMemberModal" style="background-color: #1E40AF; border-radius: 4px; font-size: 14px; border: none; transition: 0.3s;">
            <i class="fas fa-user-plus mr-1"></i> Register New Member
        </button>
    </div>
@stop

@section('content')
{{-- ৩ সেকেন্ড পর অটো-হাইড সাকসেস অ্যালার্ট --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm text-white border-0 m-2 animate__animated animate__fadeInDown" 
         id="success-alert" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); border-radius: 4px; font-weight: 600;">
        <div class="d-flex align-items-center justify-content-between p-2">
            <div><i class="fas fa-check-circle mr-2" style="font-size: 18px;"></i> {{ session('success') }}</div>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close" style="outline: none;"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
@endif

{{-- ল্যারাভেল ব্যাকএন্ড ভ্যালিডেশন এরর অ্যালার্ট --}}
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
        <div class="table-responsive w-100" style="border-radius: 4px; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered table-striped mb-0 text-center" id="memberHubTable" style="background: #fff; font-size: 13px; min-width: 1000px;">
                <thead class="bg-light" style="font-size: 12px; font-weight: bold; text-transform: uppercase; color: #1E40AF !important;">
                    <tr>
                        <th style="width: 50px;">SL</th>
                        <th style="width: 60px;">PHOTO</th>
                        <th class="text-left">DOCTOR FULL NAME</th>
                        <th>CATEGORY</th>
                        <th>CONSTITUTIONAL TITLE</th>
                        <th class="text-left">HOSPITAL INSTITUTION</th>
                        <th style="width: 80px;">SORT</th>
                        <th style="width: 120px;">OPTIONS</th>
                    </tr>
                </thead>
                <tbody style="color: #333; font-weight: 500;">
                    @foreach($members as $key => $row)
                    <tr>
                        <td class="text-muted font-weight-bold">{{ $key + 1 }}</td>
                        <td>
                            @if($row->member_pic)
                                <img src="{{ asset('storage/' . $row->member_pic) }}" class="img-thumbnail rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center text-muted" style="width: 35px; height: 35px;"><i class="fas fa-user-md"></i></div>
                            @endif
                        </td>
                        <td class="text-left font-weight-bold text-dark" style="font-size: 14px;">{{ $row->name }}</td>
                        <td>
                            @if($row->member_category == 'Executive')
                                <span class="badge badge-primary px-2 py-1" style="font-size: 10px; border-radius: 2px; background-color: #1E40AF !important;">Executive</span>
                            @elseif($row->member_category == 'Lifetime')
                                <span class="badge badge-warning text-white px-2 py-1" style="font-size: 10px; border-radius: 2px; background-color: #D97706 !important;">Lifetime</span>
                            @else
                                <span class="badge badge-info px-2 py-1" style="font-size: 10px; border-radius: 2px; background-color: #0284C7 !important;">Active</span>
                            @endif
                        </td>
                        <td><span class="text-navy font-weight-bold">{{ $row->bactaDesignation->title ?? 'N/A' }}</span></td>
                        <td class="text-left font-weight-bold text-muted" style="font-size: 12px;">{{ $row->hospital->name ?? 'N/A' }}</td>
                        <td class="font-weight-bold text-info">{{ $row->sort_order }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm text-white font-weight-bold dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0F172A; border-radius: 4px; font-size: 12px; border: none;">
                                    <i class="fas fa-cog mr-1"></i> Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow-sm" style="font-size: 13px; border-radius: 4px;">
                                    <a class="dropdown-item text-primary font-weight-bold btn-edit-trigger" href="javascript:void(0)"
                                       data-toggle="modal" data-target="#editMemberModal"
                                       data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-category="{{ $row->member_category }}"
                                       data-hospital="{{ $row->hospital_id }}" data-medical="{{ $row->medical_designation_id }}"
                                       data-bacta="{{ $row->bacta_designation_id }}" data-sort="{{ $row->sort_order }}"
                                       data-pic="{{ $row->member_pic ? asset('storage/' . $row->member_pic) : '' }}"><i class="fas fa-edit mr-2 text-primary"></i> Edit Record</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger font-weight-bold btn-delete-trigger" href="javascript:void(0)"
                                       data-toggle="modal" data-target="#deleteMemberModal"
                                       data-id="{{ $row->id }}" data-name="{{ $row->name }}"><i class="fas fa-trash-alt mr-2 text-danger"></i> Archive / Delete</a>
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

{{-- 📥 মডাল ১: অ্যাড নিউ মেম্বার পপ-আপ ফর্ম (টপ-সেন্টার ইমেজ প্রিভিউ ও ১ সারিতে ২ কলাম) 📥 --}}
<div class="modal fade" id="addMemberModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white" style="background: #1E40AF;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-user-plus mr-2"></i> Register New Member Profile</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.members.store') }}" method="POST" id="addForm" enctype="multipart/form-data" autocomplete="off" novalidate onsubmit="return false;">
                @csrf
                <div class="modal-body p-4 bg-white" style="font-size: 13px;">
                    <div id="add-modal-alert" class="alert alert-danger d-none text-sm font-weight-bold border-0 rounded mb-3 animate__animated animate__fadeIn"></div>
                    
                    {{-- 🎯 ADD IMAGE LIVE PREVIEW ZONE: মডালের ঠিক মাঝখানে সবার উপরে থাকবে --}}
                    <div class="text-center mb-4 d-flex justify-content-center align-items-center flex-column">
                        <div style="position: relative; width: 85px; height: 85px;">
                            <img id="add_pic_preview" src="" class="img-thumbnail rounded-circle shadow-sm border-2 border-primary d-none" style="width: 85px; height: 85px; object-fit: cover;">
                            <div id="add_pic_fallback" class="bg-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center text-muted border" style="width: 85px; height: 85px; font-size: 28px;"><i class="fas fa-user-md"></i></div>
                        </div>
                        <span class="badge badge-primary mt-2 px-2 py-1 font-weight-bold" style="font-size: 10px; border-radius: 2px;">NEW PROFILE MATRIX</span>
                    </div>

                    {{-- ১ সারিতে ২ কলামের স্মার্ট রেসপনসিভ গ্রিড લેઆউট --}}
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-user-md mr-1 text-info"></i> DOCTOR FULL NAME *</label>
                            <div class="input-group shadow-sm bct-input-name" style="border-radius: 4px; overflow: hidden;">
                                <div class="input-group-prepend"><span class="input-group-text bg-light border-right-0" style="color: #1E40AF;"><i class="fas fa-user"></i></span></div>
                                <input type="text" name="name" id="add_name_field" class="form-control form-control-sm font-weight-bold border-left-0" required placeholder="Full Name" style="height: 40px; font-size: 14px;">
                            </div>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-layer-group mr-1 text-info"></i> MEMBERSHIP CATEGORY *</label>
                            <select name="member_category" id="add_category_field" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px;">
                                <option value="Active">Active Member</option>
                                <option value="Lifetime">Lifetime Fellow</option>
                                <option value="Executive">Executive Committee</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-award mr-1 text-info"></i> BACTA BOARD DESIGNATION *</label>
                            <select name="bacta_designation_id" id="add_bacta_field" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px;">
                                @foreach($bactaDesignations as $bDesig)
                                    <option value="{{ $bDesig->id }}">{{ $bDesig->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-user-md mr-1 text-info"></i> MEDICAL CLINICAL DESIGNATION *</label>
                            <select name="medical_designation_id" id="add_medical_field" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px;">
                                @foreach($medicalDesignations as $mDesig)
                                    <option value="{{ $mDesig->id }}">{{ $mDesig->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-hospital mr-1 text-info"></i> HOSPITAL INSTITUTION WORKPLACE *</label>
                            <select name="hospital_id" id="add_hospital_field" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px;">
                                @foreach($hospitals as $hosp)
                                    <option value="{{ $hosp->id }}">{{ $hosp->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-navy mb-2"><i class="fas fa-sort-numeric-down mr-1 text-info"></i> DISPLAY SORT ORDER NUMBER *</label>
                            <input type="number" name="sort_order" id="add_sort_field" class="form-control form-control-sm font-weight-bold shadow-sm" value="99" required style="height: 40px; font-size: 14px; border-radius: 4px;">
                        </div>
                    </div>

                    {{-- 📸 অ্যাড ফর্মের মেইন ইমেজ ইনপুট এলিমেন্ট --}}
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-navy mb-2"><i class="fas fa-camera mr-1 text-info"></i> PROFILE IMAGE UPLOAD</label>
                        <input type="file" name="member_pic" id="add_pic_input" class="form-control-file p-1 border shadow-sm" accept="image/*" style="border-radius: 4px; font-size: 13px;">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 pt-2">
                    <button type="button" class="btn btn-default btn-sm px-4 shadow-sm" data-dismiss="modal" style="border-radius: 4px; height: 38px; font-weight: 600;"><i class="fas fa-times-circle mr-1.5"></i> Close</button>
                    <button type="button" id="addSaveBtn" onclick="submitBactaAddForm()" class="btn text-white btn-sm px-5 font-weight-bold shadow-sm" style="background-color: #1E40AF; border-radius: 4px; height: 38px;"><i class="fas fa-check-circle mr-1.5"></i> Confirm Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- 🔄 মডাল ২: ডাইনামিক এডিট মেম্বার পপ-আপ ফর্ম (টপ-সেন্টার ইমেজ প্রিভিউ জোন) 🔄 --}}
<div class="modal fade" id="editMemberModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white" style="background: #e41e26;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-edit mr-2"></i> Update Member Profile Matrix</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST" id="editMemberForm" enctype="multipart/form-data" autocomplete="off" novalidate onsubmit="return false;">
                @csrf
                <div class="modal-body p-4 bg-white" style="font-size: 13px;">
                    <div id="edit-modal-alert" class="alert alert-danger d-none text-sm font-weight-bold border-0 rounded mb-3 animate__animated animate__fadeIn"></div>
                    
                    {{-- 🎯 SMART EDIT IMAGE PREVIEW AREA: মডালের ঠিক মাঝখানে সবার উপরে থাকবে --}}
                    <div class="text-center mb-4 d-flex justify-content-center align-items-center flex-column">
                        <div style="position: relative; width: 85px; height: 85px;">
                            <img id="edit_pic_preview" src="" class="img-thumbnail rounded-circle shadow-sm border-2 border-danger d-none" style="width: 85px; height: 85px; object-fit: cover;">
                            <div id="edit_pic_fallback" class="bg-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center text-muted border" style="width: 85px; height: 85px; font-size: 28px;"><i class="fas fa-user-md"></i></div>
                        </div>
                        <span class="badge badge-danger mt-2 px-2 py-1 font-weight-bold" style="font-size: 10px; border-radius: 2px;">CURRENT PROFILE MATRIX</span>
                    </div>

                    {{-- ১ সারিতে ২ কলামের রেসপনসিভ গ্রিড --}}
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-user-md mr-1"></i> DOCTOR FULL NAME *</label>
                            <div class="input-group shadow-sm bct-edit-input-wrapper" style="border-radius: 4px; overflow: hidden;">
                                <div class="input-group-prepend"><span class="input-group-text bg-light border-right-0" style="color: #e41e26;"><i class="fas fa-user"></i></span></div>
                                <input type="text" name="name" id="edit_name" class="form-control form-control-sm font-weight-bold border-left-0" required style="height: 40px; font-size: 14px; color: #e41e26;">
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-layer-group mr-1"></i> MEMBERSHIP CATEGORY *</label>
                            <select name="member_category" id="edit_category" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px; color: #e41e26;">
                                <option value="Active">Active Member</option>
                                <option value="Lifetime">Lifetime Fellow</option>
                                <option value="Executive">Executive Committee</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-award mr-1"></i> BACTA BOARD DESIGNATION *</label>
                            <select name="bacta_designation_id" id="edit_bacta" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px; color: #e41e26;">
                                @foreach($bactaDesignations as $bDesig)
                                    <option value="{{ $bDesig->id }}">{{ $bDesig->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-user-md mr-1"></i> MEDICAL CLINICAL DESIGNATION *</label>
                            <select name="medical_designation_id" id="edit_medical" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px; color: #e41e26;">
                                @foreach($medicalDesignations as $mDesig)
                                    <option value="{{ $mDesig->id }}">{{ $mDesig->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-hospital mr-1"></i> HOSPITAL INSTITUTION WORKPLACE *</label>
                            <select name="hospital_id" id="edit_hospital" class="form-control form-control-sm font-weight-bold shadow-sm" style="height: 40px; font-size: 14px; border-radius: 4px; color: #e41e26;">
                                @foreach($hospitals as $hosp)
                                    <option value="{{ $hosp->id }}">{{ $hosp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="font-weight-bold text-danger mb-2"><i class="fas fa-sort-numeric-down mr-1"></i> DISPLAY SORT ORDER NUMBER *</label>
                            <input type="number" name="sort_order" id="edit_sort" class="form-control form-control-sm font-weight-bold shadow-sm" required style="height: 40px; font-size: 14px; color: #e41e26; border-radius: 4px;">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-danger mb-2"><i class="fas fa-camera mr-1"></i> CHANGE PROFILE IMAGE (OPTIONAL)</label>
                        <input type="file" name="member_pic" id="edit_pic_input" class="form-control-file p-1 border shadow-sm" accept="image/*" style="border-radius: 4px; font-size: 13px;">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 pt-2">
                    <button type="button" class="btn btn-default btn-sm px-4 shadow-sm" data-dismiss="modal" style="border-radius: 4px; height: 38px; font-weight: 600;"><i class="fas fa-times-circle mr-1.5"></i> Cancel</button>
                    <button type="button" id="editSaveBtn" onclick="submitBactaEditForm()" class="btn btn-danger btn-sm px-5 font-weight-bold shadow-sm" style="background-color: #e41e26; border-color: #e41e26; border-radius: 4px; height: 38px;"><i class="fas fa-check-circle mr-1.5"></i> Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 🗑️ মডাল ৩: ডিলিট কনফার্মেশন পপ-আপ মডাল 🗑️ --}}
<div class="modal fade" id="deleteMemberModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; border: none;">
            <div class="modal-header text-white bg-danger" style="background-color: #be0b12 !important;">
                <h5 class="modal-title font-weight-bold" style="font-size: 15px;"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Archive</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-4 text-center bg-white">
                <div class="text-danger mb-3" style="font-size: 40px; color: #be0b12 !important;"><i class="fas fa-user-times animate__animated animate__bounceIn"></i></div>
                <h5 class="font-weight-bold text-dark">আপনি কি নিশ্চিত?</h5>
                <p class="text-muted" style="font-size: 13px;">সদস্য ডাক্তার: <strong id="delete_title" class="text-danger text-uppercase" style="color: #be0b12 !important;"></strong><br>আর্কাইভ করার পর একে পাবলিক মেম্বারশিপ ডিরেক্টরি লিস্ট থেকে safely লুকিয়ে রাখা হবে।</p>
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
@stop

@section('css')
<style>
    /* BACTA লোগো রয়্যাল ব্লু থিম টেক্সট ও কাস্টম প্যাডিং সিঙ্ক */
    .text-navy { color: #1E40AF !important; }
    .table td, .table th { vertical-align: middle !important; padding: 12px 8px !important; }
    .btn-group .btn { border: 1px solid #f0f0f0; background: #fff; }
    .dropdown-item { padding: 8px 16px !important; }
    .dropdown-item:hover { background-color: #f0f7ff !important; color: #1E40AF !important; }
    .table-responsive {-webkit-overflow-scrolling: touch;}
    
    /* 🔍 ডাটা-টেবিল কুইক সার্চ ইনপুট গর্জিয়াস থিম সিঙ্ক */
    .dataTables_filter input { border-radius: 4px; padding: 6px 12px; border: 1px solid #ced4da; width: 220px !important; outline: none; font-size: 13px; font-weight: 500; }
    .dataTables_filter input:focus { border-color: #1E40AF !important; }
    .page-item.active .page-link { background-color: #1E40AF !important; border-color: #1E40AF !important; font-weight: 600; }

    /* 🔔 SMART INPUT SHAKING ANIMATION EFFECT (আপনার নিজস্ব সিঙ্ক) */
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
    // 📸 আল্ট্রা-স্মার্ট রিয়েল-টাইম লাইভ ইমেজ প্রিভিউ ইঞ্জিন (অ্যাড ও এডিট উভয়ের জন্য ফিক্সড)
    function readLiveImagePreview(input, previewId, fallbackId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(previewId).attr('src', e.target.result).removeClass('d-none');
                $(fallbackId).addClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ইমেজ ইনপুট ট্র্যাকার লিসেনার সক্রিয় করা হলো ভাই
    $(document).on('change', '#add_pic_input', function() {
        readLiveImagePreview(this, '#add_pic_preview', '#add_pic_fallback');
    });
    $(document).on('change', '#edit_pic_input', function() {
        readLiveImagePreview(this, '#edit_pic_preview', '#edit_pic_fallback');
    });

    $(document).ready(function() {
        // ১. বিল্ট-ইন সার্চ ও শর্টিং ডাটাটেবল কনফিগারেশন (আপনার মূল ব্লুপ্রিন্ট সিঙ্ক)
        var table = $('#memberHubTable').DataTable({
            "destroy": true, 
            "responsive": true, 
            "autoWidth": false, 
            "ordering": true, // কলামের শর্টিং ইঞ্জিন সক্রিয়
            "pageLength": 10,
            "dom": '<"row p-2"<"col-md-6"l><"col-md-6 text-right"f>>rt<"row p-2"<"col-md-5"i><"col-md-7"p>>',
            "language": { 
                "search": "Search:", 
                "searchPlaceholder": "Search membership directory..." 
            }
        });

        // আপনার নিজস্ব সিরিয়াল নম্বর ইঞ্জিন স্বয়ংক্রিয় সিঙ্ক
        table.on('order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // মডাল ওপেন হওয়ার সাথে সাথে ডিরেক্ট টাইপিং অটো-ফোকাস এবং প্রিভিউ রিসেট
        $('#addMemberModal').on('shown.bs.modal', function () {
            $('#add_name_field').focus();
            $('#add_pic_preview').addClass('d-none').attr('src', '');
            $('#add_pic_fallback').removeClass('d-none');
        });

        // ডাইনামিক এডিট মডাল ডাটা, ড্রপডাউন এবং টপ-সেন্টার ইমেজ প্রিভিউ বাইন্ডিং
        $(document).on('click', '.btn-edit-trigger', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let category = $(this).data('category');
            let hospital = $(this).data('hospital');
            let medical = $(this).data('medical');
            let bacta = $(this).data('bacta');
            let sort = $(this).data('sort');
            let pic = $(this).data('pic');

            // আপনার নতুন রাউট 'admin.members.update' এর সাথে পারফেক্টলি ম্যাপ করা হলো
            let actionUrl = "{{ route('admin.members.update', ':id') }}"; 
            actionUrl = actionUrl.replace(':id', id);
            $('#editMemberForm').attr('action', actionUrl);

            // ইনপুট এবং মাস্টার ড্রপডাউনগুলোর ভ্যালু অটো-সিঙ্ক
            $('#edit_name').val(name);
            $('#edit_category').val(category);
            $('#edit_hospital').val(hospital);
            $('#edit_medical').val(medical);
            $('#edit_bacta').val(bacta);
            $('#edit_sort').val(sort);

            // এডিটের জন্য ডাইনামিক টপ-সেন্টার ইমেজ প্রিভিউ কন্ট্রোল ভাই
            if (pic) {
                $('#edit_pic_preview').attr('src', pic).removeClass('d-none');
                $('#edit_pic_fallback').addClass('d-none');
            } else {
                $('#edit_pic_preview').addClass('d-none');
                $('#edit_pic_fallback').removeClass('d-none');
            }

            $('#edit-modal-alert').addClass('d-none');
            $('#edit_name').removeClass('is-invalid');
        });

        // ডাইনামিক ডিলিট মডাল সিকিউর ফর্ম লিংক বাইন্ডিং (সফট আর্কাইভ)
        $(document).on('click', '.btn-delete-trigger', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            let deleteUrl = "{{ route('admin.members.delete', ':id') }}";
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

    // ২. 💡 আল্ট্রা-স্মার্ট অ্যাড ভ্যালিডেশন এবং নেটিভ সাবমিশন ইঞ্জিন (BACTA থিম)
    function submitBactaAddForm() {
        let inputName = $('#add_name_field').val().trim();
        
        if (inputName === '') {
            $('#add-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>ডাক্তারের নাম (Doctor Full Name)</b> টাইপ করুন, তারপর নিচে কনফর্ম বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            $('#add_name_field').addClass('is-invalid').focus();
            
            // ইনপুট বক্সে হালকা ঝাঁকুনি অ্যানিমেশন (আপনার শেকিং ইফেক্ট)
            $('.bct-input-name').addClass('shake-effect');
            setTimeout(function() { $('.bct-input-name').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        $('#addSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Registering doctor...');
        document.getElementById('addForm').submit();
    }

    // ৩. 💡 আল্ট্রা-স্মার্ট এডিট ভ্যালিডেশন এবং নেটিভ সাবমিশন ইঞ্জিন (BACTA থিম)
    function submitBactaEditForm() {
        let inputName = $('#edit_name').val().trim();
        
        if (inputName === '') {
            $('#edit-modal-alert').removeClass('d-none').html(
                '<div class="d-flex align-items-center">' +
                '<i class="fas fa-hand-point-right text-warning mr-2 animate__animated animate__flash animate__infinite" style="font-size: 16px; margin-right: 8px;"></i> ' +
                '<span>দয়া করে প্রথমে <b>ডাক্তারের নাম</b> টাইপ করুন, তারপর আপডেট বাটনে প্রেস করুন।</span>' +
                '</div>'
            );
            $('#edit_name').addClass('is-invalid').focus();
            
            $('.bct-edit-input-wrapper').addClass('shake-effect');
            setTimeout(function() { $('.bct-edit-input-wrapper').removeClass('shake-effect'); }, 500);
            return false;
        }
        
        $('#editSaveBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating changes...');
        document.getElementById('editMemberForm').submit();
    }
</script>
@stop
