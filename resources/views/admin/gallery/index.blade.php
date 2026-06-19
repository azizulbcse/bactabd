<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" /> 
@extends('adminlte::page')

@section('title', 'Events & Gallery Registry | BACTA Admin')

@section('content')
<style>
    .bacta-admin-wrapper {
        font-family: 'Poppins', sans-serif;
        padding: 10px 5px;
        background-color: #F8FAFC;
        width: 100%;
        box-sizing: border-box;
    }
    .registry-split-layout {
        display: flex;
        gap: 25px;
        align-items: flex-start;
        width: 100%;
    }
    .registry-column-left {
        width: 33%;
        flex-shrink: 0;
    }
    .registry-column-right {
        width: 67%;
        flex-grow: 1;
    }
    .metric-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.03);
        padding: 24px;
        position: relative;
        box-sizing: border-box;
    }
    .metric-card-header {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-transform: uppercase;
        letter-spacing: 0.25px;
    }
    .metric-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
    }
    .metric-control {
        width: 100%;
        height: 40px;
        background: #ffffff;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        padding: 0 12px;
        font-size: 13px;
        color: #0F172A;
        outline: none;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }
    .metric-control:focus {
        border-color: #0284C7;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }
    @keyframes metricShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }
    .input-error-shake {
        animation: metricShake 0.4s ease-in-out;
        border-color: #EF4444 !important;
        background-color: #FEF2F2;
    }
    .btn-metric-save {
        background: #475569; color: #ffffff; font-weight: 600; padding: 10px 16px;
        border-radius: 8px; font-size: 12.5px; border: none; cursor: pointer; transition: all 0.3s ease;
    }
    .btn-metric-save:hover { background: #334155; }
    .btn-metric-publish {
        background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%); color: #ffffff;
        font-weight: 600; padding: 10px 20px; border-radius: 8px; font-size: 12.5px;
        border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);
    }
    .btn-metric-publish:hover { opacity: 0.95; transform: translateY(-1px); }
    
    .datatable-search-wrapper { position: relative; max-width: 250px; width: 100%; }
    .datatable-search-input { width: 100%; height: 34px; background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0 10px 0 32px; font-size: 12.5px; color: #0F172A; outline: none; transition: all 0.3s ease; }
    .datatable-search-input:focus { border-color: #0284C7; background: #ffffff; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    
    .btn-metric-action { width: 32px; height: 32px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; border: 1px solid transparent; cursor: pointer; transition: all 0.2s ease; text-decoration: none; }
    .btn-metric-edit { background: #EFF6FF; color: #1D4ED8; border-color: #BFDBFE; }
    .btn-metric-edit:hover { background: #1D4ED8; color: #ffffff; }
    .btn-metric-delete { background: #FEF2F2; color: #EF4444; border-color: #FEE2E2; }
    .btn-metric-delete:hover { background: #EF4444; color: #ffffff; }
    
    .metric-pagination-bar { display: flex; justify-content: space-between; align-items: center; padding: 16px 24px; background: #F8FAFC; border-top: 1px solid #E2E8F0; font-size: 12.5px; color: #64748B; }
    .pagination-btn-group { display: flex; gap: 6px; }
    .pagination-number-node { padding: 5px 11px; border: 1px solid #CBD5E1; background: #ffffff; border-radius: 4px; color: #334155; font-weight: 600; cursor: pointer; transition: all 0.2s ease; }
    .pagination-number-node.active-node { background: #0284C7; color: #ffffff; border-color: #0284C7; }

    @media (max-width: 1024px) {
        .registry-split-layout { flex-direction: column; }
        .registry-column-left, .registry-column-right { width: 100%; }
    }
</style>
<div class="bacta-admin-wrapper">
    @if(session('success'))
        <div id="gallerySuccessBanner" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #ffffff; padding: 14px 18px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2); transition: all 0.5s ease;">
            <i class="fas fa-check-circle" style="font-size: 16px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="registry-split-layout">
        <!-- ==========================================
             🔒 বাম কলাম: ডাইনামিক কন্ডিশনাল আপলোড ও আপডেট ফর্ম
             ========================================== -->
        <div class="registry-column-left">
            <div class="metric-card">
                <div class="metric-card-header" style="margin-bottom: 25px;">
                    <span id="formTitleTextHub"><i class="fas fa-camera-retro text-[#0284C7] mr-1"></i> Add Asset</span>
                    <span id="formModeBadgeHub" style="font-size: 10px; background: #EFF6FF; color: #1E40AF; padding: 3px 8px; border-radius: 4px; font-weight: 700;">CREATE MODE</span>
                </div>
                
                <form id="galleryUploadForm" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="_method" id="formMethodSpoofHub" value="POST">
                    <input type="hidden" name="action_type" id="galleryActionType" value="save">
                    
                    <div style="margin-bottom: 18px;">
                        <label class="metric-label"><i class="fas fa-layer-group text-slate-400 mr-1"></i> Select Asset Type</label>
                        <select name="type" id="galleryType" class="metric-control" onchange="toggleIntelligentFormFields()">
                            <option value="1">Scientific Event / Seminar</option>
                            <option value="2">Photo Gallery Asset</option>
                            <option value="3">Video Gallery Asset (Local / URL)</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label class="metric-label"><i class="fas fa-pen-nib text-slate-400 mr-1"></i> Asset Title / Subject</label>
                        <input type="text" name="title" id="galleryTitle" class="metric-control" placeholder="e.g., Annual Cardiovascular Conference 2026">
                        <div id="titleErrorNode" style="display: none; color: #EF4444; font-size: 11.5px; font-weight: 600; margin-top: 6px; align-items: center; gap: 4px;">
                            <i class="fas fa-exclamation-triangle"></i> Title field is required! Please entry a formal asset header.
                        </div>
                    </div>

                    <div id="conditionalVenueBlock" style="margin-bottom: 18px;">
                        <label class="metric-label"><i class="fas fa-map-marker-alt text-slate-400 mr-1"></i> Seminar Venue / Location</label>
                        <input type="text" name="venue" id="galleryVenue" class="metric-control" placeholder="e.g., National Heart Foundation Hospital">
                    </div>

                    <div id="conditionalDateBlock" style="margin-bottom: 18px;">
                        <label class="metric-label"><i class="far fa-calendar-alt text-slate-400 mr-1"></i> Event Date</label>
                        <input type="date" name="event_date" id="galleryEventDate" class="metric-control">
                    </div>

                    <div id="conditionalVideoUrlBlock" style="margin-bottom: 18px; display: none;">
                        <label class="metric-label"><i class="fab fa-youtube text-slate-400 mr-1"></i> YouTube / Vimeo Video URL</label>
                        <input type="url" name="video_url" id="galleryVideoUrl" class="metric-control" placeholder="https://youtube.com...">
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label class="metric-label" id="fileInputLabelNode"><i class="fas fa-cloud-upload-alt text-slate-400 mr-1"></i> Upload Cover Image (Banner)</label>
                        <input type="file" name="media_file" id="galleryFile" class="metric-control" style="padding-top: 8px;" accept=".jpg,.jpeg,.png,.mp4,.mov,.avi">
                        <div id="fileErrorNode" style="display: none; color: #EF4444; font-size: 11.5px; font-weight: 600; margin-top: 6px; align-items: center; gap: 4px;">
                            <i class="fas fa-exclamation-triangle"></i> Media attachment is required for this asset! (Max: 50MB).
                        </div>
                    </div>
                    
                    <div id="formControlButtonsGroupHub" style="display: flex; flex-direction: column; gap: 12px;">
                        <button type="button" onclick="validateAndSubmitGallery('publish')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px;">
                            <i class="fas fa-globe"></i> Publish Live Immediately
                        </button>
                        <button type="button" onclick="validateAndSubmitGallery('save')" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;">
                            <i class="fas fa-folder-plus"></i> Save as Draft (Pending)
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ==========================================
             🚀 ডান কলাম: সেন্ট্রাল ডাটাবেজ আর্কাইভ টেবিল
             ========================================== -->
        <div class="registry-column-right">
            <div class="metric-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                
                <div class="metric-card-header" style="padding: 20px 24px; margin-bottom: 0; border-bottom: 1px solid #E2E8F0; width: 100%;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-database text-[#1E40AF]"></i> <span>Central Assets Directory</span>
                    </div>
                    <div class="datatable-search-wrapper">
                        <i class="fas fa-search" style="position: absolute; left: 11px; top: 10px; color: #94A3B8; font-size: 13px;"></i>
                        <input type="text" id="dtGallerySearchInput" class="datatable-search-input" placeholder="Quick Filter Records...">
                    </div>
                </div>

                <div style="overflow-x: auto; width: 100%;">
                    <table id="metricGalleryTableHub" style="width: 100%; min-width: 750px; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                        <thead>
                            <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                                <th style="padding: 14px 20px; width: 50px; text-align: center;">SL</th>
                                <th style="padding: 14px 20px;">Asset Details & Title</th>
                                <th style="padding: 14px 20px; width: 110px; text-align: center;">Category Type</th>
                                <th style="padding: 14px 20px; width: 100px; text-align: center;">Status Gate</th>
                                <th style="padding: 14px 20px; width: 140px;">Created By Audit</th>
                                <th style="padding: 14px 20px; width: 130px; text-align: center;">Action Hub</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155; font-weight: 500;">
                            @forelse($records as $key => $row)
                            <tr class="dt-gallery-row-item" style="border-bottom: 1px solid #E2E8F0; transition: all 0.2s ease;">
                                <td class="dt-sl-node" style="padding: 14px 20px; text-align: center; color: #94A3B8; font-weight: 700;">{{ $key + 1 }}</td>
                                <td class="dt-title-node" style="padding: 14px 20px; font-weight: 700; color: #0F172A;">
                                    @if($row->type == 3)
                                        <i class="fas fa-video text-blue-500 mr-1" style="font-size: 13px;"></i>
                                    @else
                                        <i class="fas fa-image text-emerald-500 mr-1" style="font-size: 13px;"></i>
                                    @endif
                                    <span>{{ $row->title }}</span>
                                    @if($row->venue)
                                        <div style="font-size: 10.5px; color: #64748B; font-weight: 500; margin-top: 3px;"><i class="fas fa-map-marker-alt text-slate-400 mr-1"></i> {{ $row->venue }}</div>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: center; vertical-align: middle;">
                                    @if($row->type == 1)
                                        <span style="background: #EFF6FF; color: #1E40AF; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Event</span>
                                    @elif($row->type == 2)
                                        <span style="background: #ECFDF5; color: #065F46; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Photo</span>
                                    @else
                                        <span style="background: #FFF7ED; color: #9A3412; padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Video</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: center; vertical-align: middle;">
                                    @if($row->status == 2)
                                        <span style="background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 3px 9px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Live</span>
                                    @else
                                        <form action="{{ route('admin.gallery.publish_direct', $row->id) }}" method="POST" onsubmit="return confirm('🚀 Do you want to publish this asset live immediately?');" style="display: inline-block; margin: 0;">
                                            @csrf
                                            <button type="submit" style="background: rgba(148, 163, 184, 0.1); color: #64748B; padding: 4px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; border: 1px solid #CBD5E1; cursor: pointer; transition: all 0.2s ease;" onmouseenter="this.style.background='#10B981'; this.style.color='#ffffff'; this.style.borderColor='#10B981';" onmouseleave="this.style.background='rgba(148, 163, 184, 0.1)'; this.style.color='#64748B'; this.style.borderColor='#CBD5E1';">
                                                <i class="fas fa-paper-plane mr-1" style="font-size: 9px;"></i> Draft
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; font-size: 11.5px; color: #475569; vertical-align: middle;">
                                    <span style="font-weight: 600; color: #0F172A;">{{ $row->creator->name ?? 'Admin' }}</span>
                                    <div style="font-size: 10px; color: #94A3B8; margin-top: 2px;">{{ $row->created_at->format('d M, h:i A') }}</div>
                                </td>
                                <td style="padding: 14px 20px; text-align: center; vertical-align: middle;">
                                    <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                                        @if($row->media_file)
                                            <a href="{{ asset('storage/' . $row->media_file) }}" target="_blank" class="btn-metric-action" style="background: #F1F5F9; color: #475569; border-color: #CBD5E1;"><i class="fas fa-eye"></i></a>
                                        @elseif($row->video_url)
                                            <a href="{{ $row->video_url }}" target="_blank" class="btn-metric-action" style="background: #FFF7ED; color: #9A3412; border-color: #FED7AA;"><i class="fab fa-youtube"></i></a>
                                        @endif
                                        
                                        @if($row->status == 1)
                                            <button type="button" onclick="switchToInlineEditMode({{ $row->id }}, '{{ addslashes($row->title) }}', '{{ $row->type }}', '{{ addslashes($row->venue) }}', '{{ $row->event_date }}', '{{ $row->video_url }}')" class="btn-metric-action btn-metric-edit"><i class="fas fa-edit"></i></button>
                                        @else
                                            <span class="btn-metric-action" style="background: #F0FDF4; color: #16A34A; border-color: #DCFCE7; cursor: not-allowed;"><i class="fas fa-shield-alt"></i></span>
                                        @endif

                                        <form action="{{ route('admin.gallery.delete', $row->id) }}" method="POST" onsubmit="return confirm('🚨 Wipe official asset and its files from storage permanently?');" style="display: inline-block; margin: 0;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-metric-action btn-metric-delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="dtEmptyGalleryFallbackRow">
                                <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600; font-size: 14px;">
                                    <i class="fas fa-folder-open" style="font-size: 26px; display: block; margin-bottom: 8px;"></i> Central hub database is empty.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="metric-pagination-bar">
                    <div id="dtPaginationInfoNode">Showing 0 to 0 of 0 logs</div>
                    <div class="pagination-btn-group" id="dtPaginationNavGroup"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleIntelligentFormFields() {
        let type = document.getElementById('galleryType').value;
        let venueBlock = document.getElementById('conditionalVenueBlock');
        let dateBlock = document.getElementById('conditionalDateBlock');
        let videoUrlBlock = document.getElementById('conditionalVideoUrlBlock');
        let labelNode = document.getElementById('fileInputLabelNode');

        if (type == '1') {
            venueBlock.style.display = 'block';
            dateBlock.style.display = 'block';
            videoUrlBlock.style.display = 'none';
            labelNode.innerHTML = '<i class="fas fa-cloud-upload-alt text-slate-400 mr-1"></i> Upload Event Banner (Image)';
        } else if (type == '2') {
            venueBlock.style.display = 'none';
            dateBlock.style.display = 'none';
            videoUrlBlock.style.display = 'none';
            labelNode.innerHTML = '<i class="fas fa-cloud-upload-alt text-slate-400 mr-1"></i> Upload Photo (Gallery)';
        } else if (type == '3') {
            venueBlock.style.display = 'none';
            dateBlock.style.display = 'none';
            videoUrlBlock.style.display = 'block';
            labelNode.innerHTML = '<i class="fas fa-cloud-upload-alt text-slate-400 mr-1"></i> Upload Local Video File (Optional)';
        }
    }

    function validateAndSubmitGallery(actionType) {
        let titleInput = document.getElementById('galleryTitle');
        let typeInput = document.getElementById('galleryType');
        let fileInput = document.getElementById('galleryFile');
        let videoUrlInput = document.getElementById('galleryVideoUrl');
        
        let titleError = document.getElementById('titleErrorNode');
        let fileError = document.getElementById('fileErrorNode');
        let actionField = document.getElementById('galleryActionType');
        let form = document.getElementById('galleryUploadForm');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let isValid = true;

        titleError.style.display = 'none';
        fileError.style.display = 'none';

        if (!titleInput.value.trim()) {
            titleInput.classList.add('input-error-shake'); titleError.style.display = 'flex'; isValid = false;
            setTimeout(() => { titleInput.classList.remove('input-error-shake'); }, 420);
        }

        if (formModeBadge.innerHTML === 'CREATE MODE') {
            if (typeInput.value != '3' && !fileInput.value) {
                fileInput.classList.add('input-error-shake'); fileError.style.display = 'flex'; isValid = false;
                setTimeout(() => { fileInput.classList.remove('input-error-shake'); }, 420);
            } else if (typeInput.value == '3' && !videoUrlInput.value.trim() && !fileInput.value) {
                fileInput.classList.add('input-error-shake'); fileError.style.display = 'flex'; isValid = false;
                setTimeout(() => { fileInput.classList.remove('input-error-shake'); }, 420);
            }
        }

        if (isValid) {
            if (actionType !== 'update_action') { actionField.value = actionType; }
            form.submit();
        }
    }
    function switchToInlineEditMode(id, currentTitle, type, venue, date, videoUrl) {
        let form = document.getElementById('galleryUploadForm');
        let titleInput = document.getElementById('galleryTitle');
        let typeInput = document.getElementById('galleryType');
        let venueInput = document.getElementById('galleryVenue');
        let dateInput = document.getElementById('galleryEventDate');
        let videoUrlInput = document.getElementById('galleryVideoUrl');
        let methodSpoof = document.getElementById('formMethodSpoofHub');
        let formTitleText = document.getElementById('formTitleTextHub');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let buttonsGroup = document.getElementById('formControlButtonsGroupHub');

        document.getElementById('titleErrorNode').style.display = 'none';
        document.getElementById('fileErrorNode').style.display = 'none';

        titleInput.value = currentTitle;
        typeInput.value = type;
        venueInput.value = venue;
        dateInput.value = date;
        videoUrlInput.value = videoUrl;

        toggleIntelligentFormFields();
        titleInput.focus();
        
        form.action = "{{ url('admin/gallery-hub/update') }}/" + id;
        methodSpoof.value = "POST";

        formTitleText.innerHTML = '<i class="fas fa-edit text-[#1D4ED8] mr-1"></i> Update Registry Asset';
        formModeBadge.innerHTML = 'EDIT MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1D4ED8';

        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitGallery('update_action')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%); box-shadow: 0 4px 12px rgba(29, 78, 216, 0.2);">
                <i class="fas fa-save"></i> Save Changes Now
            </button>
            <button type="button" onclick="cancelInlineEditMode()" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1;">
                <i class="fas fa-times"></i> Cancel & Create New
            </button>
        `;
    }

    function cancelInlineEditMode() {
        let form = document.getElementById('galleryUploadForm');
        let titleInput = document.getElementById('galleryTitle');
        let typeInput = document.getElementById('galleryType');
        let methodSpoof = document.getElementById('formMethodSpoofHub');
        let formTitleText = document.getElementById('formTitleTextHub');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let buttonsGroup = document.getElementById('formControlButtonsGroupHub');

        form.reset();
        form.action = "{{ route('admin.gallery.store') }}";
        methodSpoof.value = "POST";
        typeInput.value = "1";

        toggleIntelligentFormFields();

        formTitleText.innerHTML = '<i class="fas fa-camera-retro text-[#0284C7] mr-1"></i> Add Asset';
        formModeBadge.innerHTML = 'CREATE MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1E40AF';

        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitGallery('publish')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px;">
                <i class="fas fa-globe"></i> Publish Live Immediately
            </button>
            <button type="button" onclick="validateAndSubmitGallery('save')" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;">
                <i class="fas fa-folder-plus"></i> Save as Draft (Pending)
            </button>
        `;
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleIntelligentFormFields();

        let successBanner = document.getElementById('gallerySuccessBanner');
        if (successBanner) {
            setTimeout(function() {
                successBanner.style.opacity = '0'; successBanner.style.transform = 'translateY(-15px)';
                setTimeout(function() { successBanner.remove(); }, 500);
            }, 3000);
        }

        let searchInput = document.getElementById('dtGallerySearchInput');
        let tableRows = document.querySelectorAll('.dt-gallery-row-item');
        let emptyRow = document.getElementById('dtEmptyGalleryFallbackRow');
        let rowsPerPage = 7; let currentPage = 1;

        function renderDataTable() {
            let query = searchInput ? searchInput.value.toLowerCase().trim() : ''; let filteredRows = [];
            tableRows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if (text.includes(query)) { filteredRows.push(row); row.style.display = 'none'; } 
                else { row.style.display = 'none'; }
            });

            if (filteredRows.length === 0) {
                if (emptyRow) emptyRow.style.display = '';
                document.getElementById('dtPaginationInfoNode').textContent = 'Showing 0 to 0 of 0 logs';
                document.getElementById('dtPaginationNavGroup').innerHTML = ''; return;
            }

            if (emptyRow) emptyRow.style.display = 'none';
            let totalRows = filteredRows.length; let totalPages = Math.ceil(totalRows / rowsPerPage);
            if (currentPage > totalPages) currentPage = totalPages || 1;
            let startIdx = (currentPage - 1) * rowsPerPage; let endIdx = Math.min(startIdx + rowsPerPage, totalRows);

            for (let i = startIdx; i < endIdx; i++) {
                filteredRows[i].style.display = '';
                let slNode = filteredRows[i].querySelector('.dt-sl-node');
                if (slNode && query === '') { slNode.textContent = i + 1; }
            }

            document.getElementById('dtPaginationInfoNode').textContent = 'Showing ' + (startIdx + 1) + ' to ' + endIdx + ' of ' + totalRows + ' logs';
            let navGroup = document.getElementById('dtPaginationNavGroup'); navGroup.innerHTML = '';

            for (let p = 1; p <= totalPages; p++) {
                let btn = document.createElement('button'); btn.type = 'button';
                btn.className = 'pagination-number-node ' + (p === currentPage ? 'active-node' : '');
                btn.textContent = p; btn.addEventListener('click', function() { currentPage = p; renderDataTable(); });
                navGroup.appendChild(btn);
            }
        }

        if (searchInput) { searchInput.addEventListener('keyup', function() { currentPage = 1; renderDataTable(); }); }
        renderDataTable();
    });
</script>
@endsection
