<link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
@extends('adminlte::page')

@section('title', 'Cardiac Surgery Analytics Grid | BACTA')

@section('content_header')
    <div style="font-family: 'Poppins', sans-serif; padding: 5px 5px 0;">
        <h1 style="color: #0F172A; font-weight: 800; font-size: 24px; margin: 0;">
            <i class="fa-solid fa-calculator text-[#0284C7] mr-1"></i> Cardiac Surgery Analytics Grid
        </h1>
        <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0; font-weight: 600;">Input statistics with real-time automatic row and column total summation engines.</p>
    </div>
@stop

@section('content')
<style>
    .spreadsheet-wrapper { background: #ffffff; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 10px 25px -5px rgba(148, 163, 184, 0.05); overflow: hidden; }
    .excel-scroll-container { max-height: 580px; overflow: auto; position: relative; }
    .excel-table { font-family: 'Poppins', sans-serif; font-size: 13px; min-width: 1300px; margin: 0; border-collapse: separate; border-spacing: 0; }
    
    /* 👑 ফ্রিজ প্যানেলস এবং স্টিকি হেডার লক ভাই */
    .excel-table thead th { position: sticky; top: 0; background: #0F172A !important; color: #ffffff !important; font-weight: 700; padding: 14px 10px; z-index: 10; border: 1px solid #1E293B !important; vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px; font-size: 12px; }
    .excel-table thead th.freeze-corner { left: 0; z-index: 12; background: #0F172A !important; border-right: 3px solid #0284C7 !important; }
    .excel-table thead th.total-header-col { right: 0; position: sticky; z-index: 11; background: #1E3A8A !important; border-left: 3px solid #1E3A8A !important; }
    
    .excel-table tbody tr td.freeze-col { position: sticky; left: 0; background: #ffffff !important; font-weight: 700; color: #0F172A; text-align: left; padding: 12px 18px; z-index: 5; border-right: 3px solid #0284C7 !important; border-bottom: 1px solid #E2E8F0 !important; box-shadow: 4px 0 8px -3px rgba(0,0,0,0.05); width: 280px; max-width: 280px; }
    .excel-table tbody tr:hover td.freeze-col { background: #F8FAFC !important; color: #0284C7; }
    
    /* 🎯 রো টোটাল কলামের রাজকীয় স্টিকি রাইট লক সিএসএস ভাই */
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
    <form action="{{ route('admin.surgeries.store') }}" method="POST" id="matrixBulkForm">
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
             🚀 LAYER 2: DOUBLE SUMMATION SPREADSHEET MATRIX
             ========================================== -->
        <div class="spreadsheet-wrapper">
            <div class="card-body p-0">
                <div class="excel-scroll-container">
                    <table class="table excel-table text-center">
                        <thead>
                            <tr>
                                <th class="freeze-corner">Hospital Institute Registry Name</th>
                                @foreach($surgeryTypes as $type)
                                    <th class="type-header-cell" data-type-id="{{ $type->id }}">{{ $type->name }}</th>
                                @endforeach
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
                                    
                                    @foreach($surgeryTypes as $type)
                                        <td>
                                            <!-- 🎯 ওয়ান-লাইন ল্যারাভেল আইডি সিঙ্ক: input_hospitalId_typeId আইডি ফরম্যাট লকড ভাই -->
                                            <input type="number" 
                                                   name="matrix[{{ $hospital->id }}][{{ $type->id }}]" 
                                                   id="input_{{ $hospital->id }}_{{ $type->id }}"
                                                   data-hospital-id="{{ $hospital->id }}"
                                                   data-type-id="{{ $type->id }}"
                                                   class="matrix-grid-box surgery-matrix-input" 
                                                   value="0" 
                                                   min="0"
                                                   onfocus="this.select();">
                                        </td>
                                    @endforeach
                                    
                                    <td class="row-total-col" id="hospital_total_{{ $hospital->id }}">0</td>
                                </tr>
                            @empty
                                <tr id="emptyRowPlaceholder">
                                    <td colspan="{{ count($surgeryTypes) + 2 }}" class="text-center py-5 text-muted" style="font-weight: 600; background-color: #F8FAFC;">
                                        No active hospitals registered.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                        <tfoot>
                            <tr style="border-top: 3px solid #0F172A;">
                                <td class="grand-total-row freeze-col text-left" style="padding-left: 18px;"><i class="fa-solid fa-calculator mr-1.5" style="font-size: 11px; color:#38BDF8;"></i> SURGERY TYPES TOTAL</td>
                                @foreach($surgeryTypes as $type)
                                    <td class="grand-total-row type-total-cell" id="type_total_{{ $type->id }}">0</td>
                                @endforeach
                                <td class="grand-total-row row-total-col" id="ultimate_grand_total">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white text-right py-3" style="border-top: 1px solid #F1F5F9;">
                <button type="submit" class="btn btn-success" style="background-color: #16A34A; border-color: #16A34A; font-weight: 700; font-size: 13.5px; border-radius: 6px; padding: 8px 24px; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.15);">
                    <i class="fa-solid fa-square-check mr-1"></i> Save Annual Matrix Record
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
            
            // ক) প্রতিটি কলামের (Surgery Type) ভার্টিকাল যোগফল জিরো দিয়ে ইনিশিয়েট ভাই
            let typeTotals = {};
            $('.type-header-cell').each(function() {
                typeTotals[$(this).data('type-id')] = 0;
            });

            // খ) প্রতিটি হাসপাতালের (Row) হরাইজন্টাল যোগফল লুপ ভাই
            $('.hospital-row').each(function() {
                let hospitalId = $(this).data('hospital-id');
                let hospitalRowTotal = 0;

                // এই নির্দিষ্ট রো এর সব ইনপুট বক্সের মান যোগ করা হলো ভাই
                $(this).find('.surgery-matrix-input').each(function() {
                    let typeId = $(this).data('type-id');
                    let val = parseInt($(this).val()) || 0;

                    hospitalRowTotal += val; 
                    if (typeTotals[typeId] !== undefined) {
                        typeTotals[typeId] += val; 
                    }
                });

                // ওয়ান-ট্যাপ স্ক্রিন আপডেট: হাসপাতালের পাশে ডান কলামে লাইভ হরাইজন্টাল টোটাল শো ভাই
                $(`#hospital_total_${hospitalId}`).text(hospitalRowTotal);
                ultimateGrandTotal += hospitalRowTotal;
            });

            // গ) ওয়ান-ট্যাপ স্ক্রিন আপডেট: টেবিলের একদম নিচে প্রতিটি কলামের (Type) ভার্টিকাল টোটাল শো ভাই
            $.each(typeTotals, function(typeId, total) {
                $(`#type_total_${typeId}`).text(total);
            });

            // ঘ) মেগা গ্র্যান্ড টোটাল: পুরো বাংলাদেশের মোট সর্বমোট অপারেশনের মেগা সংখ্যা লাইভ শো ভাই
            $('#ultimate_grand_total').text(ultimateGrandTotal);
        }

        // ইউজার বক্সে টাইপ করা মাত্রই লাইভ ক্যালকুলেটর রান হবে ভাই
        $(document).on('input change', '.surgery-matrix-input', function() {
            calculateLiveSpreadsheetTotals();
        });


        // 🎯 ২. ওয়ান-ক্লিক ইনস্ট্যান্ট অটো-ফিল্টার: টাইপ করা মাত্রই হাসপাতালের রো হাইд/শো হবে ভাই
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
                    $('#matrixTableBody').append(`<tr id="noResultRow"><td colspan="100" class="text-center py-4 text-muted font-weight-bold"><i class="fa-solid fa-magnifying-glass-minus mr-1"></i> No matching hospital registries found.</td></tr>`);
                }
            } else {
                $('#noResultRow').remove();
            }
        });


        // 🎯 ৩. নতুন বছর যুক্ত করার ডাইনামিক ড্রপডাউন কন্ট্রোল হাব ভাই
        $('#matrixYearSelect').on('change', function() {
            let selectedValue = $(this).val();
            
            if (selectedValue === 'new_year') {
                $('#customYearInputWrapper').fadeIn();
                $('#customYearInput').attr('required', true).focus();
                $('.surgery-matrix-input').val(0);
                calculateLiveSpreadsheetTotals(); 
            } else {
                $('#customYearInputWrapper').fadeOut();
                $('#customYearInput').attr('required', false).val('');
                
                if (selectedValue !== '') {
                    fetchExistingYearlyRecords(selectedValue);
                } else {
                    $('.surgery-matrix-input').val(0);
                    calculateLiveSpreadsheetTotals();
                }
            }
        });

        // কাস্টম নতুন বছরের মান মেইন সিলেক্টেড ভ্যালু হিসেবে সিঙ্ক করার লজিক ভাই
        $('#customYearInput').on('input', function() {
            let yearVal = $(this).val();
            if (yearVal) {
                $('#matrixYearSelect option[value="new_year"]').val(yearVal);
            } else {
                $('#matrixYearSelect option[value="new_year"]').val('new_year');
            }
        });


        // 👑 ৪. ফিক্সড ইন্টেলিজেন্ট অ্যাজাক্স ইঞ্জিন: কন্ট্রোলারের ডাইনামিক groupBy স্ট্রাকচার রিড মেকানিজম ভাই
        function fetchExistingYearlyRecords(year) {
            $('.surgery-matrix-input').val(0);

            $.ajax({
                url: "{{ route('admin.surgeries.fetch') }}",
                method: "GET",
                data: { year: year },
                dataType: "json",
                beforeSend: function() {
                    $('.surgery-matrix-input').css('opacity', '0.4');
                },
                success: function(response) {
                    $('.surgery-matrix-input').css('opacity', '1');
                    
                    if (response.success && response.records) {
                        // 🔒 ব্যাকএন্ডের groupBy(['hospital_id', 'surgery_type_id']) অবজেক্ট রিড লজিক ভাই
                        $.each(response.records, function(hospitalId, types) {
                            $.each(types, function(surgeryTypeId, recordArray) {
                                if (recordArray && recordArray.length > 0) {
                                    // অ্যারের প্রথম ইনডেক্সের [0] অফিশিয়াল ডাটা অবজেক্ট ভ্যালু রিড ভাই
                                    let exactCount = recordArray[0].data_count;
                                    
                                    // আপনার ওরিজিনাল ইনপুট আইডিতে ওয়ান-ট্যাপ ডেটা পুশ ভাই
                                    $(`#input_${hospitalId}_${surgeryTypeId}`).val(exactCount);
                                }
                            });
                        });
                    }
                    // ওল্ড ডাটা বক্সে বক্সে পুশ হওয়ার পর মেগা টোটাল অটো-হিসাব হয়ে যাবে ভাই
                    calculateLiveSpreadsheetTotals();
                },
                error: function(xhr) {
                    $('.surgery-matrix-input').css('opacity', '1');
                    console.error("AJAX matrix dispatch error:", xhr);
                    calculateLiveSpreadsheetTotals();
                }
            });
        }
    });
</script>
@stop
