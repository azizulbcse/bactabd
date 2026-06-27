<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\ValvularSurgeryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValvularSurgeryController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        $years = ValvularSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        return view('admin.valvular_surgeries.index', compact('hospitals', 'years'));
    }

    public function fetchMatrix(Request $request)
    {
        $year = $request->input('year');
        if (!$year) {
            return response()->json(['success' => false, 'message' => 'Year is required']);
        }

        $records = ValvularSurgeryRecord::where('year', $year)
            ->get()
            ->keyBy('hospital_id');

        return response()->json([
            'success' => true,
            'records' => $records
        ]);
    }
    public function storeOrUpdate(Request $request)
    {
        $year = $request->input('year');
        $matrixData = $request->input('matrix', []); // ফর্মে থাকা সম্পূর্ণ ম্যাট্রিক্স অ্যারে ডাটাপ্যাক ভাই

        if (!$year) {
            return redirect()->back()->withErrors(['year' => 'Please select or enter a valid year.']);
        }

        DB::beginTransaction();
        try {
            foreach ($matrixData as $hospitalId => $counts) {
                
                ValvularSurgeryRecord::updateOrCreate(
                    [
                        'hospital_id' => $hospitalId,
                        'year'        => $year 
                    ],
                    [
                        'mvr_count'   => (int) ($counts['mvr'] ?? 0),
                        'avr_count'   => (int) ($counts['avr'] ?? 0),
                        'dvr_count'   => (int) ($counts['dvr'] ?? 0),
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Valvular spreadsheet matrix successfully updated for year ' . $year);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Database bulk processing failed: ' . $e->getMessage()]);
        }
    }
}
