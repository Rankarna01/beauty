# Implementation Plan: Putri Beauty Care Profil & Katalog Website

## Overview
Pembangunan website profil dan katalog digital interaktif modern (*mobile-first Linktree-style*) untuk Putri Beauty Care (Salon, Aesthetic & Skincare di Banda Aceh) menggunakan Laravel 12, Livewire 3, Filament Admin Panel 3/4, dan Tailwind CSS. Seluruh konten dinamis dikelola dari panel admin Filament, dan seluruh konversi diarahkan ke WhatsApp via pesan otomatis berformat rapi.

Dokumentasi detail tersimpan di:
- Spesifikasi Arsitektur: [`docs/ARCHITECTURE_AND_SPECS.md`](file:///Users/calvin/Coding%20Projek/beauty/docs/ARCHITECTURE_AND_SPECS.md)
- Rincian Task Eksekusi: [`docs/TASK_BREAKDOWN.md`](file:///Users/calvin/Coding%20Projek/beauty/docs/TASK_BREAKDOWN.md)
- Checklist & Risiko: [`docs/ROADMAP_AND_CHECKLIST.md`](file:///Users/calvin/Coding%20Projek/beauty/docs/ROADMAP_AND_CHECKLIST.md)

## Architecture Decisions
- **Stack Inti**: Laravel 12 + Livewire 3 + Filament + Tailwind CSS.
- **Konversi Tanpa Cart**: Tanpa keranjang/checkout e-commerce; seluruh konversi dialirkan melalui `App\Services\WhatsAppLink` yang menormalisasi nomor HP dan menginterpolasi template pesan dinamis.
- **Pengaturan Global**: Menggunakan tabel `settings` key-value ter-cache dengan Filament custom page.
- **Optimasi Gambar**: Upload gambar dikonversi otomatis ke WebP dengan kompresi terukur (maks 1200px lebar, 80% quality) untuk mempertahankan Lighthouse Mobile score ≥ 90.
- **Jam Operasional Realtime**: `OperatingHoursService` mengevaluasi hari dan jam operasional berbasis zona waktu `Asia/Jakarta` (WIB).

## Task List Summary

### Phase 1: Foundation, Data Layer & Admin Core
- [ ] Task 1.1: Setup Proyek, Dependensi & Konfigurasi Lingkungan
- [ ] Task 1.2: Migrasi Basis Data, Relasi Model & Factory
- [ ] Task 1.3: Seeder Data Awal & Default Brand Settings
- [ ] Task 1.4: Core WhatsApp Link & Operating Hours Service Layer
- [ ] Task 1.5: Filament Admin Panel Resources & Custom Settings Page

### Checkpoint: Foundation & Admin Ready
- [ ] Database migrated & seeded, Unit tests pass, Filament Admin ready to manage content.

### Phase 2: Public UI Foundation & Linktree Homepage
- [ ] Task 2.1: Design Tokens, Typography & Base App Layout
- [ ] Task 2.2: Komponen Beranda (Header Profil, Chip Layanan & Kartu Kontak)
- [ ] Task 2.3: Menu Pill Cards Beranda & Indikator Jam Buka Live

### Checkpoint: Linktree Homepage Ready
- [ ] Homepage `/` looks premium, fully responsive on mobile, dynamically reflects admin changes.

### Phase 3: Interactive Features & Dynamic Catalog
- [ ] Task 3.1: Livewire Catalog Component (Pencarian, Filter & Grid Kartu)
- [ ] Task 3.2: Modal & Halaman Detail Katalog (Manfaat, Galeri & CTA WhatsApp)
- [ ] Task 3.3: Halaman Daftar Harga Treatment & Cetak Responsif (`/harga`)
- [ ] Task 3.4: Modul Promo Dinamis & Detail Promo (`/promo`, `/promo/{slug}`)

### Checkpoint: Catalog & Promos Ready
- [ ] Catalog search and filter reactive, price list printable, promos active/expiry logic works.

### Phase 4: WhatsApp Booking Engine & Public Utility
- [ ] Task 4.1: Form Booking Interaktif Livewire (`/booking`)
- [ ] Task 4.2: Halaman Lokasi Cabang & Embed Google Maps Lazy-Load (`/lokasi`)
- [ ] Task 4.3: Route Redirect Konsultasi, Instagram & Floating WhatsApp Button

### Checkpoint: Booking Flow Complete
- [ ] Booking form redirects to WhatsApp with accurate pre-formatted text, Maps and redirects functional.

### Phase 5: Analytics, Polish, SEO & Launch Hardening
- [ ] Task 5.1: Pencatatan Analitik Klik WhatsApp & Dashboard Widget
- [ ] Task 5.2: Pipeline Otomasi Kompresi Gambar ke Format WebP
- [ ] Task 5.3: Metadata SEO, JSON-LD LocalBusiness & Sitemap Generator
- [ ] Task 5.4: Keamanan, Rate Limiting, Error Pages 404 & Audit Performa

### Checkpoint: Production Ready
- [ ] All PRD criteria met, security and performance benchmarks cleared.

## Risks and Mitigations
| Risk | Impact | Mitigation |
|------|--------|------------|
| Nomor WhatsApp diblokir / ganti | High | Dikelola terpusat di `settings` database, diedit via Filament tanpa redeploy kode. |
| Ukuran foto besar memperlambat mobile | High | Konversi otomatis ke WebP + lazy-loading + dimensi eksplisit. |
| Konten promo kedaluwarsa tetap tampil | Medium | Scope query otomatis membatasi `starts_at <= now() <= ends_at`. |
| Spam booking bot | Medium | Throttle rate-limiting pada controller dan validasi form ketat. |
