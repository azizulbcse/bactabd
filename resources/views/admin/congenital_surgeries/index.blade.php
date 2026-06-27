<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />

@extends('adminlte::page')

@section('title', 'Congenital Heart Surgery Grid | BACTA')

@section('content_header')
    <div style="font-family: 'Poppins', sans-serif; padding: 5px 5px 0;">
        <h1 style="color: #0F172A; font-weight: 800; font-size: 24px; margin: 0;">
            <i class="fa-solid fa-baby-carriage text-[#0284C7] mr-1"></i> Congenital Heart Surgery Grid
        </h1>
        <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0; font-weight: 600;">Input congenital statistics for ASD, VSD, TOF/ICR, and PDA with automatic summation.</p>
    </div>
@stop

@section('content')
<style>
    .spreadsheet-wrapper { background: #ffffff; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.05); overflow: hidden; }
    .excel-scroll-container { max-height: 580px; overflow: auto; position: relative; }
    .excel-table { font-family: 'Poppins', sans-serif; font-size: 13px; min-width: 1100px; margin: 0; border-collapse: separate; border-spacing: 0; }
    
    /* 👑 ফ্রিজ প্যানেলস এবং স্টিকি হেডার লক ভাই */
    .excel-table thead th { position: sticky; top: 0; background: #0F172A !important; color: #ffffff !important; font-weight: 700; padding: 14px 10px; z-index: 10; border: 1px solid #1E293B !important; vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px; font-size: 12px; }
    .excel-table thead th.freeze-corner { left: 0; z-index: 12; background: #0F172A !important; border-right: 3px solid #0284C7 !important; }
    .excel-table thead th.total-header-col { right: 0; position: sticky; z-index: 11; background: #1E3A8A !important; border-left: 3px solid #1E3A8A !important; }
    
    .excel-table tbody tr td.freeze-col { position: sticky; left: 0; background: #ffffff !important; font-weight: 700; color: #0F172A; text-align: left; padding: 12px 18px; z-index: 5; border-right: 3px solid #0284C7 !important; border-bottom: 1px solid #E2E8F0 !important; box-shadow: 4px 0 8px -3px rgba(0,0,0,0.05); width: 280px; max-width: 280px; }
    .excel-table tbody tr:hover td.freeze-col { background: #F8FAFC !important; color: #0284C7; }
    
    /* 🎯 রো টোটাল কলামের রাজকীয় স্টিকি রাইট লক ভাই */
    .excel-table tbody tr td.row-total-col { position: sticky; right: 0; background: #EFF6FF !important; font-weight: 800; color: #1E40AF; text-align: center; z-index: 5; border-left: 3px solid #3B82F6 !important; border-bottom: 1px solid #E2E8F0 !important; font-size: 13.5px; }
    .excel-table tfoot tr td.grand-total-row { position: sticky; bottom: 0; background: #1E293B !important; color: #ffffff !important; font-weight: 800; padding: 12px 10px; z-index: 9; border-top: 2px solid #0F172A !important; font-size: 13.5px; }
    .excel-table tfoot tr td.grand-total-row.freeze-col { background: #0F172A !important; color: #ffffff !important; z-index: 11; }
    .excel-table tfoot tr td.grand-total-row.row-total-col { background: #1E3A8A !important; color: #ffffff !important; z-index: 11; border-left: 3px solid #38BDF8 !important; }
    
    .excel-table tbody tr td { padding: 5px 4px; vertical-align: middle; border: 1px solid #E2E8F0 !important; }
    .matrix-grid-box { border-radius: 6px; padding: 4px 8px; height: 32px; font-size: 13.5px; font-weight: 800; color: #0F172A; border: 1px solid #CBD5E1; text-align: center; background: #ffffff; transition: all 0.2s ease; width: 100%; box-sizing: border-box; }
    .matrix-grid-box:focus { border-color: #0284C7 !important; background: #EFF6FF !important; box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15); outline: none; color: #1E40AF; }
    
    .premium-top-control { border-radius: 12px; border: 1px solid #E2E8F0; background: #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.01); }
    .live-search-icon-wrapper { position: relative; }
    .live-search-icon-wrapper i { position: absolute; left: 14px; top: 12px; color: #94A3B8; font-size: 14px; }
    .live-search-input-field { padding-left: 38px !important; height: 38px; border-radius: 6px; font-size: 13.5px; font-weight: 600; }
</style>

<div style="padding-bottom: 40px;">
    <!-- 🎯 👑 ইউআরএল কারেকশন: ২-বার admin জটলা রুখতে ওয়ান-লাইন সঠিক নেমস্পেস রাউট রুলস লকড ভাই -->
    <form action="{{ route('admin.congenital.store') }}" method="POST" id="matrixBulkForm">
        @csrf
        <div class="card premium-top-control mb-4">
            <div class="card-body py-4">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Select Operating Year <span class="text-danger">*</span></label>
                            <select name="year" id="matrixYearSelect" class="form-control" required style="border-radius: 6px; font-size: 13.5px; height: 38px; font-weight: 600; border-color: #CBD5E1;">
                                <option value="">-- Choose Statistics Year --</option>
                                @foreach($years as $y)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endforeach
                                <option value="new_year" style="color:#0284C7; font-weight:700;">+ Register New Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="customYearInputWrapper" style="display: none;">
                        <div class="form-group mb-0">
                            <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Enter New Year <span class="text-danger">*</span></label>
                            <input type="number" id="customYearInput" class="form-control" placeholder="e.g. 2026, 2027" min="2000" max="2100" style="border-radius: 6px; font-size: 13.5px; height: 38px; font-weight: 600;">
                        </div>
                    </div>
                    <div class="col-md-5 ml-auto">
                        <div class="form-group mb-0 live-search-icon-wrapper">
                            <label style="font-size: 12.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">Instant Hospital Search Filter</label>
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="hospitalSearchFilter" class="form-control live-search-input-field" placeholder="Type hospital name to instant filter...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==========================================
             🚀 LAYER 2: FIX 4-PROCEDURE CONGENITAL SPREADSHEET MATRIX
             ========================================== -->
        <div class="spreadsheet-wrapper">
            <div class="card-body p-0">
                <div class="excel-scroll-container">
                    <table class="table excel-table text-center">
                        <thead>
                            <tr>
                                <th class="freeze-corner">Hospital Institute Registry Name</th>
                                <th class="proc-header-cell" data-proc="asd">ASD</th>
                                <th class="proc-header-cell" data-proc="vsd">VSD</th>
                                <th class="proc-header-cell" data-proc="tof">TOF / ICR</th>
                                <th class="proc-header-cell" data-proc="pda">PDA</th>
                                <th class="total-header-col">Hospitals Total</th>
                            </tr>
                        </thead>
                        <tbody id="matrixTableBody">
                            @forelse($hospitals as $hospital)
                                <!-- 🎯 লজিক: কন্ট্রোলার থেকে আসা A to Z সিরিয়ালের হাসপাতালে ম্যাপিং জোন ভাই -->
                                <tr class="hospital-row" data-hospital-id="{{ $hospital->id }}" data-name="{{ strtolower($hospital->name) }}">
                                    <td class="freeze-col">
                                        <i class="fa-solid fa-circle-h text-primary mr-1.5" style="font-size: 11px; opacity:0.7;"></i>
                                        {{ $hospital->name }}
                                    </td>
                                    
                                    <!-- ১. ASD input box -->
                                    <td>
                                        <input type="number" 
                                               name="matrix[{{ $hospital->id }}][asd]" 
                                               id="input_{{ $hospital->id }}_asd"
                                               data-hospital-id="{{ $hospital->id }}"
                                               data-proc="asd"
                                               class="matrix-grid-box congenital-matrix-input" 
                                               value="0" 
                                               min="0"
                                               onfocus="this.select();">
                                    </td>
                                    
                                    <!-- ২. VSD input box -->
                                    <td>
                                        <input type="number" 
                                               name="matrix[{{ $hospital->id }}][vsd]" 
                                               id="input_{{ $hospital->id }}_vsd"
                                               data-hospital-id="{{ $hospital->id }}"
                                               data-proc="vsd"
                                               class="matrix-grid-box congenital-matrix-input" 
                                               value="0" 
                                               min="0"
                                               onfocus="this.select();">
                                    </td>
                                    
                                    <!-- ৩. TOF / ICR input box -->
                                    <td>
                                        <input type="number" 
                                               name="matrix[{{ $hospital->id }}][tof]" 
                                               id="input_{{ $hospital->id }}_tof"
                                               data-hospital-id="{{ $hospital->id }}"
                                               data-proc="tof"
                                               class="matrix-grid-box congenital-matrix-input" 
                                               value="0" 
                                               min="0"
                                               onfocus="this.select();">
                                    </td>
                                    
                                    <!-- ৪. PDA input box -->
                                    <td>
                                        <input type="number" 
                                               name="matrix[{{ $hospital->id }}][pda]" 
                                               id="input_{{ $hospital->id }}_pda"
                                               data-hospital-id="{{ $hospital->id }}"
                                               data-proc="pda"
                                               class="matrix-grid-box congenital-matrix-input" 
                                               value="0" 
                                               min="0"
                                               onfocus="this.select();">
                                    </td>
                                    
                                    <!-- 🔒 হরাইজন্টাল রো টোটাল কলাম ভাই -->
                                    <td class="row-total-col" id="hospital_total_{{ $hospital->id }}">0</td>
                                </tr>
                            @empty
                                <tr id="emptyRowPlaceholder">
                                    <td colspan="6" class="text-center py-5 text-muted" style="font-weight: 600; background-color: #F8FAFC;">
                                        No active hospitals registered.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                        <!-- ==========================================
                             👑 নিচের মেগা ভার্টিকাল সামেশন ফুটার লাইন ভাই
                             ========================================== -->
                        <tfoot>
                            <tr style="border-top: 3px solid #0F172A;">
                                <td class="grand-total-row freeze-col text-left" style="padding-left: 18px;"><i class="fa-solid fa-calculator mr-1.5" style="font-size: 11px; color:#38BDF8;"></i> PROCEDURES TOTAL</td>
                                <td class="grand-total-row proc-total-cell" id="proc_total_asd">0</td>
                                <td class="grand-total-row proc-total-cell" id="proc_total_vsd">0</td>
                                <td class="grand-total-row proc-total-cell" id="proc_total_tof">0</td>
                                <td class="grand-total-row proc-total-cell" id="proc_total_pda">0</td>
                                <td class="grand-total-row row-total-col" id="ultimate_grand_total">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white text-right py-3" style="border-top: 1px solid #F1F5F9;">
                <button type="submit" class="btn btn-success" style="background-color: #16A34A; border-color: #16A34A; font-weight: 700; font-size: 13.5px; border-radius: 6px; padding: 8px 24px; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.15);">
                    <i class="fa-solid fa-square-check mr-1"></i> Save Congenital Matrix Record
                </button>
            </div>
        </div>
    </form>
</div> {{-- .spreadsheet-wrapper ক্লোজিং ভাই --}}
@stop

@section('js')
<script>
    $(function () {
        // 🎯 ১. মেগা লাইভ সামেশন ক্যালকুলেটর ইঞ্জিন: টাইপ করার সাথে সাথে রিয়েল-টাইমে মোট হিসাব হবে ভাই
        function calculateLiveSpreadsheetTotals() {
            let ultimateGrandTotal = 0;
            let totalASD = 0, totalVSD = 0, totalTOF = 0, totalPDA = 0;

            $('.hospital-row').each(function() {
                let hospitalId = $(this).data('hospital-id');
                
                let asd = parseInt($(`#input_${hospitalId}_asd`).val()) || 0;
                let vsd = parseInt($(`#input_${hospitalId}_vsd`).val()) || 0;
                let tof = parseInt($(`#input_${hospitalId}_tof`).val()) || 0;
                let pda = parseInt($(`#input_${hospitalId}_pda`).val()) || 0;

                let hospitalRowTotal = asd + vsd + tof + pda;

                $(`#hospital_total_${hospitalId}`).text(hospitalRowTotal);
                
                ultimateGrandTotal += hospitalRowTotal;
                totalASD += asd;
                totalVSD += vsd;
                totalTOF += tof;
                totalPDA += pda;
            });

            $('#proc_total_asd').text(totalASD);
            $('#proc_total_vsd').text(totalVSD);
            $('#proc_total_tof').text(totalTOF);
            $('#proc_total_pda').text(totalPDA);

            $('#ultimate_grand_total').text(ultimateGrandTotal);
        }

        $(document).on('input change', '.congenital-matrix-input', function() {
            calculateLiveSpreadsheetTotals();
        });


        // 🎯 ২. ওয়ান-ক্লিক কাস্টম অটো-ফিল্টার: টাইপ করা মাত্রই হাসপাতালের রো হাইড/শো হবে ভাই
        $('#hospitalSearchFilter').on('keyup', function() {
            let searchVal = $(this).val().toLowerCase().trim();
            let visibleRows = 0;

            $('.hospital-row').each(function() {
                let hospitalName = $(this).data('name');
                if (hospitalName.includes(searchVal)) {
                    $(this).show();
                    visibleRows++;
                } else {
                    $(this).hide();
                }
            });

            if (visibleRows === 0 && $('.hospital-row').length > 0) {
                if (!$('#noResultRow').length) {
                    $('#matrixTableBody').append(`<tr id="noResultRow"><td colspan="6" class="text-center py-4 text-muted font-weight-bold"><i class="fa-solid fa-magnifying-glass-minus mr-1"></i> No matching hospital registries found.</td></tr>`);
                }
            } else {
                $('#noResultRow').remove();
            }
        });


        // 🎯 👑 ৩. ফিক্সড বছর সিঙ্ক হাব: কাস্টম বছর টাইপ করলে ড্রপডাউনের মূল ভ্যালু ডিরেক্ট চেঞ্জ করার লজিক ভাই
        $('#matrixYearSelect').on('change', function() {
            let selectedValue = $(this).val();
            
            if (selectedValue === 'new_year') {
                $('#customYearInputWrapper').fadeIn();
                $('#customYearInput').attr('required', true).val('').focus();
                $('.congenital-matrix-input').val(0);
                calculateLiveSpreadsheetTotals(); 
            } else {
                $('#customYearInputWrapper').fadeOut();
                $('#customYearInput').attr('required', false).val('');
                
                if (selectedValue !== '') {
                    fetchExistingYearlyRecords(selectedValue);
                } else {
                    $('.congenital-matrix-input').val(0);
                    calculateLiveSpreadsheetTotals();
                }
            }
        });

        // 🔒 জাদুকরী ওয়ান-লাইন ফিক্স: ইউজার বক্সে যা টাইপ করবে, সেটিই সরাসরি ফর্মের সাবমিট ভ্যালু হিসেবে ইনজেক্ট হবে ভাই!
        $('#customYearInput').on('input change', function() {
            let yearVal = $(this).val().trim();
            if (yearVal) {
                // ড্রপডাউনের নিউ ইয়ার অপশনের নিজস্ব ভ্যালু এট্রিবিউট সরাসরি টাইপ করা বছর দিয়ে ওয়ান-লাইনে রিপ্লেস ভাই!
                $('#matrixYearSelect option[value="new_year"], #matrixYearSelect option:selected').val(yearVal);
            } else {
                $('#matrixYearSelect option:selected').val('new_year');
            }
        });


        // 👑 ৪. ফিক্সড ইন্টেলিজেন্ট অ্যাজাক্স ইঞ্জিন: কন্ট্রোলারের ডাইনামিক keyBy স্ট্রাকচার রিড মেকানিজম ভাই
        function fetchExistingYearlyRecords(year) {
            $('.congenital-matrix-input').val(0);

            $.ajax({
                url: "{{ route('admin.congenital.fetch') }}",
                method: "GET",
                data: { year: year },
                dataType: "json",
                beforeSend: function() {
                    $('.congenital-matrix-input').css('opacity', '0.4');
                },
                success: function(response) {
                    $('.congenital-matrix-input').css('opacity', '1');
                    
                    if (response.success && response.records) {
                        $.each(response.records, function(hospitalId, recordObj) {
                            $(`#input_${hospitalId}_asd`).val(recordObj.asd_count || 0);
                            $(`#input_${hospitalId}_vsd`).val(recordObj.vsd_count || 0);
                            $(`#input_${hospitalId}_tof`).val(recordObj.tof_count || 0);
                            $(`#input_${hospitalId}_pda`).val(recordObj.pda_count || 0);
                        });
                    }
                    calculateLiveSpreadsheetTotals();
                },
                error: function(xhr) {
                    $('.congenital-matrix-input').css('opacity', '1');
                    console.error("AJAX congenital matrix error:", xhr);
                    calculateLiveSpreadsheetTotals();
                }
            });
        }
    });
</script>
@stop
