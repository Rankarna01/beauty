# Pembagian Task Pengerjaan (Task Breakdown)
## Putri Beauty Care: Profil & Katalog Website

*Panduan Eksekusi Fullstack Developer – Berdasarkan PRD v1.0*

---

## 1. Roadmap & Milestone Fase Pengerjaan

Pengerjaan dibagi ke dalam **5 fase modular** dengan prinsip *vertical slicing* agar setiap tahapan menghasilkan fungsionalitas yang dapat diuji secara langsung:

```
┌─────────────────────────────────────────────────────────────┐
│ Fase 1: Fondasi Proyek, Database & Admin Panel (Filament)   │
└──────────────────────────────┬──────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────┐
│ Fase 2: Layout Mobile-First & Beranda Linktree Modern        │
└──────────────────────────────┬──────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────┐
│ Fase 3: Modul Katalog, Daftar Harga & Promo Dinamis         │
└──────────────────────────────┬──────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────┐
│ Fase 4: Sistem Booking WhatsApp & Integrasi Lokasi          │
└──────────────────────────────┬──────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────┐
│ Fase 5: Analitik Klik, Optimasi WebP, SEO & Hardening       │
└─────────────────────────────────────────────────────────────┘
```

---

## FASE 1: Fondasi Proyek, Basis Data & Admin Panel Core

### Task 1.1: Setup Proyek, Dependensi & Konfigurasi Lingkungan
**Description:** Inisialisasi instalasi framework Laravel 12, konfigurasi database, instalasi Livewire 3, Filament Admin Panel 3/4, Tailwind CSS, dan paket pendukung (Blade Icons, Spatie Image/Media).
**Acceptance criteria:**
- [ ] Laravel 12 terpasang dengan PHP 8.3+ dan berjalan normal di local server.
- [ ] Panel Filament terinstal dan dapat diakses di `/admin`.
- [ ] Livewire 3 terkonfigurasi dan berfungsi di Blade layout.
- [ ] File `.env.example` terdefinisi rapi dengan variabel database, app URL, dan konfigurasi cache.
**Verification:**
- [ ] `php artisan --version` berhasil dieksekusi.
- [ ] Route `/admin/login` berhasil merender form login admin.
- [ ] Build aset frontend (`npm run build` / Vite) berjalan tanpa error.
**Dependencies:** Tidak ada.
**Files likely touched:**
- `composer.json`
- `package.json`
- `vite.config.js`
- `app/Providers/Filament/AdminPanelProvider.php`
- `.env.example`
**Estimated scope:** Medium (4-5 file)

---

### Task 1.2: Migrasi Basis Data, Relasi Model & Factory
**Description:** Membuat seluruh tabel basis data sesuai spesifikasi ERD: `settings`, `menu_links`, `categories`, `catalog_items`, `catalog_item_images`, `promos`, `catalog_item_promo`, `locations`, `operating_hours`, dan `wa_click_logs` lengkap dengan relasi Eloquent dan Soft Deletes.
**Acceptance criteria:**
- [ ] Seluruh migrasi database berjalan sukses tanpa error kunci asing (foreign key).
- [ ] Model Eloquent (`Category`, `CatalogItem`, `Promo`, `Location`, `OperatingHour`, `MenuLink`, `Setting`, `WaClickLog`) memiliki relasi `hasMany`, `belongsTo`, `belongsToMany` yang tepat.
- [ ] Field slug otomatis dibuat dari nama dengan trait `sluggable` atau model boot event.
- [ ] SoftDeletes aktif pada `catalog_items` dan `promos`.
**Verification:**
- [ ] `php artisan migrate:fresh` selesai dengan exit code 0.
- [ ] Relasi model diuji via `php artisan tinker` (kategori memiliki catalog_items, lokasi memiliki operating_hours).
**Dependencies:** Task 1.1
**Files likely touched:**
- `database/migrations/*`
- `app/Models/Category.php`
- `app/Models/CatalogItem.php`
- `app/Models/CatalogItemImage.php`
- `app/Models/Promo.php`
- `app/Models/Location.php`
- `app/Models/OperatingHour.php`
- `app/Models/MenuLink.php`
- `app/Models/Setting.php`
- `app/Models/WaClickLog.php`
**Estimated scope:** Medium (8-10 file)

---

### Task 1.3: Seeder Data Awal & Default Brand Settings
**Description:** Membuat database seeder komprehensif yang memuat data awal Putri Beauty Care: akun Super Admin, data salon Banda Aceh, jam operasional (Senin-Minggu 09.00-21.00 WIB), menu linktree awal, template pesan WhatsApp default, dan contoh layanan poster.
**Acceptance criteria:**
- [ ] Seeder membuat 1 akun super admin default (`admin@putribeautycare.com`).
- [ ] Data pengaturan awal tersimpan (Nama Brand: "Putri Beauty Care", Tagline: "Salon, Aesthetic & Skincare", No WA: "081362673728").
- [ ] Kategori awal terisi: "Skincare & Facial", "Hair, Nail & Spa".
- [ ] Lokasi cabang "Head Japanese Spa, Jl. Sultan Iskandar Muda, Banda Aceh" dan jadwal 7 hari terisi lengkap.
**Verification:**
- [ ] `php artisan db:seed` berjalan bersih tanpa error integrity constraint.
- [ ] Login ke `/admin` berhasil menggunakan kredensial hasil seeder.
**Dependencies:** Task 1.2
**Files likely touched:**
- `database/seeders/DatabaseSeeder.php`
- `database/seeders/UserSeeder.php`
- `database/seeders/SettingSeeder.php`
- `database/seeders/CategorySeeder.php`
- `database/seeders/MenuLinkSeeder.php`
- `database/seeders/LocationSeeder.php`
**Estimated scope:** Medium (4-6 file)

---

### Task 1.4: Core WhatsApp Link & Operating Hours Service Layer
**Description:** Membangun kelas service `WhatsAppLink` untuk normalisasi nomor telepon (`08xx` -> `628xx`), parsing template teks, dan encoding parameter URL WA. Serta kelas `OperatingHoursService` untuk memeriksa status buka/tutup salon berbasis waktu lokal WIB (`Asia/Jakarta`).
**Acceptance criteria:**
- [ ] `WhatsAppLink::cleanPhoneNumber('081362673728')` menghasilkan string `'6281362673728'`.
- [ ] `WhatsAppLink::build('booking', [...])` mengembalikan URL `https://wa.me/6281362673728?text=...` dengan teks yang ter-encode rapi dan seluruh placeholder terganti.
- [ ] `OperatingHoursService::isOpenNow($location)` mengembalikan boolean `true`/`false` sesuai hari dan jam operasional aktif saat ini di WIB.
**Verification:**
- [ ] Unit Test PHPUnit/Pest untuk `WhatsAppLinkTest` dan `OperatingHoursServiceTest` berhasil (100% assertions green).
**Dependencies:** Task 1.2, Task 1.3
**Files likely touched:**
- `app/Services/WhatsAppLink.php`
- `app/Services/OperatingHoursService.php`
- `tests/Unit/WhatsAppLinkTest.php`
- `tests/Unit/OperatingHoursServiceTest.php`
**Estimated scope:** Small (3-4 file)

---

### Task 1.5: Filament Admin Panel Resources & Custom Settings Page
**Description:** Membangun Filament Resources untuk manajemen konten: Kategori, Item Katalog (dengan form harga, durasi, upload foto & sortable gallery), Menu Linktree (reorderable table), Promo, Lokasi, dan Custom Settings Page untuk konfigurasi identitas brand, kontak, dan template pesan WhatsApp.
**Acceptance criteria:**
- [ ] Admin dapat menambah, mengedit, mengurutkan (reorder drag-and-drop), dan menonaktifkan Menu Linktree.
- [ ] Admin dapat mengelola Katalog Layanan/Produk lengkap dengan tipe harga (fixed, mulai dari, hubungi kami) dan badge.
- [ ] Halaman `Settings` di panel Filament memungkinkan admin mengganti nomor WA, template pesan, slogan, dan logo tanpa deploy.
- [ ] Terdapat toggle `is_active` langsung pada tabel daftar untuk respon cepat.
**Verification:**
- [ ] Akses panel admin, lakukan penambahan 1 item menu dan 1 layanan baru, lalu verifikasi data tersimpan di database.
- [ ] Ubah nomor WA di halaman settings dan pastikan helper `setting('contact.whatsapp_main')` merespons nilai terbaru.
**Dependencies:** Task 1.2, Task 1.3, Task 1.4
**Files likely touched:**
- `app/Filament/Resources/CategoryResource.php`
- `app/Filament/Resources/CatalogItemResource.php`
- `app/Filament/Resources/MenuLinkResource.php`
- `app/Filament/Resources/PromoResource.php`
- `app/Filament/Resources/LocationResource.php`
- `app/Filament/Pages/ManageSettings.php`
**Estimated scope:** Medium (6-8 file)

---

### Checkpoint 1: Fondasi Backend & Admin Siap
- [ ] Database termigrasi dan terseed secara sempurna.
- [ ] Service WhatsApp & Status Buka/Tutup teruji via Unit Tests.
- [ ] Admin panel siap digunakan untuk mengisi dan memperbarui seluruh konten aplikasi.

---

## FASE 2: Layout Mobile-First & Beranda Linktree Modern

### Task 2.1: Design Tokens, Typography & Base App Layout
**Description:** Mengimplementasikan tema Tailwind CSS khusus Putri Beauty Care (palet warna magenta `#E6107A`, soft pink `#FFE4EF`, emas `#C9A24B`, tipografi Playfair Display & Poppins) dan layout induk `layouts/app.blade.php` dengan kontainer mobile-first maksimal 480px di desktop.
**Acceptance criteria:**
- [ ] Font Google (Playfair Display & Poppins) terpasang dengan `font-display: swap`.
- [ ] Palet warna brand terdefinisi pada konfigurasi Tailwind / CSS variables.
- [ ] Layout mobile-first terpusat di layar desktop dengan background gradasi lembut `#FFF5F9` -> `#FFFFFF`.
- [ ] Terdapat placeholder dinamis untuk floating WhatsApp button dan footer.
**Verification:**
- [ ] Halaman kosong yang menggunakan layout merender warna background dan tipografi sesuai desain acuan poster.
- [ ] Inspeksi responsif di DevTools (iPhone SE 375px hingga Desktop 1440px) tidak terdapat overflow horizontal.
**Dependencies:** Task 1.1
**Files likely touched:**
- `resources/css/app.css`
- `tailwind.config.js`
- `resources/views/layouts/app.blade.php`
- `resources/views/components/container.blade.php`
**Estimated scope:** Small (3-4 file)

---

### Task 2.2: Komponen Beranda (Header Profil, Chip Layanan & Kartu Kontak)
**Description:** Membangun bagian atas halaman beranda: header logo, cover salon, nama brand beraksen font script, slogan, chip layanan unggulan dinamis (Facial Treatment, Hair Cut, Head Spa, dll.), serta kartu kontak cepat dengan alamat ringkas dan tombol WA.
**Acceptance criteria:**
- [ ] Nama brand dan logo tampil dinamis dari pengaturan admin.
- [ ] Chip layanan unggulan di-render secara dinamis dari database/settings.
- [ ] Kartu kontak menampilkan alamat Banda Aceh dan tombol interaktif yang membuka kontak WhatsApp.
- [ ] Micro-interactions halus saat chip atau kartu kontak disentuh/di-hover.
**Verification:**
- [ ] Mengubah teks slogan di admin panel -> halaman beranda langsung terbarui.
- [ ] Tampilan header rapi pada layar mobile beresolusi 360px.
**Dependencies:** Task 1.5, Task 2.1
**Files likely touched:**
- `resources/views/components/home/header.blade.php`
- `resources/views/components/home/service-chips.blade.php`
- `resources/views/components/home/contact-card.blade.php`
- `app/Http/Controllers/HomeController.php`
**Estimated scope:** Small (3-4 file)

---

### Task 2.3: Menu Pill Cards Beranda & Indikator Jam Buka Live
**Description:** Membangun daftar tombol menu utama bergaya linktree (pill cards dengan border emas halus, ikon bergradasi, panah kanan) yang dapat diurutkan dari admin, serta widget status jam operasional yang menampilkan status "Buka Sekarang" (hijau) atau "Tutup" (merah/abu) secara dinamis.
**Acceptance criteria:**
- [ ] Menu pill me-render seluruh menu aktif dari tabel `menu_links` terurut berdasarkan `sort_order`.
- [ ] Tombol menu internal mengarah ke route aplikasi, tombol eksternal membuka tab baru, dan tombol WA memicu tautan WhatsApp yang valid.
- [ ] Indikator jam operasional menampilkan teks jam buka (contoh: "Senin - Minggu: 09.00 - 21.00 WIB") dan badge "Buka Sekarang" bila waktu saat ini masuk dalam rentang jam buka.
- [ ] Menu yang dinonaktifkan di admin panel langsung hilang dari tampilan tanpa error.
**Verification:**
- [ ] Simulasi waktu pada service `OperatingHoursService` untuk memastikan transisi dari Buka ke Tutup bekerja akurat.
- [ ] Nonaktifkan salah satu menu di admin panel dan refresh beranda.
**Dependencies:** Task 1.4, Task 1.5, Task 2.2
**Files likely touched:**
- `resources/views/components/home/menu-pill.blade.php`
- `resources/views/components/home/operating-hours-badge.blade.php`
- `resources/views/pages/home.blade.php`
**Estimated scope:** Medium (3-4 file)

---

### Checkpoint 2: Tampilan Beranda Linktree Siap
- [ ] Halaman `/` selesai 100% menyerupai Linktree premium Putri Beauty Care.
- [ ] Seluruh data di beranda terhubung dengan Filament Admin Panel.
- [ ] Tampilan responsif sempurna di perangkat seluler.

---

## FASE 3: Modul Katalog, Daftar Harga & Promo Dinamis

### Task 3.1: Livewire Catalog Component (Pencarian, Filter & Grid Kartu)
**Description:** Membangun antarmuka katalog di `/katalog` menggunakan Livewire 3 yang memuat tab kategori ("Skincare & Facial", "Hair, Nail & Spa"), input pencarian nama instan tanpa reload, dan grid kartu layanan/produk berasio 4:5.
**Acceptance criteria:**
- [ ] Input pencarian memfilter katalog secara real-time via `wire:model.live.debounce.300ms`.
- [ ] Filter tab kategori mengisolasi item sesuai kategori yang dipilih.
- [ ] Kartu katalog menampilkan foto, badge promo/populer, nama, durasi (bila tipe layanan), harga terformat ("Rp 150.000" atau "Mulai Rp 100.000"), serta tombol direct WhatsApp "Booking" / "Pesan".
- [ ] Menampilkan pesan *empty state* yang ramah jika pencarian tidak ditemukan.
**Verification:**
- [ ] Ketik kata kunci pada kolom cari -> daftar item terfilter otomatis tanpa page reload.
- [ ] Klik tab kategori -> item berganti sesuai kategori yang dipilih.
**Dependencies:** Task 1.2, Task 2.1
**Files likely touched:**
- `app/Livewire/CatalogList.php`
- `resources/views/livewire/catalog-list.blade.php`
- `resources/views/components/catalog/item-card.blade.php`
**Estimated scope:** Medium (3-4 file)

---

### Task 3.2: Modal & Halaman Detail Katalog (Manfaat, Galeri & CTA WhatsApp)
**Description:** Membangun tampilan detail item katalog (tersedia sebagai slide-over/modal interaktif atau halaman `/katalog/{kategori}/{item}`) yang menampilkan galeri foto, deskripsi lengkap, daftar manfaat (benefits), durasi, dan tombol konversi WhatsApp dengan teks otomatis berisi nama item dan harga.
**Acceptance criteria:**
- [ ] Pengunjung dapat melihat foto resolusi penuh item katalog.
- [ ] Daftar manfaat (benefits JSON) dirender dalam format bullet list elegan.
- [ ] Tombol CTA WhatsApp menyusun pesan otomatis:
  *"Halo Putri Beauty Care, saya tertarik dengan layanan/produk {nama_item} (Rp {harga}). Apakah slot/produk masih tersedia?"*
- [ ] URL detail item dapat dibagikan langsung (SEO-friendly permalink).
**Verification:**
- [ ] Buka detail item di browser, klik tombol WhatsApp, dan verifikasi tab baru membuka tautan WA dengan teks yang akurat.
**Dependencies:** Task 1.4, Task 3.1
**Files likely touched:**
- `app/Http/Controllers/CatalogController.php`
- `resources/views/pages/catalog/show.blade.php`
- `resources/views/components/catalog/detail-modal.blade.php`
**Estimated scope:** Medium (3-4 file)

---

### Task 3.3: Halaman Daftar Harga Treatment & Cetak Responsif (`/harga`)
**Description:** Membangun halaman daftar harga (`/harga`) yang mengelompokkan treatment salon per kategori dalam bentuk accordion/tabel rapi, dilengkapi dengan tombol booking langsung per baris dan stylesheet khusus cetak (`@media print`).
**Acceptance criteria:**
- [ ] Data harga terkelompok rapi berdasarkan kategori layanan.
- [ ] Setiap baris menampilkan nama treatment, durasi pengerjaan, harga, dan tombol booking cepat.
- [ ] Tanggal "Terakhir diperbarui" tampil otomatis di bagian bawah berdasarkan waktu update terakhir katalog.
- [ ] Terdapat tombol "Cetak Daftar Harga" yang memicu dialog cetak browser (`window.print()`) dengan tampilan bersih tanpa elemen navigasi/footer.
**Verification:**
- [ ] Buka `/harga`, klik "Cetak" atau tekan `Ctrl/Cmd + P`, periksa pratinjau cetak bersih dan rapi dalam kertas A4.
**Dependencies:** Task 1.2, Task 2.1
**Files likely touched:**
- `app/Http/Controllers/PriceListController.php`
- `resources/views/pages/price-list.blade.php`
- `resources/views/components/price/category-group.blade.php`
- `resources/css/print.css`
**Estimated scope:** Small (3-4 file)

---

### Task 3.4: Modul Promo Dinamis & Detail Promo (`/promo`, `/promo/{slug}`)
**Description:** Membangun modul informasi promo aktif di `/promo` dan detail promo di `/promo/{slug}`. Promo otomatis hanya tampil jika tanggal sekarang berada dalam rentang `starts_at` dan `ends_at`, dilengkapi badge hitung mundur ("Berakhir dalam X hari") dan tombol klaim via WA.
**Acceptance criteria:**
- [ ] Promo yang sudah kedaluwarsa otomatis tidak muncul di halaman publik tanpa perlu tindakan manual admin.
- [ ] Kartu promo menampilkan banner gambar, periode tanggal, dan sisa hari.
- [ ] Halaman detail promo menampilkan konten rich text (syarat & ketentuan) yang disanitasi dari ancaman XSS.
- [ ] Tombol "Klaim Promo via WhatsApp" menghasilkan tautan WA dengan teks mencantumkan judul promo yang bersangkutan.
**Verification:**
- [ ] Tambahkan promo yang berakhir kemarin -> verifikasi tidak muncul di `/promo`.
- [ ] Tambahkan promo yang berakhir 3 hari lagi -> verifikasi muncul badge "Berakhir dalam 3 hari".
**Dependencies:** Task 1.4, Task 1.5, Task 2.1
**Files likely touched:**
- `app/Http/Controllers/PromoController.php`
- `resources/views/pages/promo/index.blade.php`
- `resources/views/pages/promo/show.blade.php`
- `resources/views/components/promo/card.blade.php`
**Estimated scope:** Medium (4 file)

---

### Checkpoint 3: Modul Katalog, Harga & Promo Siap
- [ ] Pengunjung dapat menjelajah, mencari, dan melihat detail layanan serta produk.
- [ ] Daftar harga dapat dilihat dan dicetak dengan rapi.
- [ ] Promo aktif berjalan otomatis dengan validasi tanggal kedaluwarsa.

---

## FASE 4: Sistem Booking WhatsApp & Integrasi Lokasi

### Task 4.1: Form Booking Interaktif Livewire (`/booking`)
**Description:** Membangun formulir booking janji temu di `/booking` menggunakan Livewire 3: nama lengkap, pilihan multi-layanan dari database, pemilihan tanggal (proteksi tanggal lampau), jam kedatangan, dan catatan khusus.
**Acceptance criteria:**
- [ ] Pengunjung dapat memilih satu atau beberapa layanan dari dropdown/checkbox kategori.
- [ ] Pilihan tanggal membatasi tanggal minimal adalah hari ini (`min="{{ date('Y-m-d') }}"`).
- [ ] Validasi form secara real-time sebelum tombol submit aktif.
- [ ] Saat disubmit, sistem memanggil service `WhatsAppLink` untuk menyusun pesan terformat dan mengarahkan pengguna ke aplikasi WhatsApp.
**Verification:**
- [ ] Isi form booking lengkap -> klik "Lanjutkan ke WhatsApp" -> tab baru membuka WhatsApp dengan pesan booking yang persis sesuai template di PRD.
- [ ] Coba submit dengan nama kosong -> validasi error muncul di bawah input.
**Dependencies:** Task 1.4, Task 2.1
**Files likely touched:**
- `app/Livewire/BookingForm.php`
- `resources/views/livewire/booking-form.blade.php`
- `resources/views/pages/booking.blade.php`
**Estimated scope:** Medium (3 file)

---

### Task 4.2: Halaman Lokasi Cabang & Embed Google Maps Lazy-Load (`/lokasi`)
**Description:** Membangun halaman `/lokasi` yang menampilkan daftar cabang salon (nama cabang, alamat lengkap Banda Aceh, foto tampak depan, jam buka per cabang, nomor telepon), tombol "Buka di Google Maps", dan embed iframe peta yang dimuat secara *lazy-load*.
**Acceptance criteria:**
- [ ] Alamat dan foto salon ditampilkan secara estetik dan responsif.
- [ ] Tombol "Buka di Google Maps" membuka aplikasi peta sesuai koordinat/URL cabang.
- [ ] Iframe Google Maps menggunakan atribut `loading="lazy"` agar tidak memperlambat initial page load.
- [ ] Mendukung lebih dari satu lokasi cabang bila salon membuka cabang baru.
**Verification:**
- [ ] Buka `/lokasi` di browser, periksa iframe peta termuat dengan benar dan tombol arah bekerja.
**Dependencies:** Task 1.2, Task 2.1
**Files likely touched:**
- `app/Http/Controllers/LocationController.php`
- `resources/views/pages/locations.blade.php`
- `resources/views/components/location/card.blade.php`
**Estimated scope:** Small (3 file)

---

### Task 4.3: Route Redirect Konsultasi, Instagram & Floating WhatsApp Button
**Description:** Membuat controller redirect untuk `/konsultasi` dan `/instagram` agar link pendek/QR code salon tetap permanen meski admin mengganti nomor atau username di kemudian hari. Serta memasang komponen Floating WhatsApp Button di seluruh halaman dengan toggle pengaturan admin.
**Acceptance criteria:**
- [ ] Mengakses `/konsultasi` memberikan HTTP 302 Redirect langsung ke nomor WA konsultasi yang aktif di settings.
- [ ] Mengakses `/instagram` memberikan HTTP 302 Redirect ke profil Instagram salon.
- [ ] Floating WhatsApp button muncul di pojok kanan bawah seluruh halaman publik (dapat disembunyikan via pengaturan admin).
**Verification:**
- [ ] Request `curl -I http://localhost:8000/konsultasi` mengembalikan status `302 Found` dengan header `Location: https://wa.me/...`.
**Dependencies:** Task 1.4, Task 1.5, Task 2.1
**Files likely touched:**
- `app/Http/Controllers/RedirectController.php`
- `routes/web.php`
- `resources/views/components/floating-wa.blade.php`
**Estimated scope:** Small (3 file)

---

### Checkpoint 4: Booking & Akses Kontak Selesai
- [ ] Alur booking janji temu menghasilkan pesan WA yang sempurna.
- [ ] Cabang salon dan Google Maps terintegrasi.
- [ ] Redirect permanen `/konsultasi` dan `/instagram` berfungsi.

---

## FASE 5: Analitik Klik, Optimasi WebP, SEO & Hardening

### Task 5.1: Pencatatan Analitik Klik WhatsApp & Dashboard Widget
**Description:** Mengimplementasikan pencatatan event klik tombol WA (`wa_click_logs`) secara asynchronous/ringan tanpa data sensitif (IP di-hash), serta membangun widget statistik di Dashboard Filament (grafik klik 7/30 hari, layanan paling sering di-booking, total klik bulan ini).
**Acceptance criteria:**
- [ ] Setiap kali tombol booking atau konsultasi ditekan, event log tersimpan di `wa_click_logs`.
- [ ] IP pengguna di-hash menggunakan SHA-256 ber-salt (memenuhi kaidah GDPR & privasi data).
- [ ] Admin dapat melihat grafik ringkasan minat pengunjung di `/admin` dashboard.
- [ ] Terdapat opsi toggle di pengaturan admin untuk menonaktifkan logging bila tidak dibutuhkan.
**Verification:**
- [ ] Lakukan 1 kali submit booking -> cek tabel `wa_click_logs` terisi data baru dengan IP ter-hash.
- [ ] Dashboard Filament menampilkan angka statistik yang bertambah.
**Dependencies:** Task 1.2, Task 1.5, Task 4.1
**Files likely touched:**
- `app/Services/AnalyticsService.php`
- `app/Filament/Widgets/WaClickStatsWidget.php`
- `app/Filament/Widgets/PopularItemsChart.php`
**Estimated scope:** Medium (4 file)

---

### Task 5.2: Pipeline Otomasi Kompresi Gambar ke Format WebP
**Description:** Mengintegrasikan pipeline upload gambar pada Filament Admin yang secara otomatis mengompresi dan mengonversi format file JPG/PNG ke WebP dengan kompresi terukur (maksimal lebar 1200px, kualitas 80%) untuk menjamin kecepatan LCP di smartphone.
**Acceptance criteria:**
- [ ] Gambar cover salon, foto item katalog, banner promo otomatis tersimpan dalam ekstensi `.webp`.
- [ ] Ukuran file gambar yang dihasilkan turun drastis (rata-rata < 150 KB per gambar).
- [ ] Tag `<img>` di frontend menyertakan atribut `loading="lazy"` dan dimensi eksplisit `width` & `height`.
**Verification:**
- [ ] Upload gambar PNG berukuran 3 MB di panel admin -> periksa file yang tersimpan di disk `storage/` terkonversi menjadi file WebP dengan ukuran < 200 KB.
**Dependencies:** Task 1.5
**Files likely touched:**
- `app/Services/ImageOptimizer.php`
- `app/Filament/Resources/CatalogItemResource.php`
- `app/Filament/Resources/PromoResource.php`
**Estimated scope:** Small (3 file)

---

### Task 5.3: Metadata SEO, JSON-LD LocalBusiness & Sitemap Generator
**Description:** Memasang tag SEO standar (title dinamis, deskripsi meta, Open Graph image per halaman katalog), injeksi schema JSON-LD `LocalBusiness` (tipe `BeautySalon`) pada beranda, dan pembuatan sitemap otomatis di `/sitemap.xml`.
**Acceptance criteria:**
- [ ] Halaman beranda memuat tag `<script type="application/ld+json">` dengan detail salon di Banda Aceh, jam buka, dan geo-koordinat.
- [ ] Saat tautan katalog dibagikan di WhatsApp/Instagram, muncul preview kartu Open Graph dengan foto dan harga yang benar.
- [ ] Route `/sitemap.xml` menyajikan sitemap URL publik (beranda, katalog, harga, promo, lokasi) yang valid.
**Verification:**
- [ ] Validasi schema menggunakan Google Rich Results Test atau linter JSON-LD.
- [ ] Akses `/sitemap.xml` di browser dan pastikan format XML valid.
**Dependencies:** Task 2.1, Task 3.2, Task 3.4
**Files likely touched:**
- `resources/views/components/seo-meta.blade.php`
- `resources/views/components/schema-org.blade.php`
- `app/Http/Controllers/SitemapController.php`
**Estimated scope:** Small (3 file)

---

### Task 5.4: Keamanan, Rate Limiting, Error Pages 404 & Audit Performa
**Description:** Melakukan hardening keamanan aplikasi (rate limiting request, proteksi CSRF, sanitasi HTML rich text, keamanan header HTTP), mendesain halaman 404 dan mode maintenance bertema Putri Beauty Care, serta melakukan audit Lighthouse Mobile (target skor: Performance ≥ 90, SEO ≥ 95, Accessibility ≥ 90).
**Acceptance criteria:**
- [ ] Rate limit `throttle:15,1` aktif pada endpoint interaktif.
- [ ] Halaman 404 memiliki tombol navigasi kembali ke beranda dengan gaya visual yang selaras.
- [ ] Header keamanan dasar terpasang (X-Frame-Options, X-Content-Type-Options, Referrer-Policy).
- [ ] Audit Lighthouse pada perangkat mobile emulasi mencapai target skor PRD.
**Verification:**
- [ ] Jalankan audit Lighthouse di Chrome DevTools pada halaman beranda dan katalog.
- [ ] Kunjungi URL acak `/halaman-tidak-ada` untuk memverifikasi tampilan custom 404.
**Dependencies:** Seluruh task sebelumnya
**Files likely touched:**
- `app/Http/Middleware/SecurityHeaders.php`
- `bootstrap/app.php`
- `resources/views/errors/404.blade.php`
- `resources/views/errors/503.blade.php`
**Estimated scope:** Medium (4-5 file)

---

### Checkpoint 5: Siap Rilis (Production Ready)
- [ ] Seluruh kriteria penerimaan PRD terpenuhi 100%.
- [ ] Pengujian manual pada smartphone (Android Chrome & iOS Safari) berjalan mulus.
- [ ] Skor Lighthouse dan performa memenuhi standar aplikasi modern kelas atas.
