<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Clinical Guidelines | BACTA Admin')

@section('content')
<style>
    .cg-admin-wrapper {
        font-family: 'Poppins', sans-serif;
        padding: 10px 5px;
        background-color: #F8FAFC;
        width: 100%;
        box-sizing: border-box;
    }
    .cg-split-layout {
        display: flex;
        gap: 25px;
        align-items: flex-start;
        width: 100%;
    }
    .cg-column-left { width: 38%; flex-shrink: 0; }
    .cg-column-right { width: 62%; flex-grow: 1; }
    .cg-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.03);
        padding: 24px;
        box-sizing: border-box;
    }
    .cg-card-header {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 12px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }
    .cg-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }
    .cg-control {
        width: 100%;
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
    input.cg-control { height: 40px; }
    textarea.cg-control { padding: 10px 12px; resize: vertical; min-height: 90px; font-family: inherit; }
    .cg-control:focus { border-color: #0284C7; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    @keyframes cgShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }
    .cg-input-error-shake {
        animation: cgShake 0.4s ease-in-out;
        border-color: #EF4444 !important;
        background-color: #FEF2F2 !important;
    }
    .cg-error-msg {
        display: none; color: #EF4444; font-size: 11.5px; font-weight: 600;
        margin-top: 6px; align-items: center; gap: 5px;
    }
    .btn-cg-publish {
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff;
        font-weight: 600; padding: 10px 16px; border-radius: 8px; font-size: 12.5px;
        border: none; cursor: pointer; width: 100%; height: 42px; transition: all 0.2s ease;
    }
    .btn-cg-publish:hover { opacity: 0.95; transform: translateY(-1px); }
    .btn-cg-draft {
        background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;
        font-weight: 600; padding: 10px 16px; border-radius: 8px; font-size: 12.5px;
        cursor: pointer; width: 100%; height: 42px;
    }
    .cg-dropzone {
        border: 2px dashed #CBD5E1; border-radius: 10px; padding: 14px; text-align: center;
        cursor: pointer; transition: all 0.2s ease; background: #F8FAFC;
    }
    .cg-dropzone:hover, .cg-dropzone.has-file { border-color: #0284C7; background: #EFF6FF; }
    .cg-badge-live {
        background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 3px 9px; border-radius: 12px;
        font-size: 10px; font-weight: 700; text-transform: uppercase;
    }
    .cg-badge-draft {
        background: rgba(148, 163, 184, 0.15); color: #64748B; padding: 3px 9px; border-radius: 12px;
        font-size: 10px; font-weight: 700; text-transform: uppercase;
    }
    .cg-badge-category {
        background: rgba(2, 132, 199, 0.08); color: #0284C7; padding: 2px 8px; border-radius: 10px;
        font-size: 10px; font-weight: 600; display: inline-block;
    }
    .btn-cg-action {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: 6px; border: 1px solid #CBD5E1;
        background: #F1F5F9; color: #475569; cursor: pointer; transition: all 0.2s ease;
    }
    .btn-cg-action:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
    @media (max-width: 1024px) {
        .cg-split-layout { flex-direction: column; }
        .cg-column-left, .cg-column-right { width: 100%; }
    }
</style>

<div class="cg-admin-wrapper">
    <div class="cg-split-layout">
        <div class="cg-column-left">
            <div class="cg-card">
                <div class="cg-card-header" style="display:flex; align-items:center; justify-content:space-between;">
                    <span id="cgFormTitleText"><i class="fas fa-file-medical text-[#0284C7] mr-1"></i> Add Guideline</span>
                    <span id="cgFormModeBadge" style="font-size: 10px; background: #EFF6FF; color: #1E40AF; padding: 3px 8px; border-radius: 4px; font-weight: 700; text-transform: none; letter-spacing: 0;">CREATE MODE</span>
                </div>

                <form id="cgForm" action="{{ route('admin.guidelines.store') }}" method="POST" enctype="multipart/form-data" data-mode="create" novalidate>
                    @csrf
                    <input type="hidden" name="action_type" id="cgActionType" value="save">

                    <div style="margin-bottom: 16px;">
                        <label class="cg-label"><i class="fas fa-heading text-slate-400 mr-1"></i> Title</label>
                        <input type="text" name="title" id="cgTitleInput" class="cg-control" placeholder="e.g., Perioperative Anticoagulation Protocol">
                        <div id="cgTitleError" class="cg-error-msg">
                            <i class="fas fa-exclamation-triangle"></i> <span>Title is required.</span>
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="cg-label"><i class="fas fa-tag text-slate-400 mr-1"></i> Category (optional)</label>
                        <input type="text" name="category" id="cgCategoryInput" list="cgCategoryOptions" class="cg-control" placeholder="e.g., Perioperative Protocol">
                        <datalist id="cgCategoryOptions">
                            <option value="Perioperative Protocol">
                            <option value="Echo Standards">
                            <option value="Anesthesia Guideline">
                            <option value="Surgical Protocol">
                        </datalist>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="cg-label"><i class="fas fa-align-left text-slate-400 mr-1"></i> Description (optional)</label>
                        <textarea name="description" id="cgDescriptionInput" class="cg-control" placeholder="Write the guideline directly here, or attach a document below."></textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label class="cg-label"><i class="fas fa-paperclip text-slate-400 mr-1"></i> Attachment (PDF, JPG or PNG — optional, max 10MB)</label>
                        <div class="cg-dropzone" id="cgDropzone" onclick="document.getElementById('cgFileInput').click();">
                            <div id="cgDropzoneText">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 20px; color: #94A3B8;"></i>
                                <div style="font-size: 12px; font-weight: 600; color: #475569; margin-top: 4px;">Click to choose a file</div>
                                <div style="font-size: 10.5px; color: #94A3B8; margin-top: 2px;">or drag and drop it here</div>
                            </div>
                            <div id="cgFileName" style="font-size: 11.5px; font-weight: 600; color: #0284C7; margin-top: 6px; display: none;"></div>
                        </div>
                        <input type="file" name="guideline_file" id="cgFileInput" style="display:none;" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png">
                        <div id="cgFileOptionalNote" style="display:none; font-size: 11px; color: #94A3B8; margin-top: 6px;">
                            <i class="fas fa-circle-info"></i> Leave empty to keep the current attachment.
                        </div>
                    </div>

                    <div id="cgFormButtons" style="display:flex; flex-direction:column; gap:10px;">
                        <button type="button" onclick="validateAndSubmitGuideline('publish')" class="btn-cg-publish">
                            <i class="fas fa-globe"></i> Publish Live
                        </button>
                        <button type="button" onclick="validateAndSubmitGuideline('save')" class="btn-cg-draft">
                            <i class="fas fa-folder-plus"></i> Save as Draft
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="cg-column-right">
            <div class="cg-card" style="padding: 0; overflow: hidden;">
                <div class="cg-card-header" style="padding: 20px 24px; margin-bottom: 0;">
                    <i class="fas fa-list"></i> All Guidelines
                </div>
                <div style="overflow-x: auto; width: 100%;">
                    <table style="width: 100%; min-width: 700px; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                        <thead>
                            <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px;">
                                <th style="padding: 14px 20px;">Title</th>
                                <th style="padding: 14px 20px; text-align: center;">Status</th>
                                <th style="padding: 14px 20px;">Uploaded By</th>
                                <th style="padding: 14px 20px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155; font-weight: 500;">
                            @forelse($guidelines as $row)
                            <tr style="border-bottom: 1px solid #E2E8F0;">
                                <td style="padding: 14px 20px; font-weight: 700; color: #0F172A;">
                                    {{ $row->title }}
                                    @if($row->category)
                                        <div style="margin-top: 4px;"><span class="cg-badge-category">{{ $row->category }}</span></div>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    @if($row->status == 2)
                                        <span class="cg-badge-live"><i class="fas fa-circle-check"></i> Live</span>
                                    @else
                                        <form id="cg-publish-form-{{ $row->id }}" action="{{ route('admin.guidelines.publish_direct', $row->id) }}" method="POST" style="display:inline-block;margin:0;">
                                            @csrf
                                            <button type="button" onclick="confirmGuidelineAction('cg-publish-form-{{ $row->id }}', 'Publish this guideline?', 'It will become visible on the public Clinical Guidelines page.', 'question', '#0284C7', 'Yes, publish it')" class="cg-badge-draft" style="border:none; cursor:pointer;">Draft</button>
                                        </form>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; font-size: 11.5px;">
                                    <span style="font-weight: 600; color: #0F172A;">{{ $row->creator->name ?? 'Admin' }}</span>
                                    <div style="font-size: 10px; color: #94A3B8; margin-top: 2px;">{{ $row->created_at->format('d M, h:i A') }}</div>
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    <div style="display: flex; gap: 6px; justify-content: center;">
                                        @if($row->guideline_file)
                                            <a href="{{ asset($row->guideline_file) }}" target="_blank" class="btn-cg-action" title="View File">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        <button type="button" onclick="switchGuidelineToEditMode({{ $row->id }}, @js($row->title), @js($row->category), @js($row->description))" class="btn-cg-action" title="Edit">
                                            <i class="fas fa-edit" style="color:#0284C7;"></i>
                                        </button>
                                        <form id="cg-delete-form-{{ $row->id }}" action="{{ route('admin.guidelines.delete', $row->id) }}" method="POST" style="display:inline-block;margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmGuidelineAction('cg-delete-form-{{ $row->id }}', 'Delete this guideline?', 'This will remove it from the public page. It can still be recovered from backups if needed.', 'warning', '#EF4444', 'Yes, delete it')" class="btn-cg-action" title="Delete">
                                                <i class="fas fa-trash-alt" style="color:#EF4444;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600;">
                                    <i class="fas fa-file-medical" style="font-size: 26px; display: block; margin-bottom: 8px; color: #CBD5E1;"></i>
                                    No clinical guidelines added yet.
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
    (function () {
        var input = document.getElementById('cgFileInput');
        var dropzone = document.getElementById('cgDropzone');
        var dzText = document.getElementById('cgDropzoneText');
        var fileNameNode = document.getElementById('cgFileName');

        function showFile(file) {
            if (!file) return;
            fileNameNode.textContent = file.name;
            fileNameNode.style.display = 'block';
            dzText.querySelector('div').textContent = 'Selected — click to change';
            dropzone.classList.add('has-file');
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

    function validateAndSubmitGuideline(actionType) {
        var titleInput = document.getElementById('cgTitleInput');
        var titleError = document.getElementById('cgTitleError');
        var actionField = document.getElementById('cgActionType');
        var form = document.getElementById('cgForm');

        titleError.style.display = 'none';
        titleInput.classList.remove('cg-input-error-shake');

        if (!titleInput.value.trim()) {
            titleInput.classList.add('cg-input-error-shake');
            titleError.style.display = 'flex';
            setTimeout(function () { titleInput.classList.remove('cg-input-error-shake'); }, 420);
            return;
        }

        actionField.value = actionType;
        form.submit();
    }

    function switchGuidelineToEditMode(id, title, category, description) {
        var form = document.getElementById('cgForm');
        document.getElementById('cgTitleInput').value = title || '';
        document.getElementById('cgCategoryInput').value = category || '';
        document.getElementById('cgDescriptionInput').value = description || '';
        document.getElementById('cgFileInput').value = '';
        document.getElementById('cgFileOptionalNote').style.display = 'block';
        document.getElementById('cgTitleInput').focus();

        form.action = '/admin/clinical-guidelines/' + id + '/update';
        form.dataset.mode = 'edit';

        document.getElementById('cgFormTitleText').innerHTML = '<i class="fas fa-edit text-[#1D4ED8] mr-1"></i> Edit Guideline';
        var badge = document.getElementById('cgFormModeBadge');
        badge.textContent = 'EDIT MODE';
        badge.style.background = '#EFF6FF';
        badge.style.color = '#1D4ED8';

        document.getElementById('cgFormButtons').innerHTML = `
            <button type="button" onclick="validateAndSubmitGuideline('update')" class="btn-cg-publish">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <button type="button" onclick="cancelGuidelineEditMode()" class="btn-cg-draft">
                <i class="fas fa-times"></i> Cancel
            </button>
        `;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function cancelGuidelineEditMode() {
        var form = document.getElementById('cgForm');
        form.reset();
        form.action = "{{ route('admin.guidelines.store') }}";
        form.dataset.mode = 'create';

        document.getElementById('cgFileOptionalNote').style.display = 'none';
        document.getElementById('cgFileName').style.display = 'none';
        document.getElementById('cgDropzoneText').querySelector('div').textContent = 'Click to choose a file';
        document.getElementById('cgDropzone').classList.remove('has-file');

        document.getElementById('cgFormTitleText').innerHTML = '<i class="fas fa-file-medical text-[#0284C7] mr-1"></i> Add Guideline';
        var badge = document.getElementById('cgFormModeBadge');
        badge.textContent = 'CREATE MODE';
        badge.style.background = '#EFF6FF';
        badge.style.color = '#1E40AF';

        document.getElementById('cgFormButtons').innerHTML = `
            <button type="button" onclick="validateAndSubmitGuideline('publish')" class="btn-cg-publish">
                <i class="fas fa-globe"></i> Publish Live
            </button>
            <button type="button" onclick="validateAndSubmitGuideline('save')" class="btn-cg-draft">
                <i class="fas fa-folder-plus"></i> Save as Draft
            </button>
        `;
    }

    // SweetAlert2 v8 confirm - `type` not `icon`, result resolves as {value}, not {isConfirmed}
    function confirmGuidelineAction(formId, title, text, type, confirmColor, confirmText) {
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
