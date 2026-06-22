<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurgeryType;
use Illuminate\Http\Request;

class SurgeryTypeController extends Controller
{
    /**
     * 🎯 ১. ওয়ান-পেজ ম্যানেজমেন্ট ল্যান্ডিং ভিউ ভাই
     */
    public function index()
    {
        // শুধুমাত্র একটিভ (status = 1) টাইপগুলো সিরিয়াল অনুযায়ী পেজে যাবে ভাই
        $surgeryTypes = SurgeryType::where('status', 1)->orderBy('sort_order', 'asc')->get();
        return view('admin.surgery_types.index', compact('surgeryTypes'));
    }

    /**
     * 👑 ২. আপনার কন্ডিশন: ইউনিক নাম চেকিং এবং ওল্ড রেকর্ড অটো রি-অ্যাক্টিভেশন মেকানিজম ভাই
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        $nameInput = trim($request->input('name'));
        $sortOrder = $request->input('sort_order', 0);

        // 🔍 চেকপোস্ট: এই নাম আগে ডিলিট (status = 0) করা হয়েছিল কি না ভাই
        $existingRecord = SurgeryType::where('name', $nameInput)->first();

        if ($existingRecord) {
            if ($existingRecord->status == 0) {
                // 🎯 আপনার শর্ত: নাম মিলে গেছে তাই নতুন রো না বানিয়ে পুরোনো রেকর্ডটিই স্ট্যাটাস ১ করে একটিভ করা হলো ভাই!
                $existingRecord->update([
                    'status' => 1,
                    'sort_order' => $sortOrder > 0 ? $sortOrder : $existingRecord->sort_order
                ]);
                return redirect()->back()->with('success', 'Surgery designation re-activated successfully!');
            } else {
                return redirect()->back()->withErrors(['name' => 'This surgery designation is already active.']);
            }
        }

        // সম্পূর্ণ নতুন নাম হলে ফ্রেশ এন্ট্রি ডাটাবেজে লক ভাই
        SurgeryType::create([
            'name' => $nameInput,
            'sort_order' => $sortOrder,
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'New surgery designation registered successfully!');
    }
    /**
     * 🎯 ৩. ওয়ান-ক্লিক ডাটা মডিফিকেশন আপডেট মেথড ভাই
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'required|integer'
        ]);

        $type = SurgeryType::findOrFail($id);
        
        // এডিট করার সময় অন্য কোনো সচল রেকর্ডের নামের সাথে ডুপ্লিকেট হচ্ছে কি না তা ভেরিফিকেশন ভাই
        $duplicateCheck = SurgeryType::where('name', trim($request->input('name')))
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->exists();

        if ($duplicateCheck) {
            return redirect()->back()->withErrors(['name' => 'Another active designation already reserves this specific name.']);
        }

        $type->update([
            'name' => trim($request->input('name')),
            'sort_order' => $request->input('sort_order')
        ]);

        return redirect()->back()->with('success', 'Surgery type configurations updated successfully.');
    }

    /**
     * 🎯 🔒 ৪. আপনার কন্ডিশন: ডাটাবেজ থেকে মুছে না ফেলে ব্যাকগ্রাউন্ডে সফ্ট-ডিলিট (status = 0) করার গেট ভাই
     */
    public function destroy($id)
    {
        $type = SurgeryType::findOrFail($id);
        
        // 👑 ডাটাবেজ থেকে ডিরেক্ট DROP না করে শুধু স্ট্যাটাস ০ করে হাইড করা হলো ভাই
        $type->update(['status' => 0]);

        return redirect()->back()->with('success', 'Surgery designation status safely revoked to inactive mode.');
    }
}
