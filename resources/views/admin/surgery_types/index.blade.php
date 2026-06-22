<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Surgery Types Configuration | BACTA')

@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <div style="font-family: 'Poppins', sans-serif; padding: 5px 5px 0;">
        <h1 style="color: #0F172A; font-weight: 800; font-size: 24px; margin: 0;">
            <i class="fa-solid fa-sliders text-[#0284C7] mr-1"></i> Surgery Types Configuration
        </h1>
        <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0; font-weight: 600;">Manage dynamic column designations for annual cardiac surgery statistics.</p>
    </div>
@stop

@section('content')
<div style="font-family: 'Poppins', sans-serif; padding-bottom: 40px;">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <!-- 🚀 AdminLTE প্রিমিয়াম কার্ড উইন্ডো ফ্রেম ভাই -->
    <div class="card card-outline card-primary shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-white py-3 flex justify-between items-center" style="border-bottom: 1px solid #F1F5F9;">
            <h3 class="card-title" style="font-size: 15px; font-weight: 700; color: #1E293B; margin: 0; padding-top: 6px;">
                <i class="fa-solid fa-table-list text-primary mr-1"></i> Active Designation Columns
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createSurgeryTypeModal" style="background-color: #0284C7; border-color: #0284C7; font-weight: 700; font-size: 12px; border-radius: 6px; padding: 6px 14px;">
                    <i class="fa-solid fa-plus-circle mr-1"></i> Add New Column
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <!-- 🎯 ওফিসিয়াল 'example1' বা 'datatable' আইডি ব্যবহার করায় AdminLTE এর নিজস্ব সার্চ বার ও পেজিনেশন অটো অন হবে ভাই -->
            <table id="example1" class="table table-bordered table-striped table-hover vertical-align-middle" style="font-size: 13.5px;">
                <thead style="color: #475569; font-weight: 700;">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Designation Column Name</th>
                        <th style="width: 150px; text-align: center;">Sort Order</th>
                        <th style="width: 180px; text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody style="color: #334155; font-weight: 500;">
                    @foreach($surgeryTypes as $type)
                        <tr>
                            <td style="font-weight: 700; color: #64748B;">#{{ $type->id }}</td>
                            <td style="font-weight: 700; color: #0F172A;">
                                <i class="fa-solid fa-notes-medical text-primary mr-1.5" style="font-size: 12px;"></i> {{ $type->name }}
                            </td>
                            <td class="text-center">
                                <span class="badge badge-secondary" style="background-color: #64748B; font-weight: 700; padding: 5px 10px; border-radius: 4px;">
                                    <i class="fa-solid fa-arrow-down-1-9 mr-1" style="font-size: 10px;"></i> {{ $type->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-xs edit-surgery-type-btn" 
                                            data-id="{{ $type->id }}" 
                                            data-name="{{ $type->name }}" 
                                            data-sort="{{ $type->sort_order }}"
                                            style="background-color: #F59E0B; border-color: #F59E0B; color: #ffffff; font-weight: 700; border-radius: 4px; padding: 4px 10px; margin-right: 5px;">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('admin.surgery_types.delete', $type->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to revoke this column?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" style="background-color: #EF4444; border-color: #EF4444; font-weight: 700; border-radius: 4px; padding: 4px 10px;">
                                            <i class="fa-solid fa-trash-can mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ==========================================
     🔒 মডাল ১: Add New Column Modal (নতুন কলাম রেজিস্ট্রি উইন্ডো)
     ========================================== -->
<div class="modal fade" id="createSurgeryTypeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div class="modal-header bg-white py-3" style="border-bottom: 1px solid #EFF6FF;">
                <h5 class="modal-title" id="createModalLabel" style="font-size: 15px; font-weight: 800; color: #0F172A;"><i class="fa-solid fa-square-plus text-[#0284C7] mr-1"></i> Register New Column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.surgery_types.store') }}" method="POST">
                @csrf
                <div class="modal-body py-4" style="background-color: #F8FAFC;">
                    <div class="form-group mb-3">
                        <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Column Designation Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. CABG, AVR, MVR, VSD" required style="border-radius: 6px; padding: 10px; font-size: 13px;">
                    </div>
                    <div class="form-group mb-0">
                        <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Sort Order Grid Number</label>
                        <input type="number" name="sort_order" class="form-control form-control-sm" value="0" min="0" style="border-radius: 6px; padding: 10px; font-size: 13px;">
                        <small class="text-muted" style="font-size: 11px; font-weight: 500; margin-top: 4px; display: block;"><i class="fa-solid fa-circle-info mr-1"></i> Defines horizontal sequence order on frontend database sheet grid.</small>
                    </div>
                </div>
                <div class="modal-footer bg-white py-2.5" style="border-top: 1px solid #F1F5F9;">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-weight: 700; font-size: 12px; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #0284C7; border-color: #0284C7; font-weight: 700; font-size: 12px; border-radius: 6px; padding: 6px 16px;">Save Column</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ==========================================
     🔒 মডাল ২: Edit Column Configuration Modal (ডাইনামিক এডিট উইন্ডো)
     ========================================== -->
<div class="modal fade" id="editSurgeryTypeModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div class="modal-header bg-white py-3" style="border-bottom: 1px solid #FFFBEB;">
                <h5 class="modal-title" id="editModalLabel" style="font-size: 15px; font-weight: 800; color: #0F172A;"><i class="fa-solid fa-pen-to-square text-amber-500 mr-1"></i> Edit Designation Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="editSurgeryTypeForm" method="POST">
                @csrf
                <div class="modal-body py-4" style="background-color: #F8FAFC;">
                    <div class="form-group mb-3">
                        <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Column Designation Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_type_name" class="form-control form-control-sm" required style="border-radius: 6px; padding: 10px; font-size: 13px;">
                    </div>
                    <div class="form-group mb-0">
                        <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Sort Order Grid Number <span class="text-danger">*</span></label>
                        <input type="number" name="sort_order" id="edit_type_sort" class="form-control form-control-sm" min="0" required style="border-radius: 6px; padding: 10px; font-size: 13px;">
                    </div>
                </div>
                <div class="modal-footer bg-white py-2.5" style="border-top: 1px solid #F1F5F9;">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-weight: 700; font-size: 12px; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm" style="background-color: #F59E0B; border-color: #F59E0B; color: #ffffff; font-weight: 700; font-size: 12px; border-radius: 6px; padding: 6px 16px;">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $(function () {
        // 🎯 AdminLTE বিল্ট-ইন জাদুকরী ডাটা টেবিল প্লাগইন এক ক্লিকে একটিভেট করার ওয়ান-লাইন নোড ভাই
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "searching": true, // 🔍 বিল্ট-ইন গ্লোবাল লাইভ সার্চ বার অন হলো ভাই
            "paging": true, // 📄 বিল্ট-ইন ডাইনামিক পেজিনেশন অন হলো ভাই
            "ordering": true, // 📊 কলাম সর্টিং ট্র্যাকার অন হলো ভাই
            "info": true
        });

        // ওয়ান-ক্লিক এডিট ডাটা পপুলেট ড্রাইভার মেকানিজম ভাই
        $('.edit-surgery-type-btn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const sort = $(this).data('sort');

            $('#editSurgeryTypeForm').attr('action', `{{ url('admin/surgery-types-config/update') }}/${id}`);
            $('#edit_type_name').val(name);
            $('#edit_type_sort').val(sort);

            $('#editSurgeryTypeModal').modal('show');
        });
    });
</script>
@stop
