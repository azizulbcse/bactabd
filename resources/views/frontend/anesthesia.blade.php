{{-- 👑 ফ্রন্টএন্ড মাস্টার লেআউট এক্সটেন্ড নোড (আপনার ওরিজিনাল প্রিমিয়াম থিম সিঙ্কд) --}}
@extends('layouts.app')

{{-- 👑 আল্ট্রা-স্মার্ট আন্তর্জাতিক ক্লিনিক্যাল টাইটেল লক ভাই --}}
@section('title', 'Intraoperative Cardiac Anesthesia Management | BACTA')

{{-- 👑 ফন্টওসাম ৬.৭.২ এর লেটেস্ট লাইব্রেরি মেগা শিল্ড পুশ নোড ভাই --}}
@push('css')
    <link rel="stylesheet" href="https://cloudflare.com" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bct-clinical-card {
            border: none !important;
            border-radius: 16px !important;
            background: #ffffff !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02) !important;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .bct-clinical-card:hover {
            transform: translateY(-5px);
            border-color: #00ADEF !important;
            box-shadow: 0 15px 35px rgba(0, 73, 106, 0.08) !important;
        }
        .bct-academic-badge {
            background: #f0f9ff;
            color: #0284C7;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 20px;
        }
        .bct-protocol-list li {
            position: relative;
            padding-left: 24px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #475569;
            list-style: none;
        }
        .bct-protocol-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            color: #00ADEF;
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
{{-- 👑 পুরো কন্টেন্ট মাঝ বরাবর (Center) সোজা লক রাখার মেইন কন্টেইনার ভাই --}}
<div class="container py-5 mx-auto animate__animated animate__fadeIn" style="font-family: 'Poppins', sans-serif; max-width: 1200px;">
    
    <!-- লাক্সারি অ্যাকাডেমিক ব্যানার জোন ভাই (মাঝ বরাবর সেন্টারেড লক) -->
    <div class="row mb-5 text-center justify-content-center">
        <div class="col-12 border-b pb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Intraoperative Care & Cardiopulmonary Bypass</span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                Cardiac Anesthesia Management
            </h2>
            <p class="text-muted mx-auto mt-2 max-w-2xl" style="font-size: 13px; color: #64748b;">
                Advanced real-time hemodynamic profiling, pharmacology kinetics, and neuro-protective monitoring strategies during major open-heart procedures.
            </p>
        </div>
    </div>

    <!-- ক্লিনিক্যাল ওভারভিউ সেকশন ভাই -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4">
            <span class="badge bct-academic-badge px-3 py-1.5 mb-3">Intraoperative Physiology</span>
            <h3 class="font-weight-bold mb-3" style="color: #00496A; font-size: 20px;">Hemodynamic Stability & Cardiopulmonary Bypass (CPB)</h3>
            <p class="text-secondary leading-relaxed" style="font-size: 14px; color: #334155; text-align: justify;">
                Intraoperative Cardiac Anesthesia demands a sophisticated synthesis of advanced pharmacology and real-time physiological data interpretation. As the patient transit onto the Cardiopulmonary Bypass (CPB) machine, the cardiac anesthesia team maintains precise control over systemic vascular resistance, fluid balancing, and critical macro/micro-circulatory parameters to preserve vital organ perfusion.
            </p>
            <p class="text-secondary leading-relaxed mt-2" style="font-size: 14px; color: #334155; text-align: justify;">
                This node encapsulates elite anesthetic maintenance, rigorous myocardial protection pathways using precise cardioplegia titrations, and strategic systemic heparinization workflows crucial for mechanical circulation safety.
            </p>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="p-4 rounded-2xl border" style="background: #f8fafc; border-color: #e2e8f0;">
                <h5 class="font-weight-bold mb-3" style="color: #00496A; font-size: 15px;"><i class="fas fa-microscope text-info mr-2"></i> Advanced Intraoperative Core Standards</h5>
                <ul class="bct-protocol-list p-0 m-0">
                    <li><strong>Targeted Hemodynamic Profiling:</strong> Continuous monitoring of mean arterial pressure (MAP) and systemic vascular resistance index (SVRI).</li>
                    <li><strong>Rigorous Myocardial Protection:</strong> Delivery of blood or crystalloid cardioplegia to induce optimal diastolic arrest.</li>
                    <li><strong>Anticoagulation Mastery & Reversal:</strong> Automated clotting time (ACT) auditing for heparin delivery and precision Protamine titration.</li>
                    <li><strong>Multimodal Neuromonitoring:</strong> Real-time cerebral oximetry (NIRS) tracking to minimize occult post-bypass neuro-cognitive events.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ২: INTRAOPERATIVE MONITORING MATRIX (মেডিকেল ইন্ডিকেশন গ্রিড ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Real-Time Theater Tracking</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-desktop text-success mr-2"></i> Advanced Intraoperative Monitoring Core
            </h4>
        </div>

        <!-- 🔬 কার্ড ১: ইনভেসিভ আর্টেরিয়াল প্রেসার লাইন -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #eff6ff; width: 42px; height: 42px;">
                        <i class="fas fa-wave-square text-primary" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Invasive Hemodynamics</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Continuous beat-to-beat radial or femoral arterial pressure tracing matched with central venous pressure (CVP) tracking. Critical for determining instant myocardial wall stress and titration thresholds of intensive inotropic supports.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ২: পালমোনারি আর্টারি ক্যাথেটার মেকানিজম -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #f0fdf4; width: 42px; height: 42px;">
                        <i class="fas fa-arrow-trend-up text-success" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Pulmonary Artery Profiling</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Strategic deployment of Swan-Ganz catheters to evaluate core variables including pulmonary capillary wedge pressure (PCWP), mixed venous oxygen saturation (SvO₂), and dynamic thermodilution cardiac output logs.
                </p>
            </div>
        </div>

        <!-- 🔬カード ৩: মেটাবলিক এবং অম্ল-ক্ষার ভারসাম্য ট্র্যাক -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #fff7ed; width: 42px; height: 42px;">
                        <i class="fas fa-flask-vial text-warning" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Metabolic & ABG Audits</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Rigorous serial tracking of arterial blood gases (ABG) during different bypass perfusion phases. Essential for tracking acid-base balance, systemic lactate trends, and calculating continuous shunt fractions.
                </p>
            </div>
        </div>
    </div>

    <!-- ==========================================
         🏛️ SECTION ৩: CPB PHYSIOLOGICAL TARGET MATRIX (ফিজিওলজিক্যাল ম্যাট্রিক্স টেবিল ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; border-left: 5px solid #00496A !important;">
                <div class="card-body p-4 bg-white">
                    <h4 class="font-weight-bold mb-3" style="color: #00496A; font-size: 16px;">
                        <i class="fas fa-sliders text-info mr-2"></i> Cardiopulmonary Bypass (CPB) Target Parameters
                    </h4>
                    <p class="text-muted small mb-4">Standard objective physiological parameters maintained by the perfusion and cardiac anesthesia team during extracorporeal loop cycles.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover border text-sm m-0">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="font-weight: 700;">Physiological Target Parameter</th>
                                    <th style="font-weight: 700;">Clinical Standard Control Range</th>
                                    <th style="font-weight: 700;">Anesthetic Management Goal</th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary" style="font-size: 13px;">
                                <tr>
                                    <td class="font-weight-bold text-dark">Mean Arterial Pressure (MAP) on Pump</td>
                                    <td>50 – 80 mmHg</td>
                                    <td>Ensures safe cerebral perfusion pressure; managed via phenylephrine or volatile anesthetic titrations.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Activated Clotting Time (ACT)</td>
                                    <td>&gt; 480 Seconds</td>
                                    <td>Mandatory baseline anticoagulation threshold achieved prior to continuous aortic cannulation sequence.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Systemic Temperature (Hypothermia Zone)</td>
                                    <td>32°C – 34°C (Mild) / 28°C – 30°C (Moderate)</td>
                                    <td>Reduces cellular oxygen demand; requires strategic propofol/midazolam titration to maintain burst suppression.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ৪: ACADEMIC COMPLIANCE & REFERENCING
         ========================================= -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#64748b] tracking-wider block mb-1" style="font-size: 10px; color: #94a3b8; font-weight: 800;">Academic Compliance Registry</span>
            <h5 class="font-weight-bold text-uppercase m-0" style="color: #475569; font-size: 16px; letter-spacing: 0.5px;">
                <i class="fas fa-book-reader text-secondary mr-2"></i> Referenced Intraoperative Management Guidelines
            </h5>
        </div>

        <div class="col-12">
            <div class="p-4 rounded-2xl bg-white border border-dashed text-secondary" style="border-color: #cbd5e1 !important; font-size: 13px; line-height: 1.6;">
                <div class="d-flex items-start mb-2" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">SCA/EACTAIC</span>
                    <p class="m-0 text-muted"><strong>Cardiopulmonary Bypass Standards:</strong> Intraoperative monitoring and management pathways comply strictly with the Society of Cardiovascular Anesthesiologists (SCA) and the European Association of Cardiothoracic Anaesthesiology and Intensive Care (EACTAIC) clinical consensus ledgers.</p>
                </div>
                <div class="d-flex items-start" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ASA/AHA</span>
                    <p class="m-0 text-muted"><strong>Hemodynamic Control Thresholds:</strong> Perfusion safety matrix and blood preservation parameters are calibrated according to the current American Society of Anesthesiologists (ASA) task force criteria.</p>
                </div>
            </div>
        </div>
    </div>

</div> {{-- container closure end --}}
@endsection
