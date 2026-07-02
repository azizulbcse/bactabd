@extends('layouts.app')

@section('content')

<div class="py-8 md:py-12 bacta-custom-nav-font">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-[#1A4B84] text-white rounded-2xl p-6 md:p-10 shadow-xl relative overflow-hidden mb-8 border border-white/10">
            <div class="relative z-10 max-w-3xl">
                <span class="bg-[#00ADB5] text-white text-xs font-black uppercase tracking-wider px-3 py-1 rounded-full">Department</span>
                <h1 class="text-3xl md:text-5xl font-black tracking-wide mt-3 mb-4 text-[#93C5FD]">Cardiology Division</h1>
                <p class="text-sm md:text-base text-slate-200 leading-relaxed font-bold">
                    Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists (BACTA) এর অধীনে কার্ডিয়াক সায়েন্স এবং অ্যাডভান্সড পেশেন্ট কেয়ার ফোরাম।
                </p>
            </div>
            <div class="absolute -right-10 -bottom-10 opacity-10 text-white">
                <svg class="w-44 h-44 md:w-64 md:h-64" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
        </div>

        <!-- 🎯 মেইন ইনফরমেশন ৩-কলাম রেসপন্সিভ গ্রিড লেআউট ভাই -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- ক) বাম পাশের মেগা কন্টেন্ট উইন্ডো ভাই (২ কলাম চওড়া) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-md border border-slate-100">
                    <h2 class="text-xl md:text-2xl font-black text-[#1A4B84] mb-4 pb-2 border-b border-slate-100">Overview & Scientific Focus</h2>
                    <p class="text-sm md:text-base text-slate-600 leading-relaxed font-semibold mb-4">
                        কার্ডিয়াক অ্যানেশেসিয়া এবং ইনটেনসিভ কেয়ারের সাথে কার্ডিওলজির আন্তঃসম্পর্কিত উন্নত বৈজ্ঞানিক গবেষণা, সেমিনার এবং ক্লিনিক্যাল প্র্যাকটিস গাইডলাইন শেয়ার করার ওয়ান-স্টপ প্ল্যাটফর্ম।
                    </p>
                    <p class="text-sm md:text-base text-slate-600 leading-relaxed font-semibold">
                        এখানে দেশী-বিদেশী চিকিৎসকদের অভিজ্ঞতা এবং কার্ডিওভাসকুলার কেস স্টাডি নিয়মিত ক্যাটালগ আকারে পাবলিশ করা হবে।
                    </p>
                </div>
            </div>

            <!-- খ) ডান পাশের স্লিক ইনফো সাইডবার উইন্ডো ভাই (১ কলাম চওড়া) -->
            <div class="space-y-6">
                <div class="bg-[#00ADB5] text-white rounded-2xl p-6 shadow-md border border-cyan-600">
                    <h3 class="text-lg font-black mb-3 text-white">Quick Contacts</h3>
                    <p class="text-xs font-bold text-slate-100 leading-relaxed mb-4">
                        কার্ডিওথোরাসিক নোড বা গাইডলাইন নিয়ে যেকোনো তথ্যের জন্য সরাসরি বিএসিটিএ অফিসে যোগাযোগ করুন ভাই।
                    </p>
                    <a href="{{ route('contact.archive') }}" class="inline-flex w-full items-center justify-center bg-white text-[#0F172A] hover:bg-black hover:text-white rounded-xl py-2.5 text-xs font-black tracking-wide transition-all no-underline shadow-md">
                        Contact Department
                    </a>
                </div>
            </div>

        </div> {{-- .grid end ভাই --}}

    </div>
</div>
@endsection
