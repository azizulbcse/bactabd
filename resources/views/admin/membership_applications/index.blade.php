<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Membership Applications | BACTA Admin')

@section('content')
<style>
    .ma-wrapper { font-family: 'Poppins', sans-serif; padding: 10px 5px; background-color: #F8FAFC; width: 100%; box-sizing: border-box; }
    .ma-card { background: #ffffff; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(148, 163, 184, 0.03); overflow: hidden; }
    .ma-card-header { font-size: 15px; font-weight: 700; color: #0F172A; padding: 20px 24px; border-bottom: 1px solid #E2E8F0; text-transform: uppercase; letter-spacing: 0.25px; }
    .ma-badge-pending { background: rgba(234, 179, 8, 0.12); color: #A16207; padding: 3px 9px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
    .ma-badge-approved { background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 3px 9px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
    .ma-badge-rejected { background: rgba(239, 68, 68, 0.1); color: #EF4444; padding: 3px 9px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; }
    .btn-ma-action { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: 6px; border: 1px solid #CBD5E1; background: #F1F5F9; color: #475569; cursor: pointer; transition: all 0.2s ease; }
    .btn-ma-action:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
</style>

<div class="ma-wrapper">
    <div class="ma-card">
        <div class="ma-card-header"><i class="fas fa-user-plus text-[#0284C7] mr-1"></i> Membership Applications</div>
        <div style="overflow-x: auto; width: 100%;">
            <table style="width: 100%; min-width: 800px; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px;">
                        <th style="padding: 14px 20px;">Applicant</th>
                        <th style="padding: 14px 20px;">Contact</th>
                        <th style="padding: 14px 20px;">Designation / Type</th>
                        <th style="padding: 14px 20px; text-align: center;">Status</th>
                        <th style="padding: 14px 20px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody style="color: #334155; font-weight: 500;">
                    @forelse($applications as $app)
                    <tr style="border-bottom: 1px solid #E2E8F0;">
                        <td style="padding: 14px 20px;">
                            <div style="font-weight: 700; color: #0F172A;">{{ $app->name }}</div>
                            <div style="font-size: 10.5px; color: #94A3B8; margin-top: 2px;">BMDC: {{ $app->bmdc_reg_no ?: '—' }}</div>
                            @if($app->message)
                                <div style="font-size: 11px; color: #64748B; margin-top: 4px; max-width: 260px;">{{ Str::limit($app->message, 80) }}</div>
                            @endif
                        </td>
                        <td style="padding: 14px 20px; font-size: 11.5px;">
                            <div><i class="fas fa-envelope text-slate-400 mr-1"></i> {{ $app->email }}</div>
                            <div style="margin-top: 2px;"><i class="fas fa-phone text-slate-400 mr-1"></i> {{ $app->mobile_no }}</div>
                        </td>
                        <td style="padding: 14px 20px; font-size: 11.5px;">
                            <div>{{ $app->designation ?: '—' }}</div>
                            <div style="font-size: 10.5px; color: #94A3B8; margin-top: 2px;">{{ $app->member_type ?: '—' }}</div>
                        </td>
                        <td style="padding: 14px 20px; text-align: center;">
                            @if($app->status == 2)
                                <span class="ma-badge-approved"><i class="fas fa-circle-check"></i> Approved</span>
                            @elseif($app->status == 3)
                                <span class="ma-badge-rejected"><i class="fas fa-circle-xmark"></i> Rejected</span>
                            @else
                                <span class="ma-badge-pending"><i class="fas fa-clock"></i> Pending</span>
                            @endif
                            <div style="font-size: 10px; color: #94A3B8; margin-top: 4px;">{{ $app->created_at->format('d M, Y') }}</div>
                        </td>
                        <td style="padding: 14px 20px; text-align: center;">
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                @if($app->status == 1)
                                    <form id="ma-approve-form-{{ $app->id }}" action="{{ route('admin.membership_applications.approve', $app->id) }}" method="POST" style="display:inline-block;margin:0;">
                                        @csrf
                                        <button type="button" onclick="confirmMaAction('ma-approve-form-{{ $app->id }}', 'Approve this application?', 'You can then create a login account for them from Admin & Staff Directory.', 'success', '#10B981', 'Yes, approve')" class="btn-ma-action" title="Approve">
                                            <i class="fas fa-check" style="color:#10B981;"></i>
                                        </button>
                                    </form>
                                    <form id="ma-reject-form-{{ $app->id }}" action="{{ route('admin.membership_applications.reject', $app->id) }}" method="POST" style="display:inline-block;margin:0;">
                                        @csrf
                                        <button type="button" onclick="confirmMaAction('ma-reject-form-{{ $app->id }}', 'Reject this application?', 'The applicant will not be marked as a member.', 'question', '#EF4444', 'Yes, reject')" class="btn-ma-action" title="Reject">
                                            <i class="fas fa-times" style="color:#EF4444;"></i>
                                        </button>
                                    </form>
                                @endif
                                <form id="ma-delete-form-{{ $app->id }}" action="{{ route('admin.membership_applications.delete', $app->id) }}" method="POST" style="display:inline-block;margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmMaAction('ma-delete-form-{{ $app->id }}', 'Delete this application?', 'It can still be recovered from backups if needed.', 'warning', '#EF4444', 'Yes, delete it')" class="btn-ma-action" title="Delete">
                                        <i class="fas fa-trash-alt" style="color:#EF4444;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600;">
                            <i class="fas fa-user-plus" style="font-size: 26px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                            No membership applications yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmMaAction(formId, title, text, type, confirmColor, confirmText) {
        if (typeof Swal === 'undefined') {
            if (confirm(title)) document.getElementById(formId).submit();
            return;
        }
        Swal.fire({
            title: title,
            text: text,
            type: type,
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#94A3B8',
            confirmButtonText: confirmText,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then(function (result) {
            if (result && (result.value || result.isConfirmed)) {
                document.getElementById(formId).submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swal === 'undefined') return;

        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                type: 'success',
                title: @json(session('success')),
                showConfirmButton: false,
                timer: 3500
            });
        @endif
    });
</script>
@endsection
