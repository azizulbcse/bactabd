<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', 'Congenital Heart Surgery Statistics in Bangladesh | BACTA')

@section('content')

<style>
    .stats-table { font-size: 13px; min-width: 900px; width: 100%; border-collapse: separate; border-spacing: 0; text-align: center; }
    .stats-table thead th { position: sticky; top: 0; z-index: 10; background: #1A4B84 !important; color: #fff !important; font-weight: 500; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 10px; border: 1px solid #2563a8 !important; }
    .stats-table thead th.col-freeze { left: 0; z-index: 12; background: #0F3460 !important; border-right: 2px solid #00ADB5 !important; }
    .stats-table thead th.col-total { right: 0; z-index: 11; background: #0F3460 !important; border-left: 2px solid #00ADB5 !important; }
    .stats-table tbody td { padding: 10px 8px; border: 1px solid #E0F2FE !important; color: #334155; font-size: 13px; }
    .stats-table tbody tr:hover td:not(.col-freeze):not(.col-total) { background: #EFF6FF; color: #1A4B84; }
    .stats-table tbody td.col-freeze { position: sticky; left: 0; z-index: 5; background: #fff !important; font-weight: 500; color: #0F172A; text-align: left; padding: 10px 14px; width: 240px; max-width: 240px; border-right: 2px solid #00ADB5 !important; border-bottom: 1px solid #E0F2FE !important; }
    .stats-table tbody tr:hover td.col-freeze { background: #F0FDFF !important; color: #0284C7; }
    .stats-table tbody td.col-total { position: sticky; right: 0; z-index: 4; background: #F0FDFF !important; font-weight: 600; color: #0284C7; border-left: 2px solid #00ADB5 !important; border-bottom: 1px solid #E0F2FE !important; }
    .stats-table tfoot td { background: #1A4B84 !important; color: #fff !important; font-weight: 600; font-size: 13px; padding: 12px 10px; border-top: 2px solid #0F3460 !important; }
    .stats-table tfoot td.col-freeze { position: sticky; left: 0; z-index: 6; background: #0F3460 !important; text-align: left; padding-left: 16px; }
    .stats-table tfoot td.col-total { position: sticky; right: 0; z-index: 6; background: #0F3460 !important; border-left: 2px solid #00ADB5 !important; }
    @media (max-width: 768px) { .filter-bar { flex-direction: column; align-items: flex-start !important; gap: 10px; } .year-select { width: 100% !important; } }
</style>

    {{-- HEADER --}}
    <header class="relative overflow-hidden py-14 border-b border-[#CFEAF5]" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 50%, #E0F2FE 100%);">
        <div class="absolute inset-0 opacity-[0.04] bg-[linear-gradient(to_right,#0284C7_1px,transparent_1px),linear-gradient(to_bottom,#0284C7_1px,transparent_1px)] bg-[size:32px_32px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row justify-between items-center gap-4 text-center lg:text-left">
            <div>
                <span class="text-xs font-medium tracking-[0.18em] text-[#0284C7] uppercase block mb-2">Research & Publications</span>
                <h1 class="text-2xl lg:text-3xl font-semibold tracking-tight text-[#0F172A]">Congenital Heart Surgery Statistics</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#0284C7] transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-[#0F172A]">Congenital Surgery Statistics</span>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <section class="py-12" style="background: linear-gradient(135deg, #EBF8FF 0%, #F0FDFF 60%, #E0F2FE 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filter bar --}}
            <div class="filter-bar bg-white rounded-2xl border border-[#CFEAF5] shadow-sm px-5 py-4 mb-5 flex flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center">
                        <i class="fa-solid fa-heart-pulse text-[#0284C7] text-xs"></i>
                    </div>
                    <span class="text-sm font-medium text-slate-700">National Congenital Surgical Data Dashboard</span>
                </div>
                <div class="flex items-center gap-3">
                    <label for="frontendYearSelectDropdown" class="text-xs font-medium text-slate-400 uppercase tracking-wider hidden sm:block">Year:</label>
                    <select id="frontendYearSelectDropdown" class="year-select text-sm font-medium text-slate-700 bg-[#F0FDFF] border border-[#CFEAF5] rounded-xl px-4 py-2 pr-8 outline-none focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer" style="appearance:none; background-image:url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%230284C7' stroke-width='2'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3e%3c/svg%3e\"); background-repeat:no-repeat; background-position:right 10px center; background-size:14px;">
                        @forelse($years as $index => $year)
                            <option value="{{ $year }}" @if($index === 0) selected @endif>{{ $year }}</option>
                        @empty
                            <option value="">No Data</option>
                        @endforelse
                    </select>
                </div>
            </div>

            {{-- Table panel --}}
            <div class="bg-white rounded-2xl border border-[#CFEAF5] shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-[#CFEAF5]">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-table text-[#0284C7] text-sm"></i>
                        <span class="text-sm font-medium text-slate-700">
                            Hospital Registries — <span id="dynamicYearTitleHeading" class="text-[#0284C7]">---</span>
                        </span>
                    </div>
                    <span class="text-xs text-slate-400 hidden sm:block">Scroll horizontally to see all columns →</span>
                </div>

                <div style="overflow-x:auto; overflow-y:visible; -webkit-overflow-scrolling:touch;">
                    <table class="stats-table">
                        <thead>
                            <tr>
                                <th class="col-freeze">Hospital / Institute</th>
                                <th>ASD</th>
                                <th>VSD</th>
                                <th>TOF / ICR</th>
                                <th>PDA</th>
                                <th class="col-total">Total</th>
                            </tr>
                        </thead>
                        <tbody id="frontendCongenitalTableBody">
                            @foreach($hospitals as $hospital)
                                <tr id="row_hospital_{{ $hospital->id }}" data-hospital-id="{{ $hospital->id }}">
                                    <td class="col-freeze">
                                        <i class="fa-solid fa-hospital-user text-[#0284C7] mr-1.5 opacity-60" style="font-size:10px;"></i>
                                        {{ $hospital->name }}
                                    </td>
                                    <td id="cell_{{ $hospital->id }}_asd">0</td>
                                    <td id="cell_{{ $hospital->id }}_vsd">0</td>
                                    <td id="cell_{{ $hospital->id }}_tof">0</td>
                                    <td id="cell_{{ $hospital->id }}_pda">0</td>
                                    <td class="col-total" id="frontend_hospital_total_{{ $hospital->id }}">0</td>
                                </tr>
                            @endforeach

                            <tr id="allZeroPlaceholderRow" style="display:none;">
                                <td colspan="6" class="text-center py-10 text-slate-400 text-sm">
                                    <i class="fa-solid fa-chart-bar mr-1 text-slate-300"></i> No congenital surgical data found for this year.
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="col-freeze">
                                    <i class="fa-solid fa-calculator mr-1.5 opacity-70" style="font-size:10px;"></i> Total
                                </td>
                                <td id="frontend_total_asd">0</td>
                                <td id="frontend_total_vsd">0</td>
                                <td id="frontend_total_tof">0</td>
                                <td id="frontend_total_pda">0</td>
                                <td class="col-total" id="frontend_ultimate_grand_total">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const centralSurgeryMatrixDb = @json($allRecords);
        const hospitalsDataList = @json($hospitals);

        const yearDropdown = document.getElementById('frontendYearSelectDropdown');
        const yearTitle    = document.getElementById('dynamicYearTitleHeading');

        function render(year) {
            if (!year) return;
            yearTitle.textContent = year;

            let grandTotal = 0, visibleRows = 0;
            let totalASD = 0, totalVSD = 0, totalTOF = 0, totalPDA = 0;

            hospitalsDataList.forEach(function(hospital) {
                let id = hospital.id;
                let asd = 0, vsd = 0, tof = 0, pda = 0;

                if (centralSurgeryMatrixDb[year]?.[id]?.[0]) {
                    let rec = centralSurgeryMatrixDb[year][id][0];
                    asd = parseInt(rec.asd_count) || 0;
                    vsd = parseInt(rec.vsd_count) || 0;
                    tof = parseInt(rec.tof_count) || 0;
                    pda = parseInt(rec.pda_count) || 0;
                }

                let rowTotal = asd + vsd + tof + pda;
                let row = document.getElementById(`row_hospital_${id}`);

                if (rowTotal === 0) {
                    if (row) row.style.display = 'none';
                } else {
                    if (row) row.style.display = '';
                    visibleRows++;
                    document.getElementById(`cell_${id}_asd`).textContent = asd;
                    document.getElementById(`cell_${id}_vsd`).textContent = vsd;
                    document.getElementById(`cell_${id}_tof`).textContent = tof;
                    document.getElementById(`cell_${id}_pda`).textContent = pda;
                    document.getElementById(`frontend_hospital_total_${id}`).textContent = rowTotal;
                    totalASD += asd; totalVSD += vsd; totalTOF += tof; totalPDA += pda;
                    grandTotal += rowTotal;
                }
            });

            let placeholder = document.getElementById('allZeroPlaceholderRow');
            if (placeholder) placeholder.style.display = visibleRows === 0 ? '' : 'none';

            document.getElementById('frontend_total_asd').textContent = totalASD;
            document.getElementById('frontend_total_vsd').textContent = totalVSD;
            document.getElementById('frontend_total_tof').textContent = totalTOF;
            document.getElementById('frontend_total_pda').textContent = totalPDA;
            document.getElementById('frontend_ultimate_grand_total').textContent = grandTotal;
        }

        if (yearDropdown) {
            yearDropdown.addEventListener('change', function() { render(this.value); });
            render(yearDropdown.value);
        }
    });
</script>

@endsection