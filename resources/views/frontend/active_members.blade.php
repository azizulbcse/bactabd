@extends('layouts.app')

@section('title', 'Active Members Directory | BACTA Bangladesh')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#0284C7] uppercase block mb-2">Registered Registry</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">Active Members Directory</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">Active Directory</span>
            </div>
        </div>
    </header>

    <!-- 🚀 ২. আল্ট্রা-মডার্ন লাইভ সার্চ এবং রেসপন্সিভ ডিরেক্টরি টেবিল থিম (NHCS স্ট্যান্ডার্ড) -->
    <style>
        .modern-body-wrapper {
            background-color: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 50px 0;
        }

        .nhcs-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* প্রফেশনাল গর্জিয়াস লাইভ সার্চ বার উইজেট */
        .search-box-wrapper {
            max-width: 500px;
            margin: 0 auto 40px;
            position: relative;
        }

        .search-input-field {
            width: 100%;
            height: 48px;
            background: #ffffff;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            padding: 0 20px 0 45px;
            font-size: 14px;
            font-weight: 500;
            color: #0F172A;
            outline: none;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .search-input-field:focus {
            border-color: #0284C7;
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.1);
        }

        .search-icon-inside {
            position: absolute;
            left: 16px;
            top: 16px;
            color: #94A3B8;
            font-size: 16px;
        }

        /* ডাইনামিক শর্ট নেম ব্যাজ সিএইচটিবি/এনএইচসিএস স্টাইল */
        .active-short-badge {
            font-size: 10px;
            background: linear-gradient(135deg, #0284C7 0%, #1E40AF 100%);
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
            margin-left: 6px;
        }
    </style>
<div class="modern-body-wrapper">
    <div class="nhcs-container">

        {{-- আপনার NHCS স্টাইলের সেই চিরচেনা ইনার সাব-হেডার কন্টেন্ট --}}
        <div class="nhcs-page-header" style="text-align: center; margin-bottom: 40px; border-bottom: 2px solid #E2E8F0; padding-bottom: 30px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #0284C7; margin: 0 0 10px 0; text-transform: uppercase;">সাধারণ সক্রিয় সদস্য ডিরেক্টরি</h2>
            <p style="color: #64748B; font-size: 15px; margin: 0;">Welcome to Our Society - Bangladesh Advanced Cardiovascular Track Association</p>
        </div>

        {{-- 🔍 আল্ট্রা-স্মার্ট লাইভ সার্চ বার জোন --}}
        <div class="search-box-wrapper">
            <i class="fas fa-search search-icon-inside"></i>
            <input type="text" id="memberSearchInput" class="search-input-field" placeholder="Type doctor name, designation, or workplace to filter...">
        </div>

        {{-- ডিরেক্টরি রেজাল্ট টেবিল রেসপনসিভ কন্টেইনার --}}
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.03); overflow: hidden; width: 100%;">
            <div style="overflow-x: auto; width: 100%; -webkit-overflow-scrolling: touch;">
                <table id="activeMembersTable" style="width: 100%; min-width: 950px; border-collapse: collapse; text-align: left; font-size: 13.5px;">
                    <thead>
                        <tr style="background: #F8FAFC; border-bottom: 2px solid #E2E8F0; color: #1E40AF; font-weight: 700; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px;">
                            <th style="padding: 16px 20px; width: 60px; text-align: center;">SL</th>
                            <th style="padding: 16px 20px; width: 80px; text-align: center;">PHOTO</th> {{-- 🎯 এই কলামের অপশন শিরোনামটিই মিসিং ছিল ভাই --}}
                            <th style="padding: 16px 20px;">Doctor Full Name</th>
                            <th style="padding: 16px 20px;">Constitutional Title</th>
                            <th style="padding: 16px 20px;">Medical Designation</th>
                            <th style="padding: 16px 20px;">Hospital Workplace Institution</th>
                        </tr>
                    </thead>
                    <tbody style="color: #334155; font-weight: 500;">
                        @forelse($activeMembers as $key => $row)
                        <tr class="searchable-member-row" style="border-bottom: 1px solid #E2E8F0; transition: all 0.2s ease;">
                            <td style="padding: 16px 20px; text-align: center; color: #94A3B8; font-weight: 700;">{{ $key + 1 }}</td>
                            
                            {{-- 🎯 ফটো শিরোনামের সোজা আলাদা সেল কলাম ফিক্সড ভাই --}}
                            <td style="padding: 16px 20px; text-align: center;">
                                @if($row->member_pic)
                                    <img src="{{ asset('storage/' . $row->member_pic) }}" class="rounded-circle" style="width: 38px; height: 38px; object-fit: cover; border-radius: 50%; border: 2px solid #0284C7; display: inline-block;" loading="lazy">
                                @else
                                    <div style="width: 38px; height: 38px; border-radius: 50%; background: #F1F5F9; display: inline-flex; align-items: center; justify-content: center; color: #94A3B8; font-size: 15px; border: 1px dashed #CBD5E1; margin: 0 auto;"><i class="fas fa-user-md"></i></div>
                                @endif
                            </td>
                            
                            <td style="padding: 16px 20px; font-weight: 700; color: #0F172A; font-size: 14.5px;">
                                <span class="doc-search-name">{{ $row->name }}</span>
                            </td>
                            <td style="padding: 16px 20px; color: #1E40AF; font-weight: 600;">{{ $row->bactaDesignation->title ?? 'General Member' }}</td>
                            <td style="padding: 16px 20px; color: #64748B;">{{ $row->medicalDesignation->title ?? 'N/A' }}</td>
                            
                            {{-- 💡 হাসপাতালের বড় নাম এবং শর্ট নাম উইজেট জোড়া ট্যাগ সিঙ্ক --}}
                            <td style="padding: 16px 20px; color: #334155; font-weight: 600;">
                                <i class="fas fa-university text-[#0284C7]" style="color: #0284C7; margin-right: 4px;"></i> 
                                <span class="hospital-search-name">{{ $row->hospital->name ?? 'N/A' }}</span>
                                @if($row->hospital->short_name)
                                    <span class="active-short-badge">({{ $row->hospital->short_name }})</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr id="emptySearchRowGlobal">
                            <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600; font-size: 15px;">
                                <i class="fas fa-folder-open d-block mb-2" style="font-size: 30px; display: block; margin-bottom: 10px;"></i>
                                No active registered members found in the central registry system.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div> {{-- .nhcs-container ক্লোজিং --}}
</div> {{-- .modern-body-wrapper ক্লোজিং --}}
{{-- 🚀 আল্ট্রা-ফাস্ট নেティブ লাইভ সার্চ ফিল্টার জাভাস্ক্রিপ্ট ইঞ্জিন --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.getElementById('memberSearchInput');
        let tableRows = document.querySelectorAll('.searchable-member-row');
        let tableBody = document.querySelector('#activeMembersTable tbody');

        // যদি আগে থেকে কোনো ডাটা না থাকে, তবে সার্চ ইঞ্জিন রান করার দরকার নেই
        if (!searchInput || tableRows.length === 0) return;

        searchInput.addEventListener('keyup', function(e) {
            let query = e.target.value.toLowerCase().trim();
            let visibleRowsCount = 0;

            // বিদ্যমান নো-রেজাল্ট অ্যালার্ট বা পুরোনো কোনো ডামি মেসেজ থাকলে তা সাফ করবে
            let existingAlert = document.getElementById('bacta-no-search-alert');
            if (existingAlert) existingAlert.remove();

            tableRows.forEach(row => {
                // রো-এর ভেতরের টেক্সট কন্টেন্ট রিড করা হলো ভাই
                let textContent = row.textContent.toLowerCase();

                if (textContent.includes(query)) {
                    row.style.display = ''; // ডাটা মিললে রো শো করবে
                    visibleRowsCount++;
                    
                    // ম্যাচ হওয়া লেখার ব্যাকগ্রাউন্ডে হালকা ইফেক্ট অ্যানিমেশন যোগ করা হলো ভাই
                    row.style.backgroundColor = query !== '' ? 'rgba(2, 132, 199, 0.02)' : '';
                } else {
                    row.style.display = 'none'; // না মিললে রো হাইড হবে
                    row.style.backgroundColor = '';
                }
            });

            // 💡 যদি টাইপ করা লেখার সাথে কোনো ডাক্তারের নাম বা হাসপাতালের শর্ট নেম না মেলে
            if (visibleRowsCount === 0) {
                let noResultRow = document.createElement('tr');
                noResultRow.id = 'bacta-no-search-alert';
                noResultRow.innerHTML = `
                    <td colspan="6" style="padding: 50px; text-align: center; color: #94A3B8; font-weight: 600; font-size: 14px; background: #ffffff; animate__animated animate__fadeIn">
                        <i class="fas fa-search-minus" style="font-size: 32px; color: #CBD5E1; display: block; margin-bottom: 12px;"></i>
                        <span>No registered members match your search criteria "<b>${e.target.value}</b>". Please double-check spelling.</span>
                    </td>
                `;
                tableBody.appendChild(noResultRow);
            }
        });

        // টেবিল রো-এর ওপর মাউস নিলে চমৎকার লাইভ ব্যাকগ্রাউন্ড গ্লো ইফেক্ট সিঙ্ক ভাই
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#F8FAFC';
            });
            row.addEventListener('mouseleave', function() {
                if (searchInput.value.trim() === '') {
                    this.style.backgroundColor = '';
                } else {
                    this.style.backgroundColor = 'rgba(2, 132, 199, 0.02)';
                }
            });
        });
    });
</script>

@endsection
