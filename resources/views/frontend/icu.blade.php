{{-- 👑 ফ্রন্টএন্ড মাস্টার লেআউট এক্সটেন্ড নোড (আপনার ওরিজিনাল প্রিমিয়াম থিম সিঙ্কড) --}}
@extends('layouts.app')

{{-- 👑 আল্ট্রা-স্মার্ট আন্তর্জাতিক ক্লিনিক্যাল টাইটেল লক ভাই --}}
@section('title', 'Postoperative Cardiothoracic Intensive Care Registry | BACTA')

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
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Post-Surgical Critical Care & Homeostasis</span>
            <h2 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 24px; letter-spacing: 0.5px;">
                CardioThoracic ICU (CT-ICU)
            </h2>
            <p class="text-muted mx-auto mt-2 max-w-2xl" style="font-size: 13px; color: #64748b;">
                Advanced postoperative hemodynamics stabilization, mechanical ventilation weaning matrices, and multi-organ protective strategies for cardiothoracic registries.
            </p>
        </div>
    </div>

    <!-- ক্লিনিক্যাল ওভারভিউ সেকশন ভাই -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4">
            <span class="badge bct-academic-badge px-3 py-1.5 mb-3">Critical Care Medicine</span>
            <h3 class="font-weight-bold mb-3" style="color: #00496A; font-size: 20px;">Advanced Postoperative Stabilization & Homeostasis</h3>
            <p class="text-secondary leading-relaxed" style="font-size: 14px; color: #334155; text-align: justify;">
                Management within the CardioThoracic Intensive Care Unit (CT-ICU) represents the final, critical bridge to successful structural recovery following major open-heart surgery. Upon transition from the operating theater, the immediate objective focuses on strategic hemodynamic titrations, micro-vascular fluid homeostasis, and the suppression of malignant postoperative reperfusion arrhythmias.
            </p>
            <p class="text-secondary leading-relaxed mt-2" style="font-size: 14px; color: #334155; text-align: justify;">
                This highly specialized node incorporates aggressive monitoring of continuous chest tube drainage, proactive prevention of acute kidney injury (AKI) post-pump, and structured respiratory weaning algorithms necessary for safe extubation windows.
            </p>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="p-4 rounded-2xl border" style="background: #f8fafc; border-color: #e2e8f0;">
                <h5 class="font-weight-bold mb-3" style="color: #00496A; font-size: 15px;"><i class="fas fa-kit-medical text-info mr-2"></i> Mandatory Postoperative ICU Targets</h5>
                <ul class="bct-protocol-list p-0 m-0">
                    <li><strong>Hemodynamic Optimization Flux:</strong> Tailored infusion of multi-channel inotropes (e.g., Milrinone, Epinephrine) and vasoconstrictors.</li>
                    <li><strong>Rigorous Chest Tube Auditing:</strong> Micro-surveillance of mediastinal and pleural drainage to detect acute surgical hemorrhage trends early.</li>
                    <li><strong>Advanced Ventilatory Weaning:</strong> Application of synchronous intermittent mechanical ventilation (SIMV) transitioning into pressure support modes.</li>
                    <li><strong>Metabolic & Electrolyte Homeostasis:</strong> Continuous, hourly correction of systemic potassium, magnesium, and localized glucose fluxes.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ==========================================
         🔬 SECTION ২: CRITICAL POSTOPERATIVE TARGETS MATRIX
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-12 mb-4">
            <span class="text-[11px] font-black uppercase text-[#0284C7] tracking-wider block mb-1" style="font-size: 11px; color: #0284C7; font-weight: 800;">Intensive Surveillance Protocols</span>
            <h4 class="font-weight-bold text-uppercase m-0" style="color: #00496A; font-size: 18px; letter-spacing: 0.5px;">
                <i class="fas fa-heart-pulse text-danger mr-2"></i> Postoperative Complication Counter-Measures
            </h4>
        </div>

        <!-- 🔬 কার্ড ১: ভেসোপ্রেসর ও ইনোট্রোপস টাইট্রেশন -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #eff6ff; width: 42px; height: 42px;">
                        <i class="fas fa-syringe text-primary" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Inotropic Support Flux</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Precision calibration of myocardial contractility using dynamic inotrope titrations. Prevents low cardiac output syndrome (LCOS) while protecting the fragile coronary graft anastomosis from harmful hypertensive spikes.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ২: কার্ডিয়াক টেম্পোনেড এবং ড্রেনেজ ট্র্যাকিং -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #f0fdf4; width: 42px; height: 42px;">
                        <i class="fas fa-droplet text-success" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Hemorrhage Surveillance</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Hourly macro-surveillance of mediastinal chest tube output. Sudden cessation of drainage combined with a drop in cardiac index triggers immediate protocol review to rule out life-threatening pericardial tamponade.
                </p>
            </div>
        </div>

        <!-- 🔬 কার্ড ৩: নিউরোলজিক্যাল ও সেডেশন উইন্ডো -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 p-4 bct-clinical-card">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 d-flex align-items-center justify-content-center mr-3" style="background: #fff7ed; width: 42px; height: 42px;">
                        <i class="fas fa-brain text-warning" style="font-size: 16px;"></i>
                    </div>
                    <h5 class="font-weight-bold m-0" style="color: #00496A; font-size: 15px;">Neuro-Protection Framework</h5>
                </div>
                <p class="text-muted small leading-relaxed" style="text-align: justify; font-size: 12.5px;">
                    Structured administration of sedation windows using Richmond Agitation-Sedation Scale (RASS) targets. Enables rapid evaluation of neurological reflexes to detect stroke or metabolic delirium post-bypass early.
                </p>
            </div>
        </div>
    </div>

    <!-- ==========================================
         🏛️ SECTION ৩: PHYSIOLOGICAL HOMEOSTASIS MATRIX (ফিজিওলজিক্যাল ম্যাট্রিক্স টেবিল ভাই)
         ========================================== -->
    <div class="row mb-5 animate__animated animate__fadeInUp">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; border-left: 5px solid #0284C7 !important;">
                <div class="card-body p-4 bg-white">
                    <h4 class="font-weight-bold mb-3" style="color: #00496A; font-size: 16px;">
                        <i class="fas fa-chart-line text-info mr-2"></i> Postoperative Cardiopulmonary Stabilization Metrics
                    </h4>
                    <p class="text-muted small mb-4">Core physiologic criteria required by critical care registries to clear patients for mechanical ventilator extubation.</p>
                    
                    <div class="table-responsive">
                        <table class="table table-hover border text-sm m-0">
                            <thead class="bg-light" style="color: #00496A;">
                                <tr>
                                    <th style="font-weight: 700;">Physiologic Surveillance Target</th>
                                    <th style="font-weight: 700;">Clinical Standard Range</th>
                                    <th style="font-weight: 700;">Intensive Care Management Goal</th>
                                </tr>
                            </thead>
                            <tbody class="text-secondary" style="font-size: 13px;">
                                <tr>
                                    <td class="font-weight-bold text-dark">Mediastinal Drainage Rate</td>
                                    <td>&lt; 100 mL / Hour</td>
                                    <td>Indicates secure surgical hemostasis; drainage exceeding 200 mL/hr requires immediate clotting pathway analysis or surgical re-exploration.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Arterial Oxygenation Index (PaO₂/FiO₂)</td>
                                    <td>&gt; 250 mmHg</td>
                                    <td>Confirms adequate pulmonary gas exchange capacity under pressure support ventilation before removing respiratory lines.</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-dark">Serum Potassium Homeostasis</td>
                                    <td>4.0 – 4.5 mEq/L</td>
                                    <td>Maintains strict baseline myocardial electrical stability to lower the incidence of new-onset postoperative Atrial Fibrillation (POAF).</td>
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
                <i class="fas fa-book-reader text-secondary mr-2"></i> Referenced Critical Care Guidelines
            </h5>
        </div>

        <div class="col-12">
            <div class="p-4 rounded-2xl bg-white border border-dashed text-secondary" style="border-color: #cbd5e1 !important; font-size: 13px; line-height: 1.6;">
                <div class="d-flex items-start mb-2" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">AHA/ASA</span>
                    <p class="m-0 text-muted"><strong>Post-Cardiac Arrest & ICU Standards:</strong> Advanced life support and hemodynamic care metrics conform strictly with the American Heart Association (AHA) and American Stroke Association (ASA) critical care parameters.</p>
                </div>
                <div class="d-flex items-start" style="gap: 8px;">
                    <span class="badge badge-secondary px-2 py-0.5 text-[10px] font-weight-bold" style="font-size: 10px; text-transform: uppercase;">ESICM/SCCM</span>
                    <p class="m-0 text-muted"><strong>Global Sepsis & Organ Protection:</strong> Mechanical ventilation targets and multi-organ homeostatic protocols are aligned with the European Society of Intensive Care Medicine (ESICM) core task force criteria.</p>
                </div>
            </div>
        </div>
    </div>

</div> {{-- container closure end --}}
@endsection
