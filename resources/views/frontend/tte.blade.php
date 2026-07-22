@extends('layouts.app')

{{-- 👑 আল্ট্রা-স্মার্ট আন্তর্জাতিক অ্যাকাডেমিক টাইটেল লক ভাই --}}
@section('title', 'Transthoracic Echocardiography (TTE) Registry | BACTA')

{{-- 👑 ফন্টওসাম ৬.৭.২ এর লেটেস্ট লাইব্রেরি মেগা শিল্ড পুশ নোড ভাই --}}
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')

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

{{-- 👑 পুরো কন্টেন্ট মাঝ বরাবর (Center) সোজা লক রাখার মেইন কন্টেইনার ভাই --}}
<div class="container py-5 mx-auto animate__animated animate__fadeIn" style="font-family: 'Poppins', sans-serif; max-width: 1200px;">
    
    <!-- লাক্সারি অ্যাকাডেমিক ব্যানার জোন ভাই -->
    <div class="row mb-5 text-center justify-content-center">
        <div class="col-12 border-b pb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Cardiology Imaging Registries</span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 26px; letter-spacing: 0.5px;">
                Transthoracic Echocardiography (TTE)
            </h2>
            <p class="text-muted mx-auto mt-2 max-w-2xl" style="font-size: 13px; color: #64748b;">
                Standardized diagnostic criteria and perioperative imaging guidelines for non-invasive cardiovascular assessment and real-time hemodynamic monitoring.
            </p>
        </div>
    </div>

    <!-- ক্লিনিক্যাল ওভারভিউ সেকশন ভাই -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4">
            <span class="badge bct-academic-badge px-3 py-1.5 mb-3">Core Modality Overview</span>
            <h3 class="font-weight-bold mb-3" style="color: #00496A; font-size: 20px;">Primary Non-Invasive Cardiac Assessment</h3>
            <p class="text-secondary leading-relaxed" style="font-size: 14px; color: #334155; text-align: justify;">
                Transthoracic Echocardiography (TTE) remains the cornerstone of non-invasive cardiac imaging, providing critical qualitative and quantitative data regarding cardiac morphology, continuous valvular kinetics, and global chamber dynamics. Utilizing advanced high-frequency acoustic ultrasound transducers, TTE delivers multi-planar tomographic mapping of the myocardial architecture.
            </p>
            <p class="text-secondary leading-relaxed mt-2" style="font-size: 14px; color: #334155; text-align: justify;">
                This modality is essential for pre-anesthetic cardiovascular optimization, enabling clinicians to establish precise baselines for ejection fraction (LVEF), regional wall motion abnormalities (RWMA), and sub-valvular structural integrity before shifting patients into cardiac theaters.
            </p>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="p-4 rounded-2xl border" style="background: #f8fafc; border-color: #e2e8f0;">
                <h5 class="font-weight-bold mb-3" style="color: #00496A; font-size: 15px;"><i class="fas fa-stethoscope text-info mr-2"></i> Standard Diagnostic Multi-Planes</h5>
                <ul class="bct-protocol-list p-0 m-0">
                    <li><strong>Parasternal Long-Axis (PLAX):</strong> Valuation of the proximal aorta, anterior mitral leaflet, and posterior wall kinetics.</li>
                    <li><strong>Parasternal Short-Axis (PSAX):</strong> Cross-sectional regional wall tracking at the papillary muscle and apex thresholds.</li>
                    <li><strong>Apical Four-Chamber (A4C):</strong> Definitive tracking of left/right ventricular volumetric geometry and stroke volumes.</li>
                    <li><strong>Subcostal Four-Chamber View:</strong> Optimal diagnostic gate for pericardial effusions and inter-atrial septal anomalies.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ২: CLINICAL INDICATIONS MATRIX (মেডিকেল ইন্ডিকেশন গ্রিড ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Evidence-Based Protocols</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-clipboard-check text-success mr-2"></i> Clinical Indications for TTE
            </h4>
        </div>

        <!-- কার্ড ১: ভালভুলার হার্ট ডিজিজ -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #eff6ff; width: 42px; height: 42px;">
                        <i class="fas fa-heartbeat text-primary" style="font-size: 18px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Valvular Heart Disease</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Comprehensive quantification of fibro-calcific stenosis and regurgitant jets utilizing color Doppler mapping. Critical for calculating continuous aortic valve area (AVA) and determining surgical intervention windows for native leaflet reconstructions.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ২: কার্ডিওমায়োপ্যাথি ও এলভি ড্রাইভ -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #f0fdf4; width: 42px; height: 42px;">
                        <i class="fas fa-chart-line text-success" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Chamber Volumetrics</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Quantitative assessment of dilated, hypertrophic, or restrictive cardiomyopathies. Enables tracing of left ventricular end-diastolic volumes (LVEDV) and calculation of globally indexed ejection fraction via Modified Simpson’s biplane rule.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ৩: পেরিওপারেটিভ স্ক্রিনিং -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #fff7ed; width: 42px; height: 42px;">
                        <i class="fas fa-shield-alt text-warning" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Perioperative Screening</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Pre-anesthetic evaluation to rule out sub-clinical systolic or diastolic ventricular failure, pulmonary arterial hypertension (PAH), or occult intra-cardiac shunts, mitigating intraoperative cardiovascular decompensation.
                </p>
            </div>
        </div>
    </div>

    <!-- ==========================================
         🏛️ SECTION ৩: HEMODYNAMIC QUANTIFICATION MATRIX
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; border-left: 5px solid #00ADEF !important;">
                <div class="card-body p-4 bg-white">
                    <h4 class="font-weight-bold mb-3" style="color: #00496A; font-size: 16px;">
                        <i class="fas fa-calculator text-info mr-2"></i> Standard Hemodynamic Quantification Matrix
                    </h4>
                    <p class="text-muted small mb-4">Core echocardiographic equations used globally by clinical registries to calculate pressure gradients and structural valve areas.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover border text-sm m-0">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="font-weight: 700;">Clinical Assessment Target</th>
                                    <th style="font-weight: 700;">Standard Echo Equation / Methodology</th>
                                    <th style="font-weight: 700;">Physiological Normal Range</th>
                                    <th style="font-weight: 700;">Critical Thresholds</th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary" style="font-size: 13px;">
                                <tr>
                                    <td class="font-weight-bold text-dark">Transvalvular Pressure Gradient</td>
                                    <td>Simplified Bernoulli Equation: <code class="px-2 py-0.5 rounded bg-light text-danger font-weight-bold">ΔP = 4v²</code></td>
                                    <td>Varies by valve orifice</td>
                                    <td class="text-danger font-weight-bold">Mean Gradient > 40 mmHg (Severe AS)</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Aortic Valve Area (AVA)</td>
                                    <td>Continuity Equation: <code class="px-2 py-0.5 rounded bg-light text-danger font-weight-bold">A₁v₁ = A₂v₂</code></td>
                                    <td>3.0 – 4.0 cm²</td>
                                    <td class="text-danger font-weight-bold">AVA < 1.0 cm² (Severe Stenosis)</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">RV Systolic Pressure (RVSP)</td>
                                    <td>TR Jet Velocity + Estimated RA Pressure</td>
                                    <td>< 35 mmHg</td>
                                    <td class="text-danger font-weight-bold">RVSP > 50 mmHg (Severe Pulm. HTN)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ৪: ACADEMIC REGISTRY & GUIDELINES REFERENCING
         ========================================== -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#64748b] tracking-wider block mb-1" style="font-size: 10px; color: #94a3b8; font-weight: 800;">Academic Compliance Registry</span>
            <h5 class="font-weight-bold text-uppercase m-0" style="color: #475569; font-size: 16px; letter-spacing: 0.5px;">
                <i class="fas fa-book-reader text-secondary mr-2"></i> Referenced Imaging Guidelines
            </h5>
        </div>

        <div class="col-12">
            <div class="p-4 rounded-2xl bg-white border border-dashed text-secondary" style="border-color: #cbd5e1 !important; font-size: 13px; line-height: 1.6;">
                <div class="d-flex items-start mb-2" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ASE/EACVI</span>
                    <p class="m-0 text-muted"><strong>Chamber Quantification Criteria:</strong> Aligned with the American Society of Echocardiography (ASE) and the European Association of Cardiovascular Imaging (EACVI) dynamic consensus ledgers.</p>
                </div>
                <div class="d-flex items-start" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">AHA/ACC</span>
                    <p class="m-0 text-muted"><strong>Valvular Heart Disease Guidelines:</strong> Structural threshold criteria calibrated strictly with the current American Heart Association (AHA) and American College of Cardiology (ACC) task force parameters.</p>
                </div>
            </div>
        </div>
    </div>

</div> {{-- container closure end --}}
@endsection
