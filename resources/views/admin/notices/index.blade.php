<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Announcements Registry | BACTA Admin')

@section('content')
<style>
    /* 🚀 BACTA ওফিসিয়াল ম্যাট্রিকেস ইআরপি টু-কলাম স্প্লিট থিম */
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
    /* ⚡ ভুল ইনপুটে ঝাঁকুনি অ্যানিমেশন (Shake Animation) */
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
    @media (max-width: 1024px) {
        .registry-split-layout { flex-direction: column; }
        .registry-column-left, .registry-column-right { width: 100%; }
    }
</style>

<div class="bacta-admin-wrapper">
    
    {{-- 🔒 ৩ সেকেন্ডের রাজকীয় সবুজ সাকসেস ব্যানার অ্যালার্ট এরিয়া --}}
    @if(session('success'))
        <div id="metricSuccessBanner" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #ffffff; padding: 14px 18px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2); transition: all 0.5s ease;">
            <i class="fas fa-check-circle" style="font-size: 16px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="registry-split-layout">
        
        <!-- ==========================================
             🔒 বাম কলাম: ওয়ান-ক্লিক স্মার্ট ইন-লাইন আপলোড ও আপডেট ফর্ম
             ========================================== -->
        <div class="registry-column-left">
            <div class="metric-card">
                {{-- ডাইনামিক ফর্ম হেডার টাইটেল জোন ভাই --}}
                <div class="metric-card-header" style="margin-bottom: 25px;">
                    <span id="formTitleTextHub"><i class="fas fa-file-medical text-[#0284C7] mr-1"></i> Add Announcement</span>
                    <span id="formModeBadgeHub" style="font-size: 10px; background: #EFF6FF; color: #1E40AF; padding: 3px 8px; border-radius: 4px; font-weight: 700;">CREATE MODE</span>
                </div>

                {{-- আপনার হসপিটাল রেজিস্ট্রির মতো ডাইনামিক সাবমিট অ্যাকশন ফর্ম --}}
                <form id="noticeUploadForm" action="{{ route('admin.notices.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    {{-- এডিট মোডে মেথড স্পুফিং পুশ করার জন্য এবং ডাইনামিক সাবমিট ট্র্যাক করার হিডেন অবজেক্ট --}}
                    <input type="hidden" name="_method" id="formMethodSpoofHub" value="POST">
                    <input type="hidden" name="action_type" id="noticeActionType" value="save">
                    
                    <div style="margin-bottom: 20px;">
                        <label class="metric-label"><i class="fas fa-pen-nib text-slate-400 mr-1"></i> Title / Subject</label>
                        <input type="text" name="title" id="noticeTitle" class="metric-control" placeholder="e.g., 1st BACTA National Conference Notice">
                        {{-- 💡 আল্ট্রা-স্মার্ট প্রফেশনাল এরর মেসেজ জোন ১ --}}
                        <div id="titleErrorNode" style="display: none; color: #EF4444; font-size: 11.5px; font-weight: 600; margin-top: 6px; align-items: center; gap: 4px;">
                            <i class="fas fa-exclamation-triangle"></i> <span>Title field is mandatory! Please entry a formal descriptive subject.</span>
                        </div>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label class="metric-label"><i class="fas fa-paperclip text-slate-400 mr-1"></i> Upload File (PDF / Images)</label>
                        <input type="file" name="notice_file" id="noticeFile" class="metric-control" style="padding-top: 8px;" accept=".pdf,.jpg,.jpeg,.png">
                        {{-- 💡 আল্ট্রা-স্মার্ট প্রফেশনাল এরর মেসেজ জোন ২ --}}
                        <div id="fileErrorNode" style="display: none; color: #EF4444; font-size: 11.5px; font-weight: 600; margin-top: 6px; align-items: center; gap: 4px;">
                            <i class="fas fa-cloud-upload-alt"></i> <span>Attachment file is required! Supported files: PDF, JPG, PNG (Max: 5MB).</span>
                        </div>
                    </div>

                    {{-- ডাইনামিক কন্ট্রোল বাটন উইজেট হাব --}}
                    <div id="formControlButtonsGroupHub" style="display: flex; flex-direction: column; gap: 12px;">
                        <button type="button" onclick="validateAndSubmitNotice('publish')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px;">
                            <i class="fas fa-globe"></i> Publish Live Immediately
                        </button>
                        <button type="button" onclick="validateAndSubmitNotice('save')" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;">
                            <i class="fas fa-folder-plus"></i> Save as Draft (Pending)
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ==========================================
             🚀 ডান কলাম: সেন্ট্রাল নোটিশ ডাটাবেজ আর্কাইভ টেবিল
             ========================================== -->
        <div class="registry-column-right">
            <div class="metric-card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                
                {{-- 🔍 ডাটাটেবিল সার্চ হেড ফিল্টার জোন --}}
                <div class="metric-card-header" style="padding: 20px 24px; margin-bottom: 0; border-bottom: 1px solid #E2E8F0; width: 100%;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-server text-[#1E40AF]"></i> 
                        <span>Archive Registry Log</span>
                    </div>
                    
                    {{-- লাইভ ডাটাটেবিল সার্চ উইজেট --}}
                    <div class="datatable-search-wrapper">
                        <i class="fas fa-search" style="position: absolute; left: 11px; top: 10px; color: #94A3B8; font-size: 13px;"></i>
                        <input type="text" id="dtNoticeSearchInput" class="datatable-search-input" style="width: 100%; height: 34px; background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0 10px 0 32px; font-size: 12.5px; color: #0F172A; outline: none; transition: all 0.3s ease;" placeholder="Quick Filter Records...">
                    </div>
                </div>

                {{-- টেবিল ডাটা রেস্পন্সিভ জোন --}}
                <div style="overflow-x: auto; width: 100%;">
                    <table id="metricNoticeTableHub" style="width: 100%; min-width: 750px; border-collapse: collapse; text-align: left; font-size: 12.5px;">
                        <thead>
                            <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                                <th style="padding: 14px 20px; width: 50px; text-align: center;">SL</th>
                                <th style="padding: 14px 20px;">Circular Subject Title</th>
                                <th style="padding: 14px 20px; width: 100px; text-align: center;">Status Gate</th>
                                <th style="padding: 14px 20px; width: 140px;">Created By Audit</th>
                                <th style="padding: 14px 20px; width: 140px;">Updated By Audit</th>
                                <th style="padding: 14px 20px; width: 130px; text-align: center;">Action Hub</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155; font-weight: 500;">
                            @forelse($notices as $key => $row)
                            <tr class="dt-notice-row-item" style="border-bottom: 1px solid #E2E8F0; transition: all 0.2s ease;">
                                <td class="dt-sl-node" style="padding: 14px 20px; text-align: center; color: #94A3B8; font-weight: 700;">{{ $key + 1 }}</td>
                                <td class="dt-title-node" style="padding: 14px 20px; font-weight: 700; color: #0F172A;">
                                    <i class="far fa-file-pdf text-[#EF4444] mr-1" style="font-size: 13.5px;"></i> <span>{{ $row->title }}</span>
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
                                    @if($row->status == 2)
                                        <span style="background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 3px 9px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase;">Live</span>
                                    @else
                                        {{-- 🚀 ওয়ান-ক্লিক ডাইনামিক লাইভ পাবলিশ বাটন ফর্ম মেকানিজম ভাই --}}
                                        <form action="{{ route('admin.notices.publish_direct', $row->id) }}" method="POST" onsubmit="return confirm('🚀 Do you want to publish this announcement live immediately?');" style="display: inline-block; margin: 0;">
                                            @csrf
                                            <button type="submit" style="background: rgba(148, 163, 184, 0.1); color: #64748B; padding: 4px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase; border: 1px solid #CBD5E1; cursor: pointer; transition: all 0.2s ease;" onmouseenter="this.style.background='#10B981'; this.style.color='#ffffff'; this.style.borderColor='#10B981';" onmouseleave="this.style.background='rgba(148, 163, 184, 0.1)'; this.style.color='#64748B'; this.style.borderColor='#CBD5E1';">
                                                <i class="fas fa-paper-plane mr-1" style="font-size: 9px;"></i> Draft
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; font-size: 11.5px; color: #475569;">
                                    <span style="font-weight: 600; color: #0F172A;">{{ $row->creator->name ?? 'Admin' }}</span>
                                    <div style="font-size: 10px; color: #94A3B8; margin-top: 2px;"><i class="far fa-clock"></i> {{ $row->created_at->format('d M, h:i A') }}</div>
                                </td>
                                <td style="padding: 14px 20px; font-size: 11.5px; color: #475569;">
                                    <span style="font-weight: 600; color: #0F172A;">{{ $row->updater->name ?? '--' }}</span>
                                    @if($row->updated_at != $row->created_at)
                                        <div style="font-size: 10px; color: #94A3B8; margin-top: 1px;"><i class="far fa-clock"></i> {{ $row->updated_at->format('d M, h:i A') }}</div>
                                    @endif
                                </td>
                                <td style="padding: 14px 20px; text-align: center;">
    <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
        {{-- 👑 ফিক্সড জিরো-সিমলিঙ্ক প্রিভিউ নোড: যা সরাসরি public/uploads ফোল্ডার থেকে ওরিজিনাল ফাইল ১ সেকেন্ডে লোড করবে ভাই --}}
        <a href="{{ asset($row->notice_file) }}" target="_blank" class="btn-metric-action" style="background: #F1F5F9; color: #475569; border-color: #CBD5E1;" title="View Attached File">
            <i class="fas fa-eye"></i>
        </a>
        
        {{-- 🔒 আপনার অফিসিয়াল ইন-লাইন এডিট ট্রিগার কন্ডিশন ভাই --}}
        @if($row->status == 1)
            <button type="button" onclick="switchToInlineEditMode({{ $row->id }}, '{{ addslashes($row->title) }}')" class="btn-metric-action btn-metric-edit" title="Edit Inline">
                <i class="fas fa-edit"></i>
            </button>
        @else
            <span class="btn-metric-action" style="background: #F0FDF4; color: #16A34A; border-color: #DCFCE7; cursor: not-allowed;" title="Published Locked">
                <i class="fas fa-shield-alt"></i>
            </span>
        @endif

        {{-- ওরিজিনাল সিকিউর ডিলিট ফরম নোড ভাই --}}
        <form action="{{ route('admin.notices.delete', $row->id) }}" method="POST" onsubmit="return confirm('🚨 Wipe official file from storage permanently?');" style="display: inline-block; margin: 0;">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn-metric-action btn-metric-delete" title="Delete Notice">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
</td>

                            </tr>
                            @empty
                            <tr id="dtEmptyNoticeFallbackRow">
                                <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600; font-size: 14px;">
                                    <i class="fas fa-folder-open" style="font-size: 26px; display: block; margin-bottom: 8px;"></i> Central registry database is empty.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- ⏳ কাস্টম ডাইনামিক পেজিনেশন বার নোড উইজেট --}}
                <div class="metric-pagination-bar">
                    <div id="dtPaginationInfoNode">Showing 0 to 0 of 0 logs</div>
                    <div class="pagination-btn-group" id="dtPaginationNavGroup"></div>
                </div>
            </div>
        </div>

    </div> {{-- .registry-split-layout ক্লোজিং --}}
</div> {{-- .bacta-admin-wrapper ক্লোজিং --}}
<script>
    // 💡 ১. আপনার সিগনেচার মেকানিজম: ওয়ান-ক্লিক ইন-লাইন এডিট মোড সুইচার ইঞ্জিন ভাই
    function switchToInlineEditMode(id, currentTitle) {
        let form = document.getElementById('noticeUploadForm');
        let titleInput = document.getElementById('noticeTitle');
        let fileInput = document.getElementById('noticeFile');
        let methodSpoof = document.getElementById('formMethodSpoofHub');
        
        let formTitleText = document.getElementById('formTitleTextHub');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let buttonsGroup = document.getElementById('formControlButtonsGroupHub');

        // এরর মেসেজগুলো প্রথমে ক্লিন করে নেওয়া হলো ভাই
        document.getElementById('titleErrorNode').style.display = 'none';
        document.getElementById('fileErrorNode').style.display = 'none';

        // ডাটাবেজ থেকে আসা ভ্যালু ফর্মে পুশ এবং ফাইল অপ্টিমাইজেশন লক
        titleInput.value = currentTitle;
        titleInput.focus();
        
        // ল্যারাভেলের এডিট রাউট ও মেথড স্পুফিং আপডেট জোনিং ভাই
        form.action = "/admin/notices/update/" + id;
        methodSpoof.value = "POST"; // কন্ট্রোলারের আপডেট রাউটের সাথে পারফেক্ট সিঙ্ক ভাই

        // ইআরপি ড্যাশবোর্ড ইন্টারফেসের টেক্সট ও কাস্টম ব্যাজ বদলে গেল ভাই
        formTitleText.innerHTML = '<i class="fas fa-edit text-[#1D4ED8] mr-1"></i> Update Announcement';
        formModeBadge.innerHTML = 'EDIT MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1D4ED8';

        // ডাইনামিকালি বাটন গ্রুপ বদলে জাদুকরী এডিট সাবমিট বাটন সেটআপ ভাই
        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitNotice('update_action')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%); box-shadow: 0 4px 12px rgba(29, 78, 216, 0.2);">
                <i class="fas fa-save"></i> Save Changes Now
            </button>
            <button type="button" onclick="cancelInlineEditMode()" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #64748B; border: 1px solid #CBD5E1;">
                <i class="fas fa-times"></i> Cancel & Create New
            </button>
        `;
    }

    // ২. এডিট মোড বাতিল করে আবার নরমাল ক্রিয়েট মোডে ব্যাক করার মেথড
    function cancelInlineEditMode() {
        let form = document.getElementById('noticeUploadForm');
        let titleInput = document.getElementById('noticeTitle');
        let methodSpoof = document.getElementById('formMethodSpoofHub');
        let formTitleText = document.getElementById('formTitleTextHub');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let buttonsGroup = document.getElementById('formControlButtonsGroupHub');

        form.reset();
        form.action = "{{ route('admin.notices.store') }}";
        methodSpoof.value = "POST";

        formTitleText.innerHTML = '<i class="fas fa-file-medical text-[#0284C7] mr-1"></i> Add Announcement';
        formModeBadge.innerHTML = 'CREATE MODE';
        formModeBadge.style.background = '#EFF6FF';
        formModeBadge.style.color = '#1E40AF';

        buttonsGroup.innerHTML = `
            <button type="button" onclick="validateAndSubmitNotice('publish')" class="btn-metric-publish" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px;">
                <i class="fas fa-globe"></i> Publish Live Immediately
            </button>
            <button type="button" onclick="validateAndSubmitNotice('save')" class="btn-metric-save" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; height: 42px; background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1;">
                <i class="fas fa-folder-plus"></i> Save as Draft (Pending)
            </button>
        `;
    }

    // ৩. আপনার শর্ত অনুযায়ী: প্রফেশনাল গাইডলাইন মেসেজ ও এরর ঝাঁকুনি ভ্যালিডেশন ইঞ্জিন ভাই
    function validateAndSubmitNotice(actionType) {
        let titleInput = document.getElementById('noticeTitle');
        let fileInput = document.getElementById('noticeFile');
        let titleError = document.getElementById('titleErrorNode');
        let fileError = document.getElementById('fileErrorNode');
        let actionField = document.getElementById('noticeActionType');
        let form = document.getElementById('noticeUploadForm');
        let formModeBadge = document.getElementById('formModeBadgeHub');
        let isValid = true;

        titleError.style.display = 'none';
        fileError.style.display = 'none';

        if (!titleInput.value.trim()) {
            titleInput.classList.add('input-error-shake');
            titleError.style.display = 'flex';
            isValid = false;
            setTimeout(() => { titleInput.classList.remove('input-error-shake'); }, 420);
        }

        // 💡 এডিট মোডে থাকলে নতুন ফাইল আপলোড ঐচ্ছিক (Optional), তাই ক্রিয়েট মোডেই শুধু ফাইল ম্যান্ডেটরি লক ভাই
        if (formModeBadge.innerHTML === 'CREATE MODE' && !fileInput.value) {
            fileInput.classList.add('input-error-shake');
            fileError.style.display = 'flex';
            isValid = false;
            setTimeout(() => { fileInput.classList.remove('input-error-shake'); }, 420);
        }

        if (isValid) {
            if (actionType !== 'update_action') {
                actionField.value = actionType;
            }
            form.submit();
        }
    }

    // ৪. ৩ সেকেন্ডের ম্যাজিক সাকসেস ব্যানার এবং ডাটাটেবিল পেজিনেশন ফিল্টার লজিক জোন ভাই
    document.addEventListener("DOMContentLoaded", function() {
        let successBanner = document.getElementById('metricSuccessBanner');
        if (successBanner) {
            setTimeout(function() {
                successBanner.style.opacity = '0';
                successBanner.style.transform = 'translateY(-15px)';
                setTimeout(function() { successBanner.remove(); }, 500);
            }, 3000); // ঠিক ৩ সেকেন্ড পর অটো-হাইড লকড
        }

        let searchInput = document.getElementById('dtNoticeSearchInput');
        let tableRows = document.querySelectorAll('.dt-notice-row-item');
        let emptyRow = document.getElementById('dtEmptyNoticeFallbackRow');
        let rowsPerPage = 7;
        let currentPage = 1;

        function renderDataTable() {
            let query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            let filteredRows = [];

            tableRows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    filteredRows.push(row);
                    row.style.display = 'none'; 
                } else {
                    row.style.display = 'none';
                }
            });

            if (filteredRows.length === 0) {
                if (emptyRow) emptyRow.style.display = '';
                document.getElementById('dtPaginationInfoNode').textContent = 'Showing 0 to 0 of 0 logs';
                document.getElementById('dtPaginationNavGroup').innerHTML = '';
                return;
            }

            if (emptyRow) emptyRow.style.display = 'none';

            let totalRows = filteredRows.length;
            let totalPages = Math.ceil(totalRows / rowsPerPage);
            if (currentPage > totalPages) currentPage = totalPages || 1;

            let startIdx = (currentPage - 1) * rowsPerPage;
            let endIdx = Math.min(startIdx + rowsPerPage, totalRows);

            for (let i = startIdx; i < endIdx; i++) {
                filteredRows[i].style.display = '';
                let slNode = filteredRows[i].querySelector('.dt-sl-node');
                if (slNode && query === '') {
                    slNode.textContent = i + 1;
                }
            }

            document.getElementById('dtPaginationInfoNode').textContent = `Showing ${startIdx + 1} to ${endIdx} of ${totalRows} logs`;

            let navGroup = document.getElementById('dtPaginationNavGroup');
            navGroup.innerHTML = '';

            for (let p = 1; p <= totalPages; p++) {
                let btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `pagination-number-node ${p === currentPage ? 'active-node' : ''}`;
                btn.textContent = p;
                btn.addEventListener('click', function() {
                    currentPage = p;
                    renderDataTable();
                });
                navGroup.appendChild(btn);
            }
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                currentPage = 1;
                renderDataTable();
            });
        }

        renderDataTable();
    });
</script>

@endsection
