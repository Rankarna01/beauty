# Checklist & Monitoring Pengerjaan
## Putri Beauty Care: Profil & Katalog Website

*File ini digunakan untuk melacak progres pengerjaan harian (checklist) dan verifikasi fungsionalitas.*

---

## 📌 Status Keseluruhan Proyek

- [ ] **Fase 1: Fondasi Proyek, Basis Data & Admin Panel** *(0/5 Task)*
- [ ] **Fase 2: Layout Mobile-First & Beranda Linktree Modern** *(0/3 Task)*
- [ ] **Fase 3: Modul Katalog, Daftar Harga & Promo Dinamis** *(0/4 Task)*
- [ ] **Fase 4: Sistem Booking WhatsApp & Integrasi Lokasi** *(0/3 Task)*
- [ ] **Fase 5: Analitik Klik, Optimasi WebP, SEO & Hardening** *(0/4 Task)*

---

## Checklist Detail per Fase

### 🏗️ Fase 1: Fondasi Proyek, Basis Data & Admin Panel Core
- [ ] **Task 1.1**: Setup Laravel 12, Livewire 3, Filament 3/4, Tailwind CSS & dependensi
- [ ] **Task 1.2**: Migrasi 10 tabel inti database, relasi model Eloquent, trait Sluggable & SoftDeletes
- [ ] **Task 1.3**: Database Seeder komprehensif (User Admin, Outlet Banda Aceh, Jam Buka, Default Settings)
- [ ] **Task 1.4**: Unit testing service `WhatsAppLink` (normalisasi nomor `628...` & template) dan `OperatingHoursService`
- [ ] **Task 1.5**: Filament Resources (Kategori, Katalog, Promo, Lokasi, Menu Beranda) & Custom Settings Page
- [ ] 🎯 **Checkpoint 1 Verifikasi**: Seluruh unit test green, panel admin `/admin` dapat mengelola seluruh entitas data.

---

### 📱 Fase 2: Layout Mobile-First & Beranda Linktree Modern
- [ ] **Task 2.1**: Implementasi Design Tokens (warna brand magenta `#E6107A`, soft pink, emas `#C9A24B`, font Playfair & Poppins) & layout mobile-first
- [ ] **Task 2.2**: Header profil salon, nama brand script, chip layanan unggulan dinamis, dan kartu kontak cepat
- [ ] **Task 2.3**: Komponen pill card menu beranda (reorderable), panah chevron, dan widget indikator jam buka live "Buka Sekarang / Tutup"
- [ ] 🎯 **Checkpoint 2 Verifikasi**: Halaman `/` selesai 100% responsif mobile-first dan sinkron dengan pengaturan Filament.

---

### 💄 Fase 3: Modul Katalog, Daftar Harga & Promo Dinamis
- [ ] **Task 3.1**: Livewire Catalog list (`/katalog`) dengan filter tab kategori, pencarian reaktif instan tanpa reload, dan kartu rasio 4:5
- [ ] **Task 3.2**: Modal/halaman detail item katalog (`/katalog/{kategori}/{item}`) dengan galeri foto, benefits bullet list, dan CTA WhatsApp dinamis
- [ ] **Task 3.3**: Halaman daftar harga treatment (`/harga`) dengan accordion per kategori, info update terakhir, dan fitur cetak ramah A4 (`@media print`)
- [ ] **Task 3.4**: Modul promo dinamis (`/promo`, `/promo/{slug}`) dengan filter otomatis tanggal aktif, badge "Berakhir dalam X hari", dan sanitasi rich text
- [ ] 🎯 **Checkpoint 3 Verifikasi**: Pengunjung dapat mencari treatment/skincare, mencetak daftar harga, dan melihat promo aktif.

---

### 💬 Fase 4: Sistem Booking WhatsApp & Integrasi Lokasi
- [ ] **Task 4.1**: Formulir booking Livewire (`/booking`) dengan multi-select treatment, validasi tanggal lampau, dan auto-generate pesan WhatsApp terstruktur
- [ ] **Task 4.2**: Halaman outlet salon (`/lokasi`) dengan Google Maps embed lazy-load, tombol petunjuk arah, dan foto tampak depan
- [ ] **Task 4.3**: Fast redirect routes (`/konsultasi` -> WA, `/instagram` -> IG) dan Floating WhatsApp Button terintegrasi di seluruh halaman
- [ ] 🎯 **Checkpoint 4 Verifikasi**: Seluruh alur konversi WhatsApp berfungsi tanpa celah, redirect dan peta cabang bekerja sempurna.

---

### 🚀 Fase 5: Analitik Klik, Optimasi WebP, SEO & Hardening
- [ ] **Task 5.1**: Pencatatan klik CTA WhatsApp (`wa_click_logs`) berprivasi tinggi (IP hash) & widget statistik dashboard Filament
- [ ] **Task 5.2**: Otomasi pipeline konversi dan kompresi upload gambar ke WebP (maks 1200px, kualitas 80%)
- [ ] **Task 5.3**: Penerapan Schema JSON-LD `LocalBusiness` (BeautySalon), Open Graph preview cards, dan sitemap generator otomatis
- [ ] **Task 5.4**: Hardening keamanan (rate limiting, CSRF, HTTP headers), custom error page 404/503, dan audit Lighthouse Mobile (target skor ≥ 90)
- [ ] 🎯 **Checkpoint 5 Verifikasi**: Lulus pengujian performa, keamanan, dan siap rilis ke server produksi.

---

## 🛡️ Matriks Mitigasi Risiko & Validasi Spesifikasi

| Risiko dari PRD | Dampak | Mitigasi yang Diimplementasikan dalam Task |
|---|---|---|
| **Nomor WA Salon Berganti / Terblokir** | Tinggi | Dikelola terpusat di `settings` tabel dan diakses via `WhatsAppLink` service; perubahan nomor di admin otomatis memperbarui semua tombol di seluruh web dalam 1 detik tanpa redeploy (Task 1.4, Task 1.5). |
| **Konten Promo & Harga Kedaluwarsa** | Sedang | Query promo wajib memiliki filter `starts_at <= now() AND ends_at >= now()`; daftar harga memuat tanggal otomatis "Terakhir Diperbarui" (Task 3.3, Task 3.4). |
| **Foto Ukuran Besar Memperlambat HP** | Tinggi | Intersepsi proses upload di Filament untuk otomatis konversi ke WebP dan pembatasan lebar 1200px, ditambah lazy-loading native di frontend (Task 5.2). |
| **Spam / Bot Menembus Form Booking** | Sedang | Rate limiting via middleware Laravel `throttle:15,1` dan validasi format nama/tanggal di sisi server (Task 4.1, Task 5.4). |
| **Pesan WA Tidak Sampai ke Admin** | Sedang | `wa_click_logs` mencatat setiap kali tombol booking ditekan, sehingga salon memiliki cadangan data pengunjung yang berminat booking (Task 5.1). |
