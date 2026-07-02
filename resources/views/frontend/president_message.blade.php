<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

@extends('layouts.app')

@section('title', "President's Message | BACTA Bangladesh")

@section('content')
    <!-- 🚀 ১. আপনার About Us পেজ থেকে নেওয়া প্রিমিয়াম ডার্ক হেডার ব্যানার (টেলউইন্ড সিঙ্কড) -->
    <header class="bg-[#0F172A] relative overflow-hidden py-16 border-b border-slate-800 w-full text-left">
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(2,132,199,0.3),transparent_70%)]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#38BDF8] uppercase block mb-2">Executive Address</span>
                <h1 class="text-3xl lg:text-4xl font-black tracking-tight text-white">President's Message</h1>
            </div>
            <div class="flex items-center space-x-2 text-xs font-medium text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <svg class="w-3 h-3 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-200">President's Desk</span>
            </div>
        </div>
    </header>

    <!-- 🚀 ২. ২-কলাম গর্জিয়াস স্প্লিট লেআউট সিএসএস থিম (NHCS স্ট্যান্ডার্ড) -->
    <style>
        .president-body-wrapper {
            background-color: #F8FAFC;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 60px 0;
        }

        .bacta-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* ১টি সারিতে ২টি সমান ও রেসপনসিভ কলামের মেইন স্প্লিট গ্রিড */
        .split-layout-grid {
            display: flex;
            flex-direction: row;
            gap: 40px;
            align-items: flex-start;
        }

        /* 🎯 বাম পাশের কলাম: ডাক্তারের প্রোফাইল ইআরপি শ্যাডো কার্ড */
        .profile-card-left {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.05);
            width: 35%; /* কলামের পারফেক্ট ব্যালেন্স উইডথ লক ভাই */
            box-sizing: border-box;
            position: relative;
        }

        .profile-card-left::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 5px;
            background: linear-gradient(90deg, #1E40AF, #0284C7);
        }

        /* ওফিসিয়াল সার্কেল ফ্রেমের বৃত্তাকার প্রোফাইল ছবি */
        .president-avatar-frame {
            width: 160px;
            height: 160px;
            margin: 0 auto 24px;
            border-radius: 50%;
            padding: 5px;
            background: linear-gradient(135deg, #1E40AF 0%, #0284C7 100%);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.15);
        }

        .president-avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #ffffff;
            background-color: #F1F5F9;
        }

        .president-avatar-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .president-name-title {
            color: #0F172A;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 8px 0;
            letter-spacing: -0.25px;
        }

        .president-med-designation {
            color: #64748B;
            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .president-badge-tag {
            display: inline-block;
            background: linear-gradient(135deg, #1E40AF 0%, #0284C7 100%);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 18px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2);
        }
    </style>
    <style>
        /* 🎯 ডান পাশের কলাম: সভাপতির মূল বাণী জোন */
        .speech-content-right {
            background: #ffffff;
            border-radius: 16px;
            padding: 45px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 30px -5px rgba(148, 163, 184, 0.04);
            width: 65%; /* কলামের পারফেক্ট ব্যালেন্স উইডথ লক */
            box-sizing: border-box;
            position: relative;
        }

        /* প্রিমিয়াম ওপেনিং কোটেশন আইকন (`"`) */
        .quote-icon-decor {
            position: absolute;
            top: 20px;
            right: 35px;
            font-size: 80px;
            color: rgba(30, 64, 175, 0.05);
            font-family: 'Georgia', serif;
            line-height: 1;
            user-select: none;
        }

        .speech-text-p {
            font-size: 14.5px;
            line-height: 1.8;
            color: #334155;
            margin-bottom: 20px;
            text-align: justify;
            font-weight: 500;
        }

        /* বাণীর গুরুত্বপূর্ণ হাইলাইটেড শব্দ */
        .speech-highlight-word {
            color: #1E40AF;
            font-weight: 600;
        }

        /* 📱 ১০০% মোবাইল ও ট্যাবলেট রেসপন্সিভ মিডিয়া কোয়েরি */
        @media (max-width: 991px) {
            .split-layout-grid {
                flex-direction: column;
                align-items: center;
            }
            .profile-card-left, .speech-content-right {
                width: 100%;
                max-width: 100%;
            }
            .speech-content-right {
                padding: 30px;
            }
            .quote-icon-decor {
                top: 10px;
                right: 20px;
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
<div class="president-body-wrapper">
    <div class="bacta-container">

        <div class="split-layout-grid">
            
            <!-- 🎯 বাম পাশের কলাম: সভাপতির ওফিসিয়াল প্রোফাইল কার্ড -->
            <div class="profile-card-left">
                <div class="president-avatar-frame">
                    <div class="president-avatar-inner">
                        {{-- এখানে সভাপতির ছবি ডাইনামিক বা এন্ট্রি সোর্স পাথ অনুযায়ী রেন্ডার হবে --}}
                        <img src="{{ asset('storage/committee_pics/president.jpg') }}" alt="Prof. A. T. M. Khalilur Rahman" onerror="this.onerror=null; this.src='https://unsplash.com';">
                    </div>
                </div>
                <h2 class="president-name-title">Prof. A. T. M. Khalilur Rahman</h2>
                <div class="president-med-designation">
                    Professor & Head<br>
                    <span class="text-slate-500 font-medium">Cardiac Anesthesia</span><br>
                    <span class="speech-highlight-word">National Heart Foundation Hospital & Research Institute</span>
                </div>
                <div><span class="president-badge-tag"><i class="fas fa-award mr-1"></i> Society President</span></div>
            </div>

            <!-- 🎯 ডান পাশের কলাম: সভাপতির মূল বক্তব্য জোন -->
            <div class="speech-content-right">
                <div class="quote-icon-decor">“</div>
                
                <p class="speech-text-p">
                    At the very beginning I express my gratitude to Almighty Allah for enabling us to hold this conference <span class="speech-highlight-word">BACTA-2012</span>. It is indeed a great honor and proud privilege for me to welcome you on behalf of the organizing committee of the 1st BACTA National Conference at the <span class="speech-highlight-word">National Heart Foundation Hospital</span> of Bangladesh.
                </p>

                <p class="speech-text-p">
                    I must express my sincere gratitude to all our members for giving me this opportunity to serve the society as adhoc president. BACTA is now a new born association & we have to go a long way to develop it. As a Founder Member and President of the Society, I feel immensely ambitious that <span class="speech-highlight-word">BACTA</span> will serve its purpose for which it is created. The Society will hold regular Conferences, Workshops and Symposia to highlight important clinical and research issues in our specialty.
                </p>

                <p class="speech-text-p">
                    This conference aims primarily to upgrade academic standards, to promote friendly relationship and exchange of advanced knowledge and cutting edge information among the <span class="speech-highlight-word">Cardiovascular & Thoracic Anesthesiologists</span>.
                </p>
                <p class="speech-text-p">
                    As we all are aware that the cardiac patient profile is changing very fast so also the approach and methodology dealing with them. Their dynamic nature has increased the role of <span class="speech-highlight-word">Cardiac Thoracic Anesthesiologists</span> beyond the operation theater, in the form of dealing with patients with acute coronary syndrome, primary angioplasty, device closure etc.
                </p>

                <p class="speech-text-p">
                    The rapid strides in emerging technologies have brought forth new challenges for the Anesthesiologists. New and unique application of equipments are to be acquired and mastered in keeping with the present and the future needs.
                </p>

                <p class="speech-text-p" style="margin-bottom: 0;">
                    I honestly solicit your participation in this congress. Once again I welcome you on behalf of organizing committee to the 1st BACTA Conference.
                </p>
                
                {{-- ওফিসিয়াল সিগনেচার এলাইনমেন্ট জোন --}}
                <div style="margin-top: 35px; border-top: 1px dashed #E2E8F0; padding-top: 20px; text-align: right;">
                    <h4 style="color: #0F172A; font-weight: 700; margin: 0; font-size: 15px;">Prof. A. T. M. Khalilur Rahman</h4>
                    <p style="color: #64748B; font-size: 12.5px; margin: 2px 0 0 0; font-weight: 500;">Founder Member & President, BACTA</p>
                </div>
            </div>

        </div> {{-- .split-layout-grid ক্লোজিং --}}

    </div> {{-- .bacta-container ক্লোজিং --}}
</div> {{-- .president-body-wrapper ক্লোজিং --}}
</body>
</html>
@endsection
