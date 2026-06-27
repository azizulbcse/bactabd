# 🏥 BACTA Central ERP & National Surgical Registry Portal

Welcome to the official repository of **BACTA Bangladesh** (Bangladesh Association of Cardiovascular & Thoracic Anesthesiologists). This is an enterprise-grade medical registry and membership management application built with **Laravel 11**, designed to unify surgical statistics, academic publications, and national membership directory tracking.

---

## 🚀 Key Core Modules Built (From Genesis to Live)

### 🥇 1. National Surgical Registries Hub (The Master Matrix)
A unified, real-time data ingestion engine mapped under the admin sidebar (`National Surgical Hub`). Designed with **Zero-Row Suppression Architecture** and **Asynchronous AJAX Fetch Matrix Engine**.
*   **Module A: Overall Cardiac Surgery Statistics**
    *   Tracks dynamic surgery types (e.g., CABG, Valve, Congenital) across all active registered institutes.
    *   3-Layer Eloquent `groupBy(['year', 'hospital_id', 'surgery_type_id'])` JSON dispatch gateway.
*   **Module B: Congenital Heart Surgery Grid**
    *   Dedicated dynamic grid for congenital anomalies: **ASD, VSD, TOF/ICR, and PDA**.
    *   Upsert automation via Laravel's native `updateOrCreate` engine linked with a real-time horizontal/vertical automated JavaScript live summation calculator.
*   **Module C: Valvular Heart Surgery Grid**
    *   Strict 3-column targeted schema tracking: **MVR (Mitral Valve Replacement), AVR (Aortic Valve Replacement), and DVR (Double Valve Replacement)**.
    *   Optimized database level constraint with unique tracking index `['hospital_id', 'year']` to prevent duplicate ledger entry vulnerabilities.

### 👥 2. Membership Control Hub & Governance Directory
*   **Multi-tier Approval System:** Pending member request workflows with live status tracking counters directly computed via the Admin Dashboard Panel.
*   **Directory Classification:** Dynamic segregation of Executive Committee members, Lifetime Fellows, and General Members.
*   **Next-Gen 2-Layer Nested Navigation:** 
    *   *Desktop:* Micro-engineered multi-layer CSS hover fly-out submenu under `Associate Members`.
    *   *Mobile:* Unified nested accordion slide-down handler mapped under a centralized `DOMContentLoaded` bubble-proof javascript driver to accommodate **Paramedics, Technicians, and Perfusionists** on smaller viewports.

### 📰 3. News & Publications Gateway
*   **Announcements & Executive Minutes:** One-click direct publishing system integrated with secure middleware protection layer to safeguard highly confidential medical board minutes from unauthorized scraping.
*   **BJCTA Academic Journals & Event Gallery:** Scalable media archival module managing file streams and clinical publications.

### 🎨 4. Premium Front-End Optimization (BSEcho Inspired UI)
*   **Infinite Auto-Scrolling Partner Loop:** Pure CSS `@keyframes` marquee container equipped with a smart interactive pause feature on hover (`hover:animation-paused`) tracking global healthcare leaders (GE, Philips, Siemens, etc.).
*   **BSEcho Modern Multi-Row Logo Grid:** High-fidelity standard block layout optimizing image cross-contrast scaling configurations (`image-rendering: -webkit-optimize-contrast`) ensuring 100% blur-free color rendering across responsive breakpoints.
*   **Pixel-Perfect Sticky Ledger Headers:** Cross-browser native scroll management preventing duplicate vertical overflow scrollbars via forced CSS layout overrides (`overflow: visible !important`).

---

## 🛠️ Tech Stack & Architecture

*   **Framework:** Laravel 11.x (PHP 8.2+)
*   **Database:** MySQL / MariaDB (Fully Indexed Schema Optimization)
*   **UI/UX Component System:** Tailwind CSS, Bootstrap & AdminLTE v3
*   **Runtime Web Gateway:** CyberPanel / OpenLiteSpeed Deployment Architecture

---

## ⚙️ Automated Deployment & Live Sync Commands

To deploy, maintain, or update this multi-tier architecture on production servers, run the integrated server-side optimization routing pipeline:

```bash
# 📦 Phase 1: Flush and Purge Old Application Views and Cached Layers
php artisan view:clear && php artisan cache:clear && php artisan route:clear

# 🚀 Phase 2: Cache Configurations and Optimize Framework Class Map Injections
php artisan config:clear && php artisan config:cache && php artisan optimize:clear

# 🗄️ Phase 3: Execute Live Non-Destructive Database Schema Migrations via Remote Gateway
php artisan migrate --force
```

---

## 🔒 Security Gateways & Safeguards
*   **Strict CSRF Injection Blocks:** Native token protection dynamically binded across the unified single-sign-out JavaScript dispatch gateway.
*   **Anti-Spam Secretariat Guard:** Integrated invisible security-trapped honey-pot verification systems blocking automated message transmission loops inside the contact ledger.

---
*Developed with ❤️ for the Advancement of Cardiovascular & Thoracic Anesthesia Science.*
