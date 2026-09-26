<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Homepage Popup | BACTA Admin')

@section('content')
<style>
    .popup-admin-wrapper {
        font-family: 'Poppins', sans-serif;
        padding: 10px 5px;
        background-color: #F8FAFC;
        width: 100%;
        box-sizing: border-box;
    }
    .popup-split-layout {
        display: flex;
        gap: 25px;
        align-items: flex-start;
        width: 100%;
    }
    .popup-column-left { width: 36%; flex-shrink: 0; }
    .popup-column-right { width: 64%; flex-grow: 1; }
    .popup-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.03);
        padding: 24px;
        box-sizing: border-box;
    }
    .popup-card-header {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 12px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }
    .popup-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }
    .popup-control {
        width: 100%;
        height: 40px;
        background: #ffffff;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 0 12px;
        font-size: 13px;
        color: #0F172A;
        outline: none;
        box-sizing: border-box;
    }
    .popup-control:focus { border-color: #0284C7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    .btn-popup-submit {
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff;
        font-weight: 600; padding: 10px 20px; border-radius: 8px; font-size: 12.5px;
        border: none; cursor: pointer; width: 100%; height: 42px;
    }
    .popup-thumb {
        width: 56px; height: 56px; object-fit: cover; border-radius: 8px; border: 1px solid #E2E8F0;
    }
    .popup-badge-active {
        background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 3px 9px; border-radius: 12px;
        font-size: 10px; font-weight: 700; text-transform: uppercase;
    }
    .popup-badge-inactive {
        background: rgba(148, 163, 184, 0.15); color: #64748B; padding: 3px 9px; border-radius: 12px;
        font-size: 10px; font-weight: 700; text-transform: uppercase;
    }
    .btn-popup-action {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 6px; border: 1px solid #CBD5E1;
        background: #F1F5F9; color: #475569; cursor: pointer;
    }
    @media (max-width: 1024px) {
        .popup-split-layout { flex-direction: column; }
        .popup-column-left, .popup-column-right { width: 100%; }
    }
</style>

<div class="popup-admin-wrapper">
    @if(session('success'))
        <div style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #ffffff; padding: 14px 18px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 13.5px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="popup-split-layout">
        <div class="popup-column-left">
            <div class="popup-card">
                <div class="popup-card-header"><i class="fas fa-window-restore text-[#0284C7] mr-1"></i> Upload New Popup</div>

                <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom: 18px;">
                        <label class="popup-label">Title (internal reference only, optional)</label>
                        <input type="text" name="title" class="popup-control" placeholder="e.g., Conference 2026 Announcement">
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label class="popup-label">Click-through Link (optional)</label>
                        <input type="url" name="link_url" class="popup-control" placeholder="https://...">
                    </div>

                    <div style="margin-bottom: 22px;">
                        <label class="popup-label">Popup Image (jpg, jpeg, png, webp — max 4MB)</label>
                        <input type="file" name="image" required class="popup-control" style="padding-top: 8px;" accept=".jpg,.jpeg,.png,.webp">
                    </div>

                    <button type="submit" class="btn-popup-submit">
                        <i class="fas fa-upload"></i> Upload &amp; Set Active
                    </button>
                    <p style="font-size: 11px; color: #94A3B8; margin-top: 10px;">
                        Uploading a new image automatically deactivates the currently active popup.
                    </p>
                </form>
            </div>
        </div>

        <div class="popup-column-right">
            <div class="popup-card" style="padding: 0; overflow: hidden;">
                <div class="popup-card-header" style="padding: 20px 24px; margin-bottom: 0;">
                    <i class="fas fa-history"></i> Popup History
                </div>
                <div style="overflow-x: auto; width: 100%;">
                    <table style="width: 100%; min-width: 650px; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                        <thead>
                            <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px;">
                                <th style="padding: 14px 20px;">Preview</th>
                                <th style="padding: 14px 20px;">Title</th>
                                <th style="padding: 14px 20px; text-align: center;">Status</th>
                                <th style="padding: 14px 20px;">Uploaded By</th>
                                <th style="padding: 14px 20px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155; font-weight: 500;">
                            @forelse($popups as $popup)
                            <tr style="border-bottom: 1px solid #E2E8F0;">
                                <td style="padding: 10px 20px;">
                                    <img src="{{ asset($popup->image) }}" class="popup-thumb" alt="popup preview">
                                </td>
                                <td style="padding: 14px 20px; font-weight: 700; color: #0F172A;">
                                    {{ $popup->title ?: '(no title)' }}
                                    @if($popup->link_url)
                                        <div style="font-size: 10.5px; font-weight: 500; color: #0284C7;">
                                            <i class="fas fa-link"></i> {{ Str::limit($popup->link_url, 40) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    @if($popup->is_active)
                                        <span class="popup-badge-active">Active</span>
                                    @else
                                        <span class="popup-badge-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; font-size: 11.5px;">
                                    <span style="font-weight: 600; color: #0F172A;">{{ $popup->creator->name ?? 'Admin' }}</span>
                                    <div style="font-size: 10px; color: #94A3B8; margin-top: 2px;">{{ $popup->created_at->format('d M, h:i A') }}</div>
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    <div style="display: flex; gap: 6px; justify-content: center;">
                                        @if(!$popup->is_active)
                                            <form action="{{ route('admin.popups.activate', $popup->id) }}" method="POST" style="display:inline-block;margin:0;">
                                                @csrf
                                                <button type="submit" class="btn-popup-action" title="Set Active">
                                                    <i class="fas fa-toggle-on" style="color:#10B981;"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.popups.deactivate', $popup->id) }}" method="POST" style="display:inline-block;margin:0;">
                                                @csrf
                                                <button type="submit" class="btn-popup-action" title="Deactivate">
                                                    <i class="fas fa-toggle-off"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.popups.delete', $popup->id) }}" method="POST" onsubmit="return confirm('Delete this popup banner?');" style="display:inline-block;margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-popup-action" title="Delete">
                                                <i class="fas fa-trash-alt" style="color:#EF4444;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600;">
                                    <i class="fas fa-folder-open" style="font-size: 26px; display: block; margin-bottom: 8px;"></i>
                                    No popup banners uploaded yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
