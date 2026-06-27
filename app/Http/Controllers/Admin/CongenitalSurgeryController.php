<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\CongenitalSurgeryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CongenitalSurgeryController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        
        $years = CongenitalSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('admin.congenital_surgeries.index', compact('hospitals', 'years'));
    }
    public function fetchMatrix(Request $request)
    {
        $year = $request->input('year');
        if (!$year) {
            return response()->json(['success' => false, 'message' => 'Year is required']);
        }

        $records = CongenitalSurgeryRecord::where('year', $year)
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
        $matrixData = $request->input('matrix', []);

        if (!$year) {
            return redirect()->back()->withErrors(['year' => 'Please select or enter a valid year.']);
        }

        DB::beginTransaction();
        try {
            foreach ($matrixData as $hospitalId => $counts) {
                
                CongenitalSurgeryRecord::updateOrCreate(
                    [
                        'hospital_id' => $hospitalId,
                        'year'        => $year // ইয়ার লক মেকানিজম ভাই (কখনো অন্য বছরের সাথে মিক্স হবে না)
                    ],
                    [
                        'asd_count'   => (int) ($counts['asd'] ?? 0),
                        'vsd_count'   => (int) ($counts['vsd'] ?? 0),
                        'tof_count'   => (int) ($counts['tof'] ?? 0),
                        'pda_count'   => (int) ($counts['pda'] ?? 0),
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Congenital spreadsheet matrix successfully updated for year ' . $year);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Database bulk processing failed: ' . $e->getMessage()]);
        }
    }
}
