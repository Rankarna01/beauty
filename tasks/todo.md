# Task List: Putri Beauty Care Implementation

## Phase 1: Foundation, Data Layer & Admin Core
- [ ] Task 1.1: Setup Proyek, Dependensi & Konfigurasi Lingkungan
- [ ] Task 1.2: Migrasi Basis Data, Relasi Model & Factory
- [ ] Task 1.3: Seeder Data Awal & Default Brand Settings
- [ ] Task 1.4: Core WhatsApp Link & Operating Hours Service Layer
- [ ] Task 1.5: Filament Admin Panel Resources & Custom Settings Page

## Checkpoint: Foundation
- [ ] Migrations run cleanly
- [ ] Seeders populate initial admin & salon data
- [ ] Unit tests for WhatsApp & Operating hours services pass
- [ ] Filament login and resource screens accessible

## Phase 2: Public UI Foundation & Linktree Homepage
- [ ] Task 2.1: Design Tokens, Typography & Base App Layout
- [ ] Task 2.2: Komponen Beranda (Header Profil, Chip Layanan & Kartu Kontak)
- [ ] Task 2.3: Menu Pill Cards Beranda & Indikator Jam Buka Live

## Checkpoint: Homepage
- [ ] Mobile-first responsive layout verified
- [ ] Live operating hours status badge toggles properly
- [ ] Dynamic pill cards link to routes/WA correctly

## Phase 3: Interactive Features & Dynamic Catalog
- [ ] Task 3.1: Livewire Catalog Component (Pencarian, Filter & Grid Kartu)
- [ ] Task 3.2: Modal & Halaman Detail Katalog (Manfaat, Galeri & CTA WhatsApp)
- [ ] Task 3.3: Halaman Daftar Harga Treatment & Cetak Responsif (`/harga`)
- [ ] Task 3.4: Modul Promo Dinamis & Detail Promo (`/promo`, `/promo/{slug}`)

## Checkpoint: Catalog & Promos
- [ ] Real-time search and category filtering work smoothly without reload
- [ ] Price list print preview formatted neatly
- [ ] Expired promos automatically hidden

## Phase 4: WhatsApp Booking Engine & Public Utility
- [ ] Task 4.1: Form Booking Interaktif Livewire (`/booking`)
- [ ] Task 4.2: Halaman Lokasi Cabang & Embed Google Maps Lazy-Load (`/lokasi`)
- [ ] Task 4.3: Route Redirect Konsultasi, Instagram & Floating WhatsApp Button

## Checkpoint: Conversion Flow
- [ ] Form booking produces pre-formatted WhatsApp link accurately
- [ ] Redirects `/konsultasi` and `/instagram` functional
- [ ] Google Maps lazy-loaded

## Phase 5: Analytics, Polish, SEO & Launch Hardening
- [ ] Task 5.1: Pencatatan Analitik Klik WhatsApp & Dashboard Widget
- [ ] Task 5.2: Pipeline Otomasi Kompresi Gambar ke Format WebP
- [ ] Task 5.3: Metadata SEO, JSON-LD LocalBusiness & Sitemap Generator
- [ ] Task 5.4: Keamanan, Rate Limiting, Error Pages 404 & Audit Performa

## Checkpoint: Launch Readiness
- [ ] Anonymized WA click logs aggregated in Filament dashboard
- [ ] Image upload pipeline converts assets to WebP
- [ ] SEO, Open Graph, and JSON-LD schema validated
- [ ] Lighthouse Mobile target scores met (Performance >= 90)
