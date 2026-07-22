{{-- 👑 ফ্রন্টএন্ড মাস্টার লেআউট এক্সটেন্ড নোড (আপনার ওরিজিনাল প্রিমিয়াম থিম সিঙ্কড) --}}
@extends('layouts.app')

{{-- 👑 আপনার রিকোয়ারমেন্ট অনুযায়ী আল্ট্রা-স্মার্ট ও আন্তর্জাতিক অ্যাকাডেমিক টাইটেল লক ভাই --}}
@section('title', 'Transesophageal Echocardiography (TOE) Registry | BACTA')

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
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Perioperative & Surgical Imaging Registries</span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                Transesophageal Echocardiography (TOE)
            </h2>
            <p class="text-muted mx-auto mt-2 max-w-2xl" style="font-size: 13px; color: #64748b;">
                Advanced intraoperative imaging protocols, multi-planar esophageal views, and continuous structural assessments for real-time surgical guidance.
            </p>
        </div>
    </div>

    <!-- ক্লিনিক্যাল ওভারভিউ সেকশন ভাই -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4">
            <span class="badge bct-academic-badge px-3 py-1.5 mb-3">Surgical Modality Overview</span>
            <h3 class="font-weight-bold mb-3" style="color: #00496A; font-size: 20px;">High-Definition Semi-Invasive Cardiac Tracking</h3>
            <p class="text-secondary leading-relaxed" style="font-size: 14px; color: #334155; text-align: justify;">
                Transesophageal Echocardiography (TOE) is a critical semi-invasive diagnostic modality that bypasses thoracic acoustic barriers by positioning a specialized high-frequency ultrasound transducer directly within the esophagus and stomach. This close proximity to the posterior cardiac structures yields ultra-high-definition anatomical resolution.
            </p>
            <p class="text-secondary leading-relaxed mt-2" style="font-size: 14px; color: #334155; text-align: justify;">
                In the theater environment, TOE serves as the gold standard for real-time monitoring during complex valve repairs, congenital defect closures, and thoracic aortic interventions. It provides immediate post-bypass confirmation of surgical success or residual pathological shunts.
            </p>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="p-4 rounded-2xl border" style="background: #f8fafc; border-color: #e2e8f0;">
                <h5 class="font-weight-bold mb-3" style="color: #00496A; font-size: 15px;"><i class="fas fa-microscope text-info mr-2"></i> Standard Multi-Planar Esophageal Views</h5>
                <ul class="bct-protocol-list p-0 m-0">
                    <li><strong>Mid-Esophageal Four-Chamber View (0°):</strong> Uncompromised evaluation of the inter-atrial septum, atrioventricular valves, and biventricular function.</li>
                    <li><strong>Mid-Esophageal Mitral Commissural View (60°):</strong> Definitive tracking of P1, P3, and A2 mitral leaflet scallops for repair mapping.</li>
                    <li><strong>Mid-Esophageal Long-Axis View (120°):</strong> Precision profiling of the left ventricular outflow tract (LVOT) and aortic root dynamics.</li>
                    <li><strong>Transgastric Short-Axis View (90°):</strong> Real-time intraoperative tracking of global left ventricular ischemia and wall motion.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ২: INTRAOPERATIVE INDICATIONS MATRIX (মেডিকেল ইন্ডিকেশন গ্রিড ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Intraoperative Evidence Protocols</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-clipboard-check text-success mr-2"></i> Core Surgical Indications for TOE
            </h4>
        </div>

        <!-- 🔬 কার্ড ১: পেরিওপারেティブ ভালভুলার রিপেয়ার ট্র্যাক -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #eff6ff; width: 42px; height: 42px;">
                        <i class="fas fa-tools text-primary" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Mitral & Aortic Valve Repair</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Pre-procedural mapping of structural leaflet prolapse, chordal rupture, and calcification thresholds. Provides immediate post-bypass inspection to rule out residual regurgitant jets or systolic anterior motion (SAM) of the mitral leaflet.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ২: আওর্টিক ডিসেকশন এবং অ্যানিউরিজম -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #f0fdf4; width: 42px; height: 42px;">
                        <i class="fas fa-triangle-exclamation text-success" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Aortic Dissection Tracking</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Real-time visualization of intimal dissection flaps, true vs. false lumen kinematics, and structural involvement of the coronary ostia. Vital for guiding proximal aortic graft configurations within the operating theater.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ৩: অক্লুড এমবোলিজম ও সোর্স অফ থ্রম্বাস -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #fff7ed; width: 42px; height: 42px;">
                        <i class="fas fa-magnifying-glass text-warning" style="font-size: 16px;"></i>
                    </div>
                    <div class="flex-grow-1"><h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Embolic Source Evaluation</h5></div>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    High-resolution interrogation of the left atrial appendage (LAA) to rule out intracardiac thrombi, fibro-calcific vegetations, or patent foramen ovale (PFO) prior to surgical planning or percutaneous interventions.
                </p>
            </div>
        </div>
    </div>

    <!-- ==========================================
         🏛️ SECTION ৩: STRUCTURAL SURGICAL METRICS (সার্জনদের ডাটা ম্যাট্রিক্স টেবিল ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; border-left: 5px solid #ea580c !important;">
                <div class="card-body p-4 bg-white">
                    <h4 class="font-weight-bold mb-3" style="color: #00496A; font-size: 16px;">
                        <i class="fas fa-table text-warning mr-2"></i> Intraoperative Structural Quantification Matrix
                    </h4>
                    <p class="text-muted small mb-4">Echocardiographic target markers utilized by surgical teams during cardiopulmonary bypass exit windows.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover border text-sm m-0">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="font-weight: 700;">Surgical Assessment Parameter</th>
                                    <th style="font-weight: 700;">Intraoperative TOE Evaluation Plane</th>
                                    <th style="font-weight: 700;">Acceptable Repair Outcomes</th>
                                    <th style="font-weight: 700;">Surgical Re-intervention Alert</th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary" style="font-size: 13px;">
                                <tr>
                                    <td class="font-weight-bold text-dark">Mitral Leaflet Coaptation Length</td>
                                    <td>Mid-Esophageal Long-Axis View (120°)</td>
                                    <td>≥ 8.0 mm (Ensures structural durability)</td>
                                    <td class="text-danger font-weight-bold">Coaptation &lt; 4.0 mm / Residual Leak</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Aortic Valve Coaptation Height</td>
                                    <td>Mid-Esophageal Right Vent Outflow (45°)</td>
                                    <td>Above the annular plane line</td>
                                    <td class="text-danger font-weight-bold">Leaflet Prolapse / Eccentric AI Jet</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Prosthetic Valve Seating</td>
                                    <td>Interrogated across all Multi-Planes</td>
                                    <td>Zero paravalvular regurgitation (PVR)</td>
                                    <td class="text-danger font-weight-bold">PVR &gt; Mild / Severe Valvular Rocking</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ৪: SURGICAL COMPLIANCE & REFERENCING
         ========================================= -->
    <div class="row mt-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#64748b] tracking-wider block mb-1" style="font-size: 10px; color: #94a3b8; font-weight: 800;">Surgical Compliance Registry</span>
            <h5 class="font-weight-bold text-uppercase m-0" style="color: #475569; font-size: 16px; letter-spacing: 0.5px;">
                <i class="fas fa-book-reader text-secondary mr-2"></i> Referenced Intraoperative Guidelines
            </h5>
        </div>

        <div class="col-12">
            <div class="p-4 rounded-2xl bg-white border border-dashed text-secondary" style="border-color: #cbd5e1 !important; font-size: 13px; line-height: 1.6;">
                <div class="d-flex items-start mb-2" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ASE/SCA</span>
                    <p class="m-0 text-muted"><strong>Intraoperative Baseline Protocols:</strong> Multi-planar core mappings are fully compliant with the American Society of Echocardiography (ASE) and the Society of Cardiovascular Anesthesiologists (SCA) perioperative task force registries.</p>
                </div>
                <div class="d-flex items-start" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">EACTAIC</span>
                    <p class="m-0 text-muted"><strong>European Core Synergy:</strong> Calibrated strictly according to the European Association of Cardiothoracic Anaesthesiology and Intensive Care (EACTAIC) valvular assessment algorithms.</p>
                </div>
            </div>
        </div>
    </div>

</div> {{-- container closure end --}}
@endsection
