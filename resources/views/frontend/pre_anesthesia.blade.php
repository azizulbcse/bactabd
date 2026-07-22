@extends('layouts.app')

@section('title', 'Pre-Anesthesia Cardiovascular Evaluation Registry | BACTA')

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
            font-family: "Font Awesome 5 Free";
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
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Perioperative Risk Optimization</span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                Pre-Anesthesia Checkup (PAC)
            </h2>
            <p class="text-muted mx-auto mt-2 max-w-2xl" style="font-size: 13px; color: #64748b;">
                Systematic preoperative stratifications, baseline cardiovascular investigations, and patient optimization pathways prior to major cardiothoracic surgical interventions.
            </p>
        </div>
    </div>

    <!-- ক্লিনিক্যাল ওভারভিউ সেকশন ভাই -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4">
            <span class="badge bct-academic-badge px-3 py-1.5 mb-3">Preoperative Optimization</span>
            <h3 class="font-weight-bold mb-3" style="color: #00496A; font-size: 20px;">Cardiovascular Risk Stratification & Screening</h3>
            <p class="text-secondary leading-relaxed" style="font-size: 14px; color: #334155; text-align: justify;">
                The Pre-Anesthesia Checkup (PAC) serves as the primary gateway for neutralizing perioperative cardiovascular risks. For patients scheduled to undergo complex open-heart surgery, thorough pre-anesthetic optimization is paramount. It involves a systematic evaluation of coronary reserves, ventricular thresholds, and co-morbid profiles.
            </p>
            <p class="text-secondary leading-relaxed mt-2" style="font-size: 14px; color: #334155; text-align: justify;">
                This comprehensive screening allows the cardiac anesthesia team to anticipate hemodynamic instabilities during induction, plan precise mechanical ventilatory targets, and optimize hematocrit levels to minimize bypass complications.
            </p>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="p-4 rounded-2xl border" style="background: #f8fafc; border-color: #e2e8f0;">
                <h5 class="font-weight-bold mb-3" style="color: #00496A; font-size: 15px;"><i class="fas fa-file-medical text-info mr-2"></i> Mandatory PAC Screening Protocols</h5>
                <ul class="bct-protocol-list p-0 m-0">
                    <li><strong>Detailed History & Airway Review:</strong> Prediction of difficult intubation markers and chronic airway hyper-responsiveness.</li>
                    <li><strong>Cardiovascular Optimization Ledger:</strong> Evaluation of dynamic medication targets including beta-blockers and antiplatelet drugs.</li>
                    <li><strong>Metabolic & Renal Clearance Audits:</strong> Baseline tracking of glomerular filtration rates (eGFR) and continuous hemoglobin levels.</li>
                    <li><strong>Cross-Consultation Clearances:</strong> Consolidated clearance parameters from primary cardiologists and sub-specialists.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ২: CARDIOVASCULAR RISK CRITERIA GRIDS
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Evidence-Based Screenings</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-heart-circle-exclamation text-danger mr-2"></i> Clinical Risk Stratification Drivers
            </h4>
        </div>

        <!-- 🔬 কার্ড ১: মায়োকার্ডিয়াল রিজার্ভ টেস্ট -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #eff6ff; width: 42px; height: 42px;">
                        <i class="fas fa-gauge-high text-primary" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Functional Capacity (METs)</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Quantitative profiling of the patient's metabolic equivalents (METs). Assessment of whether the cardiopulmonary reserve is greater than 4 METs to withstand the physical stress of extracorporeal bypass loops without severe ischemia.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ২: ফ্রেমওয়ার্ক রিস্ক ইনডেক্স -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #f0fdf4; width: 42px; height: 42px;">
                        <i class="fas fa-list-check text-success" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Revised Cardiac Risk Index</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Calibrated application of the Lee RCRI parameters. Meticulous monitoring of continuous variables such as high-risk surgical types, history of ischemic heart disease, cerebrovascular episodes, and preoperative serum creatinine levels.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ৩: হেমাটোলজি ও জমাট বাধা ট্র্যাকিং -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #fff7ed; width: 42px; height: 42px;">
                        <i class="fas fa-droplet text-warning" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Coagulation Pathways</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Advanced preoperative profiling of patient clotting kinetics. Critical auditing of the exact timing for withholding antiplatelet agents (e.g., Clopidogrel, Ticagrelor) and oral anticoagulants to manage post-bypass hemorrhage risks.
                </p>
            </div>
        </div>
    </div>

    <!-- ==========================================
         🏛️ SECTION ৩: DIAGNOSTIC TESTING MATRIX
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; border-left: 5px solid #00ADEF !important;">
                <div class="card-body p-4 bg-white">
                    <h4 class="font-weight-bold mb-3" style="color: #00496A; font-size: 16px;">
                        <i class="fas fa-chart-bar text-info mr-2"></i> Preoperative Diagnostic Investigation Benchmarks
                    </h4>
                    <p class="text-muted small mb-4">Standard objective investigations required during the PAC node to formulate a secure anesthetic map.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover border text-sm m-0">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="font-weight: 700;">Diagnostic Investigation</th>
                                    <th style="font-weight: 700;">Target Clinical Target Marker</th>
                                    <th style="font-weight: 700;">Anesthetic Optimization Goal</th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary" style="font-size: 13px;">
                                <tr>
                                    <td class="font-weight-bold text-dark">12-Lead Electrocardiogram (ECG)</td>
                                    <td>Ischemic changes, Q-waves, pathological arrhythmias, QT-interval limits.</td>
                                    <td>Identification of acute ischemia; rate control optimization for tachyarrhythmias.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Chest Radiography (CXR)</td>
                                    <td>Cardiomegaly indices, severe pulmonary congestion, aortic calcification zones.</td>
                                    <td>Optimization of pulmonary fluid dynamics; prediction of difficult vascular cannulation.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Complete Blood Profile & Renal Panel</td>
                                    <td>Hemoglobin thresholds, platelet count, serum electrolytes, Creatinine/eGFR levels.</td>
                                    <td>Correction of pre-op anemia (Target Hb &gt; 10 g/dL); normalization of potassium parameters.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ৪: CLINICAL COMPLIANCE & REFERENCING
         ========================================= -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#64748b] tracking-wider block mb-1" style="font-size: 10px; color: #94a3b8; font-weight: 800;">Academic Compliance Registry</span>
            <h5 class="font-weight-bold text-uppercase m-0" style="color: #475569; font-size: 16px; letter-spacing: 0.5px;">
                <i class="fas fa-book-reader text-secondary mr-2"></i> Referenced Preoperative Guidelines
            </h5>
        </div>

        <div class="col-12">
            <div class="p-4 rounded-2xl bg-white border border-dashed text-secondary" style="border-color: #cbd5e1 !important; font-size: 13px; line-height: 1.6;">
                <div class="d-flex items-start mb-2" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ESAIC/ASA</span>
                    <p class="m-0 text-muted"><strong>Preoperative Risk Assessment:</strong> Clinical evaluation models are fully aligned with the European Society of Anaesthesiology and Intensive Care (ESAIC) and the American Society of Anesthesiologists (ASA) preoperative screening registries.</p>
                </div>
                <div class="d-flex items-start" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ESC/ESA</span>
                    <p class="m-0 text-muted"><strong>Non-Cardiac Surgery Optimization:</strong> Calibration parameters for active cardiac disease management strictly match the current European Society of Cardiology (ESC) consensus task force standards.</p>
                </div>
            </div>
        </div>
    </div>

</div> {{-- container closure end --}}
@endsection
