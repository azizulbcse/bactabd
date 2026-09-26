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
        transition: all 0.2s ease;
    }
    .popup-control:focus { border-color: #0284C7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    @keyframes popupShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }
    .popup-input-error-shake {
        animation: popupShake 0.4s ease-in-out;
        border-color: #EF4444 !important;
        background-color: #FEF2F2 !important;
    }
    .popup-error-msg {
        display: none; color: #EF4444; font-size: 11.5px; font-weight: 600;
        margin-top: 6px; align-items: center; gap: 5px;
    }
    .btn-popup-submit {
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff;
        font-weight: 600; padding: 10px 20px; border-radius: 8px; font-size: 12.5px;
        border: none; cursor: pointer; width: 100%; height: 42px; transition: all 0.2s ease;
    }
    .btn-popup-submit:hover { opacity: 0.95; transform: translateY(-1px); }
    .popup-dropzone {
        border: 2px dashed #CBD5E1; border-radius: 10px; padding: 16px; text-align: center;
        cursor: pointer; transition: all 0.2s ease; background: #F8FAFC;
    }
    .popup-dropzone:hover, .popup-dropzone.has-file { border-color: #0284C7; background: #EFF6FF; }
    .popup-dropzone-preview {
        width: 100%; max-height: 140px; object-fit: contain; border-radius: 8px; margin-bottom: 10px; display: none;
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
        background: #F1F5F9; color: #475569; cursor: pointer; transition: all 0.2s ease;
    }
    .btn-popup-action:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
    @media (max-width: 1024px) {
        .popup-split-layout { flex-direction: column; }
        .popup-column-left, .popup-column-right { width: 100%; }
    }
</style>

<div class="popup-admin-wrapper">
    <div class="popup-split-layout">
        <div class="popup-column-left">
            <div class="popup-card">
                <div class="popup-card-header" style="display:flex; align-items:center; justify-content:space-between;">
                    <span id="popupFormTitleText"><i class="fas fa-window-restore text-[#0284C7] mr-1"></i> Upload New Popup</span>
                    <span id="popupFormModeBadge" style="font-size: 10px; background: #EFF6FF; color: #1E40AF; padding: 3px 8px; border-radius: 4px; font-weight: 700; text-transform: none; letter-spacing: 0;">CREATE MODE</span>
                </div>

                <form id="popupUploadForm" action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data" data-mode="create" novalidate>
                    @csrf
                    <div style="margin-bottom: 18px;">
                        <label class="popup-label"><i class="fas fa-heading text-slate-400 mr-1"></i> Title (internal reference only, optional)</label>
                        <input type="text" name="title" id="popupTitleInput" value="{{ old('title') }}" class="popup-control" placeholder="e.g., Conference 2026 Announcement">
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label class="popup-label"><i class="fas fa-link text-slate-400 mr-1"></i> Click-through Link (optional)</label>
                        <input type="url" name="link_url" id="popupLinkInput" value="{{ old('link_url') }}" class="popup-control" placeholder="https://...">
                    </div>

                    <div style="margin-bottom: 22px;">
                        <label class="popup-label"><i class="fas fa-image text-slate-400 mr-1"></i> Popup Image (jpg, jpeg, png, webp — max 4MB)</label>
                        <div class="popup-dropzone" id="popupDropzone" onclick="document.getElementById('popupImageInput').click();">
                            <img id="popupImagePreview" class="popup-dropzone-preview" alt="preview">
                            <div id="popupDropzoneText">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 22px; color: #94A3B8;"></i>
                                <div style="font-size: 12px; font-weight: 600; color: #475569; margin-top: 6px;">Click to choose an image</div>
                                <div style="font-size: 10.5px; color: #94A3B8; margin-top: 2px;">or drag and drop it here</div>
                            </div>
                            <div id="popupFileName" style="font-size: 11.5px; font-weight: 600; color: #0284C7; margin-top: 8px; display: none;"></div>
                        </div>
                        <input type="file" name="image" id="popupImageInput" style="display:none;" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        <div id="popupImageError" class="popup-error-msg">
                            <i class="fas fa-exclamation-triangle"></i> <span>Please choose an image to upload (JPG, PNG or WEBP, max 4MB).</span>
                        </div>
                        <div id="popupImageOptionalNote" style="display:none; font-size: 11px; color: #94A3B8; margin-top: 6px;">
                            <i class="fas fa-circle-info"></i> Leave empty to keep the current image.
                        </div>
                    </div>

                    <div id="popupFormButtons" style="display:flex; flex-direction:column; gap:10px;">
                        <button type="button" onclick="validateAndSubmitPopup()" class="btn-popup-submit">
                            <i class="fas fa-upload"></i> Upload &amp; Set Active
                        </button>
                    </div>
                    <p id="popupFormHint" style="font-size: 11px; color: #94A3B8; margin-top: 10px;">
                        <i class="fas fa-circle-info"></i> Uploading a new image automatically deactivates the currently active popup.
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
                                        <span class="popup-badge-active"><i class="fas fa-circle-check"></i> Active</span>
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
                                            <form id="popup-activate-form-{{ $popup->id }}" action="{{ route('admin.popups.activate', $popup->id) }}" method="POST" style="display:inline-block;margin:0;">
                                                @csrf
                                                <button type="button" onclick="confirmPopupAction('popup-activate-form-{{ $popup->id }}', 'Set this popup as active?', 'It will replace the currently active popup on the homepage.', 'success', '#10B981', 'Yes, activate it')" class="btn-popup-action" title="Set Active">
                                                    <i class="fas fa-toggle-on" style="color:#10B981;"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form id="popup-deactivate-form-{{ $popup->id }}" action="{{ route('admin.popups.deactivate', $popup->id) }}" method="POST" style="display:inline-block;margin:0;">
                                                @csrf
                                                <button type="button" onclick="confirmPopupAction('popup-deactivate-form-{{ $popup->id }}', 'Deactivate this popup?', 'It will stop showing on the homepage immediately.', 'question', '#64748B', 'Yes, deactivate')" class="btn-popup-action" title="Deactivate">
                                                    <i class="fas fa-toggle-off"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <button type="button" onclick="switchPopupToEditMode({{ $popup->id }}, @js($popup->title), @js($popup->link_url), @js(asset($popup->image)))" class="btn-popup-action" title="Edit">
                                            <i class="fas fa-edit" style="color:#0284C7;"></i>
                                        </button>
                                        <form id="popup-delete-form-{{ $popup->id }}" action="{{ route('admin.popups.delete', $popup->id) }}" method="POST" style="display:inline-block;margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmPopupAction('popup-delete-form-{{ $popup->id }}', 'Delete this popup banner?', 'This cannot be undone from the homepage. The record can still be recovered from backups if needed.', 'warning', '#EF4444', 'Yes, delete it')" class="btn-popup-action" title="Delete">
                                                <i class="fas fa-trash-alt" style="color:#EF4444;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600;">
                                    <i class="fas fa-image" style="font-size: 26px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
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

<script>
    // Live preview + drag-drop for the popup image dropzone
    (function () {
        var input = document.getElementById('popupImageInput');
        var dropzone = document.getElementById('popupDropzone');
        var preview = document.getElementById('popupImagePreview');
        var dzText = document.getElementById('popupDropzoneText');
        var fileNameNode = document.getElementById('popupFileName');
        var errorNode = document.getElementById('popupImageError');

        function showFile(file) {
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                dzText.querySelector('div').textContent = 'Looks good — click to change';
            };
            reader.readAsDataURL(file);
            fileNameNode.textContent = file.name;
            fileNameNode.style.display = 'block';
            dropzone.classList.add('has-file');
            errorNode.style.display = 'none';
            input.classList.remove('popup-input-error-shake');
        }

        input.addEventListener('change', function () {
            if (input.files && input.files[0]) showFile(input.files[0]);
        });

        dropzone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropzone.style.borderColor = '#0284C7';
        });
        dropzone.addEventListener('dragleave', function () {
            dropzone.style.borderColor = '';
        });
        dropzone.addEventListener('drop', function (e) {
            e.preventDefault();
            dropzone.style.borderColor = '';
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                input.files = e.dataTransfer.files;
                showFile(e.dataTransfer.files[0]);
            }
        });
    })();

    function validateAndSubmitPopup() {
        var input = document.getElementById('popupImageInput');
        var dropzone = document.getElementById('popupDropzone');
        var errorNode = document.getElementById('popupImageError');
        var form = document.getElementById('popupUploadForm');

        // In edit mode an image is optional - the existing one is kept if none is chosen.
        if (form.dataset.mode !== 'edit' && (!input.files || !input.files[0])) {
            errorNode.style.display = 'flex';
            dropzone.classList.add('popup-input-error-shake');
            setTimeout(function () { dropzone.classList.remove('popup-input-error-shake'); }, 420);
            return;
        }

        errorNode.style.display = 'none';
        form.submit();
    }

    function switchPopupToEditMode(id, title, linkUrl, imageUrl) {
        var form = document.getElementById('popupUploadForm');
        var titleInput = document.getElementById('popupTitleInput');
        var linkInput = document.getElementById('popupLinkInput');
        var preview = document.getElementById('popupImagePreview');
        var dzText = document.getElementById('popupDropzoneText');
        var fileNameNode = document.getElementById('popupFileName');
        var dropzone = document.getElementById('popupDropzone');
        var formTitleText = document.getElementById('popupFormTitleText');
        var formModeBadge = document.getElementById('popupFormModeBadge');
        var buttonsGroup = document.getElementById('popupFormButtons');
        var optionalNote = document.getElementById('popupImageOptionalNote');
        var errorNode = document.getElementById('popupImageError');

        document.getElementById('popupImageInput').value = '';
        errorNode.style.display = 'none';

        titleInput.value = title || '';
        linkInput.value = linkUrl || '';
        titleInput.focus();

        preview.src = imageUrl;
        preview.style.display = 'block';
        dzText.querySelector('div').textContent = 'Current image — click to replace';
        fileNameNode.style.display = 'none';
        dropzone.classList.add('has-file');
        optionalNote.style.display = 'block';

        form.action = '/admin/popup-banners/' + id + '/update';
        form.dataset.mode = 'edit';

        formTitleText.innerHTML = '<i class="fas fa-edit text-[#1D4ED8] mr-1"></i> Edit Popup';
        formModeBadge.textContent = 'EDIT MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1D4ED8';

        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitPopup()" class="btn-popup-submit">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <button type="button" onclick="cancelPopupEditMode()" class="btn-popup-submit" style="background:#F1F5F9; color:#475569;">
                <i class="fas fa-times"></i> Cancel
            </button>
        `;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function cancelPopupEditMode() {
        var form = document.getElementById('popupUploadForm');
        var preview = document.getElementById('popupImagePreview');
        var dzText = document.getElementById('popupDropzoneText');
        var fileNameNode = document.getElementById('popupFileName');
        var dropzone = document.getElementById('popupDropzone');
        var formTitleText = document.getElementById('popupFormTitleText');
        var formModeBadge = document.getElementById('popupFormModeBadge');
        var buttonsGroup = document.getElementById('popupFormButtons');
        var optionalNote = document.getElementById('popupImageOptionalNote');

        form.reset();
        form.action = "{{ route('admin.popups.store') }}";
        form.dataset.mode = 'create';

        preview.style.display = 'none';
        dzText.querySelector('div').textContent = 'Click to choose an image';
        fileNameNode.style.display = 'none';
        dropzone.classList.remove('has-file');
        optionalNote.style.display = 'none';

        formTitleText.innerHTML = '<i class="fas fa-window-restore text-[#0284C7] mr-1"></i> Upload New Popup';
        formModeBadge.textContent = 'CREATE MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1E40AF';

        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitPopup()" class="btn-popup-submit">
                <i class="fas fa-upload"></i> Upload &amp; Set Active
            </button>
        `;
    }

    // Smart SweetAlert2 confirmation used for activate / deactivate / delete
    // Note: this project pins SweetAlert2 v8, which uses `type` instead of `icon`.
    function confirmPopupAction(formId, title, text, type, confirmColor, confirmText) {
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
            // SweetAlert2 v8 resolves confirmation as {value: true}, not {isConfirmed: true}
            // (isConfirmed was only added in v9+) - check both so this survives a future upgrade.
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
                timer: 3000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                type: 'error',
                title: 'Please check the form',
                html: @json(implode('<br>', $errors->all())),
                confirmButtonColor: '#0284C7'
            });
        @endif
    });
</script>
@endsection
