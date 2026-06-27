@extends('layouts.app')

@section('title', 'Congenital Heart Surgery Statistics in Bangladesh | BACTA')

@section('content')
<!-- 🚀 ১. মোবাইল ফ্রেন্ডলি এবং আজীবন নো-ভার্টিকাল-স্ক্রল লকিং সিএসএস ইঞ্জিন ভাই -->
<style>
    .stats-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 40px 0; box-sizing: border-box; }
    .stats-container { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 20px; box-sizing: border-box; }
    
    .premium-filter-bar { background: #ffffff; padding: 16px 24px; border-radius: 14px; border: 1px solid #E2E8F0; box-shadow: 0 4px 20px -5px rgba(148, 163, 184, 0.05); margin-bottom: 25px; display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 15px; width: 100%; box-sizing: border-box; }
    .filter-label-text { font-size: 13.5px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 6px; margin: 0; }
    .filter-dropdown-wrapper { display: flex; align-items: center; gap: 10px; justify-content: flex-end; }
    
    .smart-year-dropdown { background-color: #ffffff; border: 2px solid #E2E8F0; border-radius: 8px; color: #0F172A; font-size: 14px; font-weight: 700; height: 42px; padding: 0 35px 0 15px; width: 220px; outline: none; cursor: pointer; transition: all 0.25s ease; background-image: url("data:image/svg+xml,%3csvg xmlns='http://w3.org' fill='none' viewBox='0 0 24 24' stroke='%23475569' stroke-width='2.5'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 12px center; background-size: 14px; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .smart-year-dropdown:focus { border-color: #0284C7; box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1); }
    
    /* 👑 🔒 আপনার ওয়ান-লাইন লকড নো-স্ক্রল ফিক্স: ভেতরের হাইট বা ওভারফ্লো আজীবনের জন্য উইথআউট-স্ক্রল মোডে ফোর্সড লক ভাই */
    .spreadsheet-display-panel { background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.06); overflow: visible !important; height: auto !important; max-height: none !important; width: 100%; box-sizing: border-box; }
    
    /* ⚡ জাদুকরী নো-স্ক্রল কন্টেইনার নোড: ডানে-বামে টাচ স্ক্রল অন থাকবে কিন্তু নিচে-ওপরে স্ক্রল আজীবনের জন্য ভ্যানিশ ভাই */
    .excel-scroll-frame { overflow-x: auto !important; overflow-y: visible !important; height: auto !important; max-height: none !important; width: 100%; -webkit-overflow-scrolling: touch; }
    .frontend-excel-table { font-size: 13px; min-width: 1000px; margin: 0; border-collapse: separate; border-spacing: 0; width: 100%; text-align: center; }
    
    /* মেইন ওয়েবসাইট স্ক্রল করার সময় কলাম হেডার এবং হাসপাতালের নাম স্ক্রিনের সাথে পিক্সেল-পারফেক্ট স্টিকি লক থাকবে */
    .frontend-excel-table thead th { position: sticky; top: 0; background: #0F172A !important; color: #ffffff !important; font-weight: 700; padding: 14px 10px; z-index: 10; border: 1px solid #1E293B !important; vertical-align: middle; text-transform: uppercase; font-size: 11.5px; letter-spacing: 0.5px; }
    .frontend-excel-table thead th.freeze-corner { left: 0; z-index: 12; background: #0F172A !important; border-right: 3px solid #0284C7 !important; }
    .frontend-excel-table thead th.total-header-col { right: 0; position: sticky; z-index: 11; background: #1E3A8A !important; border-left: 3px solid #1E3A8A !important; }
    
    .frontend-excel-table tbody tr td.freeze-col { position: sticky; left: 0; background: #ffffff !important; font-weight: 700; color: #0F172A; text-align: left; padding: 12px 16px; z-index: 5; border-right: 3px solid #0284C7 !important; border-bottom: 1px solid #E2E8F0 !important; width: 260px; max-width: 260px; box-shadow: 4px 0 8px -3px rgba(0,0,0,0.03); }
    .frontend-excel-table tbody tr:hover td.freeze-col { background: #F8FAFC !important; color: #0284C7; }
    
    .frontend-excel-table tbody tr td.row-total-col { position: sticky; right: 0; background: #EFF6FF !important; font-weight: 800; color: #1E40AF; text-align: center; z-index: 4; border-left: 3px solid #3B82F6 !important; border-bottom: 1px solid #E2E8F0 !important; font-size: 13.5px; }
    .frontend-excel-table tfoot tr td.grand-total-row { background: #1E293B !important; color: #ffffff !important; font-weight: 800; padding: 14px 10px; border-top: 2px solid #0F172A !important; font-size: 13.5px; }
    .frontend-excel-table tfoot tr td.grand-total-row.freeze-col { position: sticky; left: 0; background: #0F172A !important; color: #ffffff !important; z-index: 6; }
    .frontend-excel-table tfoot tr td.grand-total-row.row-total-col { position: sticky; right: 0; background: #1E3A8A !important; color: #ffffff !important; z-index: 6; border-left: 3px solid #38BDF8 !important; }
    
    .frontend-excel-table tbody tr td { padding: 10px 6px; vertical-align: middle; border: 1px solid #E2E8F0 !important; font-weight: 600; color: #334155; }
    .frontend-excel-table tbody tr:hover td:not(.freeze-col):not(.row-total-col) { background: #EFF6FF; color: #1E40AF; }

    @media (max-width: 768px) {
        .stats-container { padding: 0 12px; }
        .premium-filter-bar { flex-direction: column; align-items: flex-start; padding: 14px 18px; gap: 12px; }
        .filter-dropdown-wrapper { width: 100%; justify-content: space-between; }
        .smart-year-dropdown { width: 100%; max-width: 100%; }
        .filter-label-text { font-size: 12px; }
    }
</style>

<header class="bg-[#0F172A] relative overflow-hidden py-12 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-pink-500 uppercase block mb-2">Research & Publications</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">Congenital Heart Surgery Statistics</h1>
        </div>
    </div>
</header>

<div class="stats-body-wrapper">
    <div class="stats-container">
        
        <!-- ==========================================
             👑 🔒 আপনার মেগা ফিক্স: মোবাইল ও ডেক্সটপ দুই স্ক্রিনেই ড্রপডাউনটি এখন অটো-সাইজিং ম্যাপড ভাই
             ========================================== -->
        <div class="premium-filter-bar">
            <h4 class="filter-label-text">
                <i class="fa-solid fa-chart-line text-pink-500" style="font-size: 13px;"></i> 
                National Congenital Surgical Data Dashboard
            </h4>
            
            <div class="filter-dropdown-wrapper">
                <label for="frontendYearSelectDropdown" class="mb-0 text-slate-500 font-bold text-xs uppercase tracking-wider hidden sm:inline-block">Select Year:</label>
                <select id="frontendYearSelectDropdown" class="smart-year-dropdown">
                    @forelse($years as $index => $year)
                        <option value="{{ $year }}" @if($index === 0) selected @endif>
                            Statistics Year {{ $year }}
                        </option>
                    @empty
                        <option value="">No Data Records</option>
                    @endforelse
                </select>
            </div>
        </div>

        <!-- ==========================================
             🚀 মেইন ডাটা শীট পোর্টাল (ফোনে এবং ট্যাবে অত্যন্ত মসৃণ সোয়াইপ স্ক্রল হবে ভাই)
             ========================================== -->
        <div class="spreadsheet-display-panel">
            <div class="card-header bg-white py-3 flex justify-between items-center" style="border-bottom: 1px solid #F1F5F9;">
                <h3 class="card-title" style="font-size: 14px; font-weight: 800; color: #0F172A; margin: 0; padding-top: 4px;">
                    <i class="fa-solid fa-circle-nodes text-pink-500 mr-1"></i> Hospital Registries Data Sheet: <span id="dynamicYearTitleHeading">---</span>
                </h3>
            </div>
            
            <div class="card-body p-0">
                <div class="excel-scroll-frame">
                    <table class="table frontend-excel-table">
                        <thead>
                            <tr>
                                <th class="freeze-corner">Hospital Institute Registry Name</th>
                                <th>ASD</th>
                                <th>VSD</th>
                                <th>TOF / ICR</th>
                                <th>PDA</th>
                                <th class="total-header-col">Hospitals Total</th>
                            </tr>
                        </thead>
                        <tbody id="frontendCongenitalTableBody">
                            @foreach($hospitals as $hospital)
                                <tr class="frontend-congenital-row" id="row_hospital_{{ $hospital->id }}" data-hospital-id="{{ $hospital->id }}">
                                    <td class="freeze-col">
                                        <i class="fa-solid fa-circle-h text-primary mr-1.5" style="font-size: 11px; opacity:0.6;"></i>
                                        {{ $hospital->name }}
                                    </td>
                                    <td id="cell_{{ $hospital->id }}_asd">0</td>
                                    <td id="cell_{{ $hospital->id }}_vsd">0</td>
                                    <td id="cell_{{ $hospital->id }}_tof">0</td>
                                    <td id="cell_{{ $hospital->id }}_pda">0</td>
                                    <td class="row-total-col" id="frontend_hospital_total_{{ $hospital->id }}">0</td>
                                </tr>
                            @endforeach
                            
                            <tr id="allZeroPlaceholderRow" style="display: none;">
                                <td colspan="6" class="text-center py-5 text-muted font-weight-bold" style="background-color: #F8FAFC;">
                                    <i class="fa-solid fa-chart-bar-slash mr-1 text-danger"></i> No congenital surgical data records found for this year.
                                </td>
                            </tr>
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td class="grand-total-row freeze-col text-left" style="padding-left: 18px;">
                                    <i class="fa-solid fa-calculator mr-1.5" style="font-size: 11px; color:#38BDF8;"></i> TOTAL
                                </td>
                                <td class="grand-total-row" id="frontend_total_asd">0</td>
                                <td class="grand-total-row" id="frontend_total_vsd">0</td>
                                <td class="grand-total-row" id="frontend_total_tof">0</td>
                                <td class="grand-total-row" id="frontend_total_pda">0</td>
                                <td class="grand-total-row row-total-col" id="frontend_ultimate_grand_total">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div> {{-- .stats-container-end ভাই --}}
</div> {{-- .stats-body-wrapper-end ভাই --}}
<!-- ==========================================
     👑 ৩. ওয়ান-ক্লিক ড্রপডাউন এবং ফিক্সড জেসন ইনডেক্স ড্রাইভার ইঞ্জিন ভাই (ডেটা ১০০% লাইভ হবে)
     ========================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ক) ল্যারাভেলের সেন্ট্রাল মেমোরি ডাটাপ্যাক সরাসরি জাভাস্ক্রিপ্ট জেসন নোডে লক ভাই
        const centralSurgeryMatrixDb = @json($allRecords);
        const hospitalsDataList = @json($hospitals);
        
        const yearDropdownSelect = document.getElementById('frontendYearSelectDropdown');
        const dynamicTitleHeading = document.getElementById('dynamicYearTitleHeading');

        // 🎯 ওয়ান-ট্যাপ ফাস্ট রেন্ডারিং এবং জিরো-রো ফিল্টারিং মেথড ভাই
        function renderSelectedYearStatistics(year) {
            if (!year) return;

            // ওয়ান-ট্যাপ স্ক্রিন আপডেট: হেডিংয়ে সিলেক্ট করা বছর অটো সিঙ্ক ভাই
            dynamicTitleHeading.textContent = year;

            let ultimateGrandTotal = 0;
            let totalASD = 0, totalVSD = 0, totalTOF = 0, totalPDA = 0;
            let totalVisibleRowsCount = 0;

            hospitalsDataList.forEach(function(hospital) {
                let hospitalId = hospital.id;
                let asd = 0, vsd = 0, tof = 0, pda = 0;

                // 🔍 👑 জাদুকরী ওয়ান-লাইন ফিক্স: ল্যারাভেল groupBy অ্যারের প্রথম উপাদান সরাসরি রিড লজিক ভাই (ডেটা লাইভ হবে)
                if (centralSurgeryMatrixDb[year] && 
                    centralSurgeryMatrixDb[year][hospitalId] && 
                    centralSurgeryMatrixDb[year][hospitalId][0]) {
                    
                    let recordObj = centralSurgeryMatrixDb[year][hospitalId][0];
                    
                    asd = parseInt(recordObj.asd_count) || 0;
                    vsd = parseInt(recordObj.vsd_count) || 0;
                    tof = parseInt(recordObj.tof_count) || 0;
                    pda = parseInt(recordObj.pda_count) || 0;
                }

                let hospitalRowTotal = asd + vsd + tof + pda;
                let rowElement = document.getElementById(`row_hospital_${hospitalId}`);

                // 👑 🔒 আপনার মেগা শর্ত: মোট যোগফল ০ হলে হাসপাতালটি স্ক্রিন থেকে ভ্যানিশ হয়ে যাবে ভাই!
                if (hospitalRowTotal === 0) {
                    if (rowElement) rowElement.style.display = 'none';
                } else {
                    if (rowElement) rowElement.style.display = '';
                    totalVisibleRowsCount++; // একটিভ রো কাউন্টার ভাই

                    // বক্সে বক্সে লাইভ সংখ্যা পুশ ভাই
                    document.getElementById(`cell_${hospitalId}_asd`).textContent = asd;
                    document.getElementById(`cell_${hospitalId}_vsd`).textContent = vsd;
                    document.getElementById(`cell_${hospitalId}_tof`).textContent = tof;
                    document.getElementById(`cell_${hospitalId}_pda`).textContent = pda;
                    document.getElementById(`frontend_hospital_total_${hospitalId}`).textContent = hospitalRowTotal;

                    // গ্লোবাল ভার্টিকাল যোগফল সিঙ্ক ভাই
                    totalASD += asd;
                    totalVSD += vsd;
                    totalTOF += tof;
                    totalPDA += pda;
                    ultimateGrandTotal += hospitalRowTotal;
                }
            });

            // যদি কোনো নির্দিষ্ট বছরে সব হাসপাতালের ডাটা ০ থাকে তবে নোটিশ শো হবে ভাই
            const placeholderRow = document.getElementById('allZeroPlaceholderRow');
            if (totalVisibleRowsCount === 0) {
                if (placeholderRow) placeholderRow.style.display = '';
            } else {
                if (placeholderRow) placeholderRow.style.display = 'none';
            }

            // ওয়ান-ট্যাপ স্ক্রিন আপডেট: টেবিলের একদম নিচে ভার্টিকাল ফুটার টোটাল শো ভাই
            document.getElementById('frontend_total_asd').textContent = totalASD;
            document.getElementById('frontend_total_vsd').textContent = totalVSD;
            document.getElementById('frontend_total_tof').textContent = totalTOF;
            document.getElementById('frontend_total_pda').textContent = totalPDA;
            document.getElementById('frontend_ultimate_grand_total').textContent = ultimateGrandTotal;
        }

        // 🎯 খ) ওয়ান-ক্লিক আল্ট্রা-স্মার্ট ড্রপডাউন লিসেনার ড্রাইভার ভাই
        if (yearDropdownSelect) {
            yearDropdownSelect.addEventListener('change', function() {
                let targetYear = this.value;
                renderSelectedYearStatistics(targetYear);
            });
        }

        // 🎯 গ) ডিফল্ট লেটেস্ট ইয়ার বুট নোড ভাই (ডাটাবেজের সর্বশেষ বছরটি প্রথমবার অটো লোড হবে)
        if (yearDropdownSelect) {
            let defaultYear = yearDropdownSelect.value;
            renderSelectedYearStatistics(defaultYear);
        }
    });
</script>

@endsection
