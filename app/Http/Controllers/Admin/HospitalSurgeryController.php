<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\SurgeryType;
use App\Models\HospitalSurgeryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalSurgeryController extends Controller
{
    /**
     * 🎯 ১. এক্সেল-শীট ডাটা এন্ট্রি হাব ল্যান্ডিং মেথড ভাই
     */
    public function index()
    {
        // 👑 আপনার শর্ত: শুধুমাত্র একটিভ হাসপাতালগুলো নামের ক্রমানুসারে (A to Z) সাজানো হবে ভাই
        $hospitals = Hospital::where('status', 1)->orderBy('name', 'asc')->get();
        
        // শুধুমাত্র একটিভ (status = 1) সার্জারি কলামের টাইপগুলো লোড ভাই
        $surgeryTypes = SurgeryType::where('status', 1)->orderBy('sort_order', 'asc')->get();
        
        // অ্যাডমিন প্যানেলে আগে ইনপুট দেওয়া বছরগুলোর ইউনিক তালিকা ড্রপডাউনের জন্য
        $years = HospitalSurgeryRecord::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('admin.surgery_records.index', compact('hospitals', 'surgeryTypes', 'years'));
    }

    /**
     * ⚡ ২. বছর সিলেক্ট করলে ওল্ড ডেটা সরাসরি বক্সে রি-লোড করার ইন্টেলিজেন্ট এপিআই ভাই
     */
    public function fetchMatrix(Request $request)
    {
        $year = $request->input('year');
        if (!$year) {
            return response()->json(['success' => false, 'message' => 'Year is required']);
        }

        $records = HospitalSurgeryRecord::where('year', $year)
            ->get()
            ->groupBy(['hospital_id', 'surgery_type_id']);

        return response()->json([
            'success' => true,
            'records' => $records
        ]);
    }
    /**
     * 👑 ৩. মেগা বাল্ক সেভিং মেথড: এক্সেল শীটের সম্পূর্ণ বছরের ডাটা এক ক্লিকে স্টোর ও আপডেট জোন ভাই
     */
    public function storeOrUpdate(Request $request)
    {
        $year = $request->input('year');
        $matrixData = $request->input('matrix', []); // ফর্মে থাকা সম্পূর্ণ ম্যাট্রিক্স অ্যারে ডাটাপ্যাক ভাই

        if (!$year) {
            return redirect()->back()->withErrors(['year' => 'Please select or enter a valid year.']);
        }

        // ⚡ ডাটাবেজ সিকিউরিটি এবং পারফরম্যান্স এনফোর্সমেন্ট ট্র্যাকিং ভাই
        DB::beginTransaction();
        try {
            foreach ($matrixData as $hospitalId => $types) {
                foreach ($types as $surgeryTypeId => $countValue) {
                    
                    // ফর্মে যদি ফাঁকা ভ্যালু থাকে তবে ডাটাবেজে জিরো (0) হিসেবে লক হবে ভাই
                    $finalCount = (int) $countValue;

                    // 🎯 লজিক: ডেটা আগে থাকলে আপডেট হবে, না থাকলে নতুন তৈরি হবে (Upsert Mechanism)
                    HospitalSurgeryRecord::updateOrCreate(
                        [
                            'hospital_id'     => $hospitalId,
                            'surgery_type_id' => $surgeryTypeId,
                            'year'            => $year
                        ],
                        [
                            'data_count'      => $finalCount
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Spreadsheet matrix configurations successfully locked and updated for year ' . $year);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Database bulk processing failed: ' . $e->getMessage()]);
        }
    }
}
