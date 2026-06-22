@extends('layouts.app')

@section('title', 'Cardiac Surgery Statistics in Bangladesh | BACTA')

@section('content')
<!-- 🚀 ১. মোবাইল ফ্রেন্ডলি টাচ-স্ক্রল এবং অটো-লেটেস্ট ইয়ার গ্লসি সিএসএস ভাই -->
<style>
    .stats-body-wrapper { background-color: #F8FAFC; font-family: 'Poppins', sans-serif; width: 100%; padding: 40px 0; }
    .stats-container { width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 16px; box-sizing: border-box; }
    
    /* 👑 বাম পাশের ওয়ান-ক্লিক ইয়ারলি ট্যাব গ্লসি ডিজাইন ভাই */
    .year-sidebar-nav { display: flex; flex-direction: column; gap: 10px; background: #ffffff; padding: 18px; border-radius: 16px; border: 1px solid #E2E8F0; box-shadow: 0 4px 20px -5px rgba(148, 163, 184, 0.05); position: sticky; top: 20px; }
    .year-tab-btn { display: flex; align-items: center; justify-content: space-between; padding: 12px 18px; border-radius: 10px; border: 1px solid #E2E8F0; background: #ffffff; color: #475569; font-weight: 700; font-size: 13.5px; text-align: left; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; width: 100%; box-sizing: border-box; }
    .year-tab-btn:hover { border-color: #CBD5E1; background: #F8FAFC; color: #1E40AF; transform: translateX(4px); }
    .year-tab-btn.active-year-node { background: linear-gradient(135deg, #1E40AF 0%, #0284C7 100%); color: #ffffff !important; border-color: #1E40AF; box-shadow: 0 10px 20px -5px rgba(30, 64, 175, 0.25); }
    
    /* 👑 🔒 আপনার শর্ত: টেবিল ভেতরে নিচের দিকে স্ক্রল হবে না, পুরোটা সোজা নিচে নেমে যাবে */
    .spreadsheet-display-panel { background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.06); overflow: hidden; height: auto; }
    
    /* ⚡ জাদুকরী ওল্ড স্ক্রল রিমুভাল নোড: height এবং overflow-y সম্পূর্ণ ওয়ান-লাইন রিলিজড ভাই */
    .excel-scroll-frame { overflow-x: auto; overflow-y: visible; width: 100%; -webkit-overflow-scrolling: touch; }
    .frontend-excel-table { font-size: 13px; min-width: 1200px; margin: 0; border-collapse: separate; border-spacing: 0; width: 100%; text-align: center; }
    
    /* 🔒 মেইন পেজ স্ক্রল করার সময় কলাম হেডার এবং হাসপাতালের নাম স্ক্রিনের সাথে পিক্সেল-পারফেক্ট লক থাকবে */
    .frontend-excel-table thead th { position: sticky; top: 0; background: #0F172A !important; color: #ffffff !important; font-weight: 700; padding: 14px 10px; z-index: 10; border: 1px solid #1E293B !important; vertical-align: middle; text-transform: uppercase; font-size: 11.5px; letter-spacing: 0.5px; }
    .frontend-excel-table thead th.freeze-corner { left: 0; z-index: 12; background: #0F172A !important; border-right: 3px solid #0284C7 !important; }
    .frontend-excel-table thead th.total-header-col { right: 0; position: sticky; z-index: 11; background: #1E3A8A !important; border-left: 3px solid #1E3A8A !important; }
    
    .frontend-excel-table tbody tr td.freeze-col { position: sticky; left: 0; background: #ffffff !important; font-weight: 700; color: #0F172A; text-align: left; padding: 12px 16px; z-index: 5; border-right: 3px solid #0284C7 !important; border-bottom: 1px solid #E2E8F0 !important; width: 260px; max-width: 260px; box-shadow: 4px 0 8px -3px rgba(0,0,0,0.03); }
    .frontend-excel-table tbody tr:hover td.freeze-col { background: #F8FAFC !important; color: #0284C7; }
    
    .frontend-excel-table tbody tr td.row-total-col { position: sticky; right: 0; background: #EFF6FF !important; font-weight: 800; color: #1E40AF; text-align: center; z-index: 4; border-left: 3px solid #3B82F6 !important; border-bottom: 1px solid #E2E8F0 !important; font-size: 13.5px; }
    .frontend-excel-table tfoot tr td.grand-total-row { background: #1E293B !important; color: #ffffff !important; font-weight: 800; padding: 14px 10px; border-top: 2px solid #0F172A !important; font-size: 13.5px; }
    
    /* ফুটারের হরাইজন্টাল এবং ভার্টিকাল টোটাল লক ট্র্যাকার */
    .frontend-excel-table tfoot tr td.grand-total-row.freeze-col { position: sticky; left: 0; background: #0F172A !important; color: #ffffff !important; z-index: 6; }
    .frontend-excel-table tfoot tr td.grand-total-row.row-total-col { position: sticky; right: 0; background: #1E3A8A !important; color: #ffffff !important; z-index: 6; border-left: 3px solid #38BDF8 !important; }
    
    .frontend-excel-table tbody tr td { padding: 10px 6px; vertical-align: middle; border: 1px solid #E2E8F0 !important; font-weight: 600; color: #334155; }
    .frontend-excel-table tbody tr:hover td:not(.freeze-col):not(.row-total-col) { background: #EFF6FF; color: #1E40AF; }

    /* 📱 মোবাইল স্ক্রিনের জন্য ইন্টেলিজেন্ট টাচ রেসপন্সিভ ওভাররাইড লেআউট ভাই */
    @media (max-width: 991px) {
        .year-sidebar-nav { position: relative; top: 0; display: flex; flex-direction: row; overflow-x: auto; padding: 12px; border-radius: 12px; margin-bottom: 20px; -webkit-overflow-scrolling: touch; }
        .year-tab-btn { white-space: nowrap; width: auto; padding: 10px 16px; }
        .year-tab-btn i { display: none; }
    }
</style>

<header class="bg-[#0F172A] relative overflow-hidden py-12 border-b border-slate-800 w-full text-left">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-xs font-bold tracking-[0.2em] text-[#38BDF8] uppercase block mb-2">Research & Publications</span>
            <h1 class="text-2xl lg:text-3xl font-black tracking-tight text-white">Cardiac Surgery Statistics in Bangladesh</h1>
        </div>
    </div>
</header>
<div class="stats-body-wrapper">
    <div class="stats-container">
        <div class="row">
            
            <!-- ==========================================
                 👑 🔒 বাম পাশের ডাইনামিক সাব-মেনু: ডাটাবেজের সালগুলো এখানে অটো-বাটন হবে ভাই (মোবাইলে স্ক্রল বার হবে)
                 ========================================== -->
            <div class="col-lg-3">
                <div class="year-sidebar-nav">
                    @forelse($years as $index => $year)
                        <!-- 🎯 কুয়েরি ফিল্টারিং: প্রথম ইনডেক্সে থাকা লেটেস্ট বছরটি ডিফল্ট একটিভ স্টেট পাবে ভাই -->
                        <button type="button" 
                                class="year-tab-btn @if($index === 0) active-year-node @endif" 
                                data-year="{{ $year }}">
                            <span><i class="fa-solid fa-clock-history mr-2" style="font-size: 11px;"></i> Year {{ $year }}</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @empty
                        <div class="text-center py-2 text-muted font-weight-bold" style="font-size: 12px; width: 100%;">
                            No Data Records Available
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- ==========================================
                 🚀 ডান পাশের মেইন ডাটা শীট পোর্টাল (মোবাইলে ডানে-বামে স্মুথ টাচ স্ক্রল হবে ভাই)
                 ========================================== -->
            <div class="col-lg-9">
                <div class="spreadsheet-display-panel">
                    <div class="card-header bg-white py-3 flex justify-between items-center" style="border-bottom: 1px solid #F1F5F9;">
                        <h3 class="card-title" style="font-size: 14.5px; font-weight: 800; color: #0F172A; margin: 0; padding-top: 4px;">
                            <i class="fa-solid fa-chart-pie text-[#1E40AF] mr-1"></i> Data Registry Records: <span id="dynamicYearTitleHeading">---</span>
                        </h3>
                    </div>
                    
                    <div class="card-body p-0">
                        <!-- ⚡ ওয়ান-লাইন রেসপন্সিভ টাচ ফিক্স: 'excel-scroll-frame' কন্টেইনারে মোবাইল-টাচ সোয়াইপ অন করা হলো ভাই -->
                        <div class="excel-scroll-frame">
                            <table class="table frontend-excel-table">
                                <thead>
                                    <tr>
                                        <th class="freeze-corner">Hospital Institute Registry Name</th>
                                        @foreach($surgeryTypes as $type)
                                            <th class="frontend-type-col" data-type-id="{{ $type->id }}">{{ $type->name }}</th>
                                        @endforeach
                                        <th class="total-header-col">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id="frontendMatrixTableBody">
                                    @foreach($hospitals as $hospital)
                                        <tr class="frontend-hospital-row" data-hospital-id="{{ $hospital->id }}">
                                            <td class="freeze-col">
                                                <i class="fa-solid fa-circle-h text-primary mr-1.5" style="font-size: 11px; opacity:0.6;"></i>
                                                {{ $hospital->name }}
                                            </td>
                                            
                                            @foreach($surgeryTypes as $type)
                                                <td class="matrix-value-cell" 
                                                    id="cell_{{ $hospital->id }}_{{ $type->id }}" 
                                                    data-hospital-id="{{ $hospital->id }}" 
                                                    data-type-id="{{ $type->id }}">
                                                    0
                                                </td>
                                            @endforeach
                                            
                                            <td class="row-total-col" id="frontend_hospital_total_{{ $hospital->id }}">0</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <td class="grand-total-row freeze-col text-left" style="padding-left: 18px;">
                                            <i class="fa-solid fa-calculator mr-1.5" style="font-size: 11px; color:#38BDF8;"></i> TOTAL
                                        </td>
                                        @foreach($surgeryTypes as $type)
                                            <td class="grand-total-row frontend-type-total" id="frontend_type_total_{{ $type->id }}">0</td>
                                        @endforeach
                                        <td class="grand-total-row row-total-col" id="frontend_ultimate_grand_total">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div> {{-- .col-9 ক্লোজিং ভাই --}}
            
        </div> {{-- .row ক্লোজিং ভাই --}}
    </div> {{-- .stats-container ক্লোজিং ভাই --}}
</div> {{-- .stats-body-wrapper ক্লোজিং ভাই --}}
<!-- ==========================================
     👑 ৩. আল্ট্রা-ফাস্ট সেন্ট্রাল জেসন মেমোরি ডিসপ্যাচ ও অটো-লেটেস্ট ইয়ার ইঞ্জিন ভাই
     ========================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // ক) ল্যারাভেলের সেন্ট্রাল মেমোরি ডাটাপ্যাক সরাসরি জাভাস্ক্রিপ্ট জেসন নোডে লক ভাই
        const centralSurgeryMatrixDb = @json($allRecords);
        const activeSurgeryTypes = @json($surgeryTypes);
        
        const yearButtons = document.querySelectorAll('.year-tab-btn');
        const dynamicTitleHeading = document.getElementById('dynamicYearTitleHeading');

        // 🎯 ওয়ান-ট্যাপ ফাস্ট রেন্ডারিং মেথড: পেজ রিলোড বা স্ক্রল হ্যাসেল ছাড়া ডাটা লোড ইঞ্জিন ভাই
        function renderSelectedYearStatistics(year) {
            if (!year) return;

            // ওয়ান-ট্যাপ স্ক্রিন আপডেট: হেডিংয়ে সিলেক্ট করা বছর অটো সিঙ্ক ভাই
            dynamicTitleHeading.textContent = year;

            let ultimateGrandTotal = 0;
            let typeTotals = {};
            
            activeSurgeryTypes.forEach(function(type) {
                typeTotals[type.id] = 0;
            });

            const rows = document.querySelectorAll('.frontend-hospital-row');
            rows.forEach(function(row) {
                let hospitalId = row.getAttribute('data-hospital-id');
                let hospitalRowTotal = 0;

                activeSurgeryTypes.forEach(function(type) {
                    let cellNode = document.getElementById(`cell_${hospitalId}_${type.id}`);
                    let exactCount = 0;

                    // 🔍 👑 জাদুকরী ওয়ান-লাইন ফিক্স: ল্যারাভেল groupBy অ্যারের [0] ইনডেক্স ডিরেক্ট রিড লজিক ভাই (ডেটা লাইভ হবে)
                    if (centralSurgeryMatrixDb[year] && 
                        centralSurgeryMatrixDb[year][hospitalId] && 
                        centralSurgeryMatrixDb[year][hospitalId][type.id] &&
                        centralSurgeryMatrixDb[year][hospitalId][type.id][0]) {
                        
                        exactCount = parseInt(centralSurgeryMatrixDb[year][hospitalId][type.id][0].data_count) || 0;
                    }

                    if (cellNode) {
                        cellNode.textContent = exactCount;
                    }

                    hospitalRowTotal += exactCount;
                    typeTotals[type.id] += exactCount;
                });

                const hospitalTotalNode = document.getElementById(`frontend_hospital_total_${hospitalId}`);
                if (hospitalTotalNode) {
                    hospitalTotalNode.textContent = hospitalRowTotal;
                }
                ultimateGrandTotal += hospitalRowTotal;
            });

            // নিচের ভার্টিকাল টোটাল রো রেন্ডারিং ভাই
            activeSurgeryTypes.forEach(function(type) {
                const typeTotalNode = document.getElementById(`frontend_type_total_${type.id}`);
                if (typeTotalNode) {
                    typeTotalNode.textContent = typeTotals[type.id];
                }
            });

            // মেগা গ্র্যান্ড টোটাল রেন্ডারিং ভাই
            const grandTotalNode = document.getElementById('frontend_ultimate_grand_total');
            if (grandTotalNode) {
                grandTotalNode.textContent = ultimateGrandTotal;
            }
        }

        // 🎯 খ) ওয়ান-ক্লিক ইয়ারলি ট্যাব লিসেনার ড্রাইভার ভাই
        yearButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.querySelector('.year-tab-btn.active-year-node')?.classList.remove('active-year-node');
                this.classList.add('active-year-node');

                let targetYear = this.getAttribute('data-year');
                renderSelectedYearStatistics(targetYear);
            });
        });

        // 🎯 গ) ডিফল্ট লেটেস্ট ইয়ার বুট নোড ভাই
        const initialActiveBtn = document.querySelector('.year-tab-btn.active-year-node');
        if (initialActiveBtn) {
            let defaultYear = initialActiveBtn.getAttribute('data-year');
            renderSelectedYearStatistics(defaultYear);
        }
    });
</script>

@endsection
