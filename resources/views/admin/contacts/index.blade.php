<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
@extends('adminlte::page')

@section('title', 'Secretariat Inbox | BACTA Admin')

{{-- 🚀 ল্যারাভেলের ডিফল্ট ডাইনামিক প্লাগইন গেটওয়ে অন করা হলো ভাই --}}
@section('plugins.DataTables', true)

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 5px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #0F172A; font-size: 22px;">
            <i class="fas fa-envelope-open-text text-[#0284C7] mr-1"></i> Secretariat Inbox Queries
        </h1>
        <span style="font-size: 11px; background: #EFF6FF; color: #1E40AF; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-family: 'Poppins';">AUDIT SECURE GATE</span>
    </div>
@endsection

@section('content')
<style>
    .bacta-admin-wrapper { font-family: 'Poppins', sans-serif; background-color: #F8FAFC; width: 100%; box-sizing: border-box; }
    .registry-split-layout { display: flex; gap: 25px; align-items: flex-start; width: 100%; }
    
    /* বাম পাশের ছোট ট্র্যাকিং কলাম উইজেট */
    .registry-column-left { width: 28%; flex-shrink: 0; }
    /* ডান পাশের মূল ডাটাটেবিল কলাম উইজেট */
    .registry-column-right { width: 72%; flex-grow: 1; }

    .metric-card { background: #ffffff; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(148, 163, 184, 0.02); padding: 24px; position: relative; box-sizing: border-box; }
    .metric-card-header { font-size: 14px; font-weight: 700; color: #0F172A; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 0.25px; }
    
    /* ওফিসিয়াল ডাটাটেবিল প্রিমিয়াম কাস্টমাইজেশন সিএসএস ভাই */
    #bactaInboxTable_wrapper .dataTables_filter input { height: 36px; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0 10px; outline: none; background: #F8FAFC; font-size: 13px; color: #0F172A; transition: all 0.3s ease; }
    #bactaInboxTable_wrapper .dataTables_filter input:focus { border-color: #0284C7; background: #ffffff; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1); }
    #bactaInboxTable_wrapper .dataTables_length select { height: 36px; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0 8px; outline: none; background: #ffffff; }
    .page-item.active .page-link { background-color: #0284C7 !important; border-color: #0284C7 !important; color: #ffffff !important; }
    .page-link { color: #334155 !important; font-weight: 600; font-size: 12.5px; border-radius: 4px !important; margin: 0 2px; }

    .btn-metric-delete { width: 34px; height: 34px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; background: #FEF2F2; color: #EF4444; border: 1px solid #FEE2E2; cursor: pointer; transition: all 0.2s ease; }
    .btn-metric-delete:hover { background: #EF4444; color: #ffffff; }
    @media (max-width: 1024px) { .registry-split-layout { flex-direction: column; } .registry-column-left, .registry-column-right { width: 100%; } }
</style>

<div class="bacta-admin-wrapper">
    
    @if(session('success'))
        <div id="metricSuccessBanner" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: #ffffff; padding: 14px 18px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15); transition: all 0.5s ease;">
            <i class="fas fa-check-circle" style="font-size: 16px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="registry-split-layout">
        
        <!-- ==========================================
             🔒 বাম কলাম: ইনবক্স মেট্রিকেস সামারি উইজেট
             ========================================== -->
        <div class="registry-column-left">
            <div class="metric-card" style="background: linear-gradient(135deg, #ffffff 0%, #F8FAFC 100%);">
                <div class="metric-card-header">
                    <i class="fas fa-chart-pie text-[#0284C7]"></i> Inbox Summary
                </div>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="background: #ffffff; border: 1px solid #E2E8F0; padding: 16px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <div style="font-size: 12px; font-weight: 600; color: #64748B; text-transform: uppercase;">Total Queries</div>
                            <div style="font-size: 24px; font-weight: 800; color: #0F172A; margin-top: 4px;">{{ $messages->count() }}</div>
                        </div>
                        <div style="width: 44px; height: 44px; background: #EFF6FF; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;"><i class="fas fa-inbox"></i></div>
                    </div>
                    <div style="font-size: 11.5px; color: #94A3B8; font-weight: 500; line-height: 1.5; padding: 0 4px;">
                        <i class="fas fa-shield-alt text-emerald-500 mr-1"></i> Database is fully protected under Honeypot Anti-Spam Gate Shield.
                    </div>
                </div>
            </div>
        </div>
        <!-- ==========================================
             🚀 ডান কলাম: সেন্ট্রাল ইনবক্স ডাটাটেবিল আর্কাইভ রেজিস্ট্রি
             ========================================== -->
        <div class="registry-column-right">
            <div class="metric-card" style="padding: 24px; overflow: hidden;">
                <div class="metric-card-header" style="margin-bottom: 25px; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-database text-[#1E40AF]"></i> 
                        <span>Central Communications Register</span>
                    </div>
                </div>

                <div class="table-responsive" style="width: 100%;">
                    <table id="bactaInboxTable" class="table table-hover table-striped" style="width: 100%; min-width: 680px; font-size: 13px; border-bottom: 1px solid #E2E8F0;">
                        <thead>
                            <tr style="background: #F8FAFC; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px;">
                                <th style="width: 50px; text-align: center; vertical-align: middle;">SL</th>
                                <th style="vertical-align: middle;">Doctor Information</th>
                                <th style="width: 140px; vertical-align: middle;">Mobile Contact</th>
                                <th style="vertical-align: middle;">Transmitted Message Body</th>
                                <th style="width: 120px; vertical-align: middle;">Timestamp</th>
                                <th style="width: 70px; text-align: center; vertical-align: middle;">Wipe</th>
                            </tr>
                        </thead>
                        <tbody style="color: #334155; font-weight: 500;">
                            @foreach($messages as $key => $row)
                            <tr>
                                <td style="text-align: center; vertical-align: middle; color: #94A3B8; font-weight: 700;">{{ $key + 1 }}</td>
                                <td style="vertical-align: middle;">
                                    <div style="font-weight: 700; color: #0F172A; font-size: 13.5px;"><i class="fas fa-user-md text-slate-400 mr-1"></i> {{ $row->name }}</div>
                                    <div style="font-size: 11px; color: #64748B; margin-top: 2px;"><i class="fas fa-envelope text-slate-400 mr-1"></i> {{ $row->email }}</div>
                                </td>
                                <td style="vertical-align: middle; font-weight: 600; color: #0F172A;">
                                    <i class="fas fa-phone text-slate-400 mr-1" style="font-size: 11px;"></i> {{ $row->mobile }}
                                </td>
                                <td style="vertical-align: middle; max-width: 250px; white-space: normal; word-break: break-word; color: #475569; font-size: 12.5px; line-height: 1.5;">
                                    {{ $row->message }}
                                </td>
                                <td style="vertical-align: middle; font-size: 11.5px; color: #64748B;">
                                    <div style="font-weight: 600; color: #334155;">{{ $row->created_at->format('d M Y') }}</div>
                                    <div style="font-size: 10px; color: #94A3B8; margin-top: 1px;"><i class="far fa-clock"></i> {{ $row->created_at->format('h:i A') }}</div>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    {{-- 🚨 ওয়ান-ক্লিক ডাটাবেজ পার্মানেন্ট ডিলিট গেটওয়ে ভাই --}}
                                    <form action="{{ route('admin.contacts.delete', $row->id) }}" method="POST" onsubmit="return confirm('🚨 DANGER: This will permanently wipe this doctor message from central register database log! Are you absolutely sure?');" style="display: inline-block; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-metric-delete" title="Permanently Wipe Log"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> {{-- .registry-split-layout ক্লোজিং --}}
</div> {{-- .bacta-admin-wrapper ক্লোজিং --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 🔒 ১. ওফিসিয়াল AdminLTE ডাটাটেবিল বিল্ট-ইন ফিল্টার ইনিশিয়ালাইজার ভাই (ফাস্ট ও সিকিউর রেসপন্স)
        if ($.fn.DataTable) {
            $('#bactaInboxTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false, // লেটেস্ট মেসেজ ডাইনামিক সবার ওপরে লকড থাকবে
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 7, // প্রতি পেজে ৭টি করে প্রফেশনাল রো দেখাবে ভাই
                "lengthMenu": [7, 10, 25, 50]
            });
        }

        // ২. ৩ সেকেন্ড পর সবুজ সাকসেস ব্যানার অটো-হাইড করার মেকানিজম
        let successBanner = document.getElementById('metricSuccessBanner');
        if (successBanner) {
            setTimeout(function() {
                successBanner.style.opacity = '0';
                successBanner.style.transform = 'translateY(-15px)';
                setTimeout(function() { successBanner.remove(); }, 500);
            }, 3000); // 🎯 ঠিক ৩ সেকেন্ড পর অটো-হাইড লকড ভাই
        }
    });
</script>
@endsection
