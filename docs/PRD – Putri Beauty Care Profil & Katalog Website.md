# PRD – Putri Beauty Care: Profil & Katalog Website

*Versi 1.0 · Stack: Laravel + Livewire + Filament · Oktober 2026*

## 1. Ringkasan Produk

**Putri Beauty Care** adalah salon, aesthetic & skincare di Banda Aceh. Sistem ini adalah **website profil + katalog (mobile-first, bergaya linktree)** yang menggantikan poster/menu statis. Seluruh konten (layanan, harga, promo, lokasi, kontak, sosmed) **dikelola dinamis lewat admin panel**. Sistem **tidak memproses transaksi**: semua aksi (booking, beli, konsultasi) diarahkan ke **WhatsApp** dengan pesan terformat otomatis.

**Prinsip utama:**

- Ringan & cepat dibuka dari HP (mayoritas pengunjung datang dari Instagram/WhatsApp).
- Semua teks, harga, tautan, dan jam operasional bisa diubah admin tanpa developer.
- Tidak ada pembayaran, keranjang, atau stok. Katalog saja, closing lewat WhatsApp.

## 2. Tujuan & Non-Tujuan

### Tujuan

1. Menampilkan profil, layanan, dan daftar harga secara rapi dan selalu up-to-date.
2. Mempermudah pelanggan booking/bertanya via WhatsApp dengan 1–2 tap.
3. Memberi admin kontrol penuh atas konten tanpa coding.
4. Menjadi satu link utama untuk bio Instagram, kartu nama, dan QR code salon.

### Non-Tujuan (di luar lingkup v1)

- Pembayaran online, keranjang belanja, checkout, manajemen stok.
- Sistem booking dengan kalender slot real-time & bentrok jadwal.
- Login/akun pelanggan.
- Aplikasi mobile native.

## 3. Pengguna

| Peran | Deskripsi | Kebutuhan utama |
| --- | --- | --- |
| **Pengunjung / Pelanggan** | Calon pelanggan, umumnya dari Instagram atau WhatsApp via HP | Lihat layanan & harga cepat, booking/tanya via WA, cari lokasi |
| **Admin** | Pemilik atau staf salon | Kelola konten, harga, promo, pengaturan tanpa coding |
| **Super Admin** (opsional) | Developer/pemilik | Kelola akun admin, pengaturan teknis |

## 4. Fitur Aplikasi Pelanggan (Public Site)

Menu pada poster dipetakan menjadi halaman/komponen berikut.

### 4.1 Halaman Beranda (Linktree + Profil)

Halaman utama berbentuk **linktree modern**:

- **Header:** logo, nama brand, tagline ("Salon, Aesthetic & Skincare"), foto cover salon, slogan.
- **Ringkasan layanan unggulan** (chip: Facial Treatment, Hair Cut, Creambath, Hairmask, Manicure, Nail Art, Head Spa) – dinamis dari admin.
- **Kartu kontak cepat:** tombol WhatsApp (nomor) dan alamat singkat.
- **Menu tombol (pill card)**, urutan & tampil/sembunyi diatur admin:
  - Booking Salon & Skincare → WhatsApp (format pesan otomatis)
  - Daftar Harga Treatment → halaman daftar harga
  - Promo Bulan Ini → halaman promo
  - Skincare & Facial → katalog kategori
  - Hair, Nail & Spa → katalog kategori
  - Konsultasi WhatsApp → WhatsApp
  - Lokasi Salon → halaman lokasi / Google Maps
  - Instagram → link eksternal
- **Jam operasional** (Senin–Minggu, 09.00–21.00 WIB) dengan indikator "Buka sekarang / Tutup".
- **Footer:** nilai brand (Salon, Skincare, Aesthetic), tagline, link follow Instagram.

> Menu bersifat dinamis: admin bisa menambah, mengubah label/ikon/deskripsi/tautan, mengurutkan, dan menonaktifkan.

### 4.2 Booking via WhatsApp

Tombol booking membuka **form singkat (modal/halaman Livewire)**, lalu mengarahkan ke WhatsApp.

**Field form:** Nama, Layanan (pilih dari katalog, bisa lebih dari satu), Tanggal, Jam, Catatan (opsional).

**Perilaku:**

1. Validasi ringan (nama, layanan, tanggal tidak boleh lampau).
2. Susun pesan dari **template yang bisa diedit admin**.
3. Buka `https://wa.me/<nomor>?text=<pesan-ter-encode>` di tab baru.
4. (Opsional, lihat 6.4) Simpan log permintaan untuk statistik.

**Contoh format pesan default:**

```
Halo Putri Beauty Care 👋
Saya ingin booking:

Nama     : {nama}
Layanan  : {layanan}
Tanggal  : {tanggal}
Jam      : {jam}
Catatan  : {catatan}

Mohon info ketersediaan jadwalnya, terima kasih 🙏
```

Placeholder yang didukung: `{nama}`, `{layanan}`, `{tanggal}`, `{jam}`, `{catatan}`, `{harga}`, `{nama_produk}`.

### 4.3 Katalog Layanan & Produk

Satu mesin katalog dipakai untuk **Skincare & Facial** dan **Hair, Nail & Spa** (dan kategori lain yang ditambah admin).

- **Halaman kategori:** grid kartu (foto, nama, harga/rentang harga, durasi, badge "Promo"/"Populer").
- **Filter & pencarian:** per kategori, pencarian nama (Livewire, tanpa reload).
- **Detail item (modal atau halaman):** galeri foto, deskripsi, manfaat, durasi, harga, catatan khusus, tombol **"Pesan via WhatsApp"**.
- **Tombol beli/pesan** pada setiap kartu → WhatsApp dengan pesan berisi nama item, harga, dan tautan halaman item.
- Item dibedakan tipe **Layanan (treatment)** atau **Produk (skincare)**; tampilan sama, label berbeda ("Booking" vs "Pesan").

### 4.4 Daftar Harga Treatment

- Halaman price list **dikelompokkan per kategori**, tampilan accordion/tabel responsif.
- Menampilkan nama, durasi, harga (harga tunggal, rentang "mulai dari", atau "hubungi kami").
- Tombol booking per baris.
- Opsi **unduh/cetak** daftar harga (cetak via CSS print; PDF opsional fase 2).
- Tanggal "Terakhir diperbarui" otomatis.

### 4.5 Promo (Halaman Informasi)

- Daftar promo aktif (banner, judul, periode, ringkasan).
- Halaman detail promo (rich text: syarat & ketentuan, layanan terkait).
- Promo otomatis tampil/hilang sesuai tanggal mulai–berakhir; label "Berakhir dalam X hari".
- Tombol "Klaim promo via WhatsApp" dengan pesan berisi nama promo.
- Promo bersifat **informasi** (tanpa kode voucher/diskon otomatis di v1).
- Halaman ini juga bisa diperluas menjadi halaman informasi lain (mis. tips perawatan) di fase berikutnya.

### 4.6 Lokasi

- Alamat lengkap, patokan, foto salon, jam operasional.
- Tombol **"Buka di Google Maps"** dan **"Petunjuk arah"**.
- Embed Google Maps (iframe, *lazy-load*) bila admin mengisi URL embed.
- Mendukung **lebih dari satu cabang** (data berbentuk daftar lokasi).

### 4.7 Konsultasi WhatsApp & Instagram

- **Konsultasi:** tombol WA dengan pesan awal yang bisa diatur admin (mis. "Halo kak, saya ingin konsultasi tentang perawatan kulit/rambut").
- **Instagram:** tautan ke akun, label dan username dinamis dari pengaturan.
- **Floating button WhatsApp** di semua halaman (bisa diaktifkan/nonaktifkan).

### 4.8 Fitur Pendukung

- SEO dasar (title, meta description, Open Graph, sitemap, structured data *LocalBusiness*).
- Tombol bagikan & QR code halaman utama (untuk dicetak di salon).
- Halaman 404 dan mode maintenance yang rapi.

## 5. Fitur Admin Panel (Filament)

Panel di `/admin`, login dengan email & password. Semua modul berikut berupa **Filament Resource** kecuali dinyatakan lain.

| Modul | Fungsi | Field utama |
| --- | --- | --- |
| **Dashboard** | Ringkasan: jumlah layanan, promo aktif, klik WA 7/30 hari, item terpopuler | Widget statistik & grafik |
| **Menu Beranda** | Atur tombol linktree | Label, deskripsi, ikon, tipe tautan (internal/eksternal/WA), URL, urutan, aktif |
| **Kategori** | Kategori katalog | Nama, slug, tipe (layanan/produk), ikon, deskripsi, urutan, aktif |
| **Katalog (Layanan & Produk)** | Item katalog + daftar harga | Nama, slug, kategori, tipe, deskripsi, manfaat, durasi, tipe harga, harga, harga maksimum, harga coret, foto/galeri, badge, unggulan, aktif, urutan |
| **Promo** | Informasi promo | Judul, slug, banner, ringkasan, konten rich text, mulai, berakhir, item terkait, aktif |
| **Lokasi** | Cabang/alamat | Nama, alamat, kota, URL Google Maps, URL embed, latitude/longitude, foto, telepon, aktif |
| **Jam Operasional** | Jadwal per hari | Hari, buka, tutup, libur (toggle) |
| **Pengaturan** (halaman custom) | Konfigurasi global | Lihat bagian 5.1 |
| **Log Klik WA** (opsional) | Riwayat permintaan | Jenis aksi, item, waktu, halaman asal |
| **Pengguna Admin** | Akun admin & peran | Nama, email, peran |

### 5.1 Halaman Pengaturan (dinamis)

- **Identitas:** nama brand, tagline, slogan, logo, favicon, foto cover.
- **Kontak:** nomor WhatsApp utama (otomatis dinormalisasi ke format `62…`), nomor admin konsultasi, email.
- **Sosial media:** Instagram (username & URL), TikTok/Facebook (opsional).
- **Template pesan WhatsApp:** booking, pesan item/produk, klaim promo, konsultasi.
- **Tampilan:** warna utama & aksen, tampil/sembunyi floating WA, teks footer.
- **SEO:** judul default, deskripsi, gambar OG.
- **Layanan unggulan (chip beranda):** daftar teks yang bisa diatur.

### 5.2 Kebutuhan UX Admin

- Upload gambar dengan crop/kompresi otomatis ke WebP.
- Drag & drop untuk urutan (reorderable table).
- Toggle aktif/nonaktif cepat dari tabel.
- Pencarian, filter kategori, dan *bulk action* (aktif/nonaktifkan, hapus).
- Pratinjau tautan WhatsApp pada form pengaturan.

### 5.3 Peran & Hak Akses

| Peran | Akses |
| --- | --- |
| Super Admin | Semua modul termasuk pengguna & pengaturan teknis |
| Admin | Kelola konten (katalog, promo, lokasi, pengaturan umum) |
| Staf (opsional) | Hanya katalog & promo |

## 6. Model Data (Ringkas)

### 6.1 Tabel Inti

| Tabel | Kolom penting |
| --- | --- |
| `users` | id, name, email, password, role |
| `settings` | id, group, key, value (JSON), type — pengaturan kunci-nilai |
| `menu_links` | id, label, description, icon, type, url, sort\_order, is\_active |
| `categories` | id, name, slug, type (service/product), icon, description, sort\_order, is\_active |
| `catalog_items` | id, category\_id, type, name, slug, short\_description, description, benefits (JSON), duration\_minutes, price\_type (fixed/starting\_from/contact), price, price\_max, compare\_price, badge, is\_featured, is\_active, sort\_order |
| `catalog_item_images` | id, catalog\_item\_id, path, alt, sort\_order |
| `promos` | id, title, slug, banner, summary, content, starts\_at, ends\_at, is\_active |
| `catalog_item_promo` | catalog\_item\_id, promo\_id (pivot) |
| `locations` | id, name, address, city, maps\_url, maps\_embed, lat, lng, phone, photo, is\_active, sort\_order |
| `operating_hours` | id, location\_id, day\_of\_week, opens\_at, closes\_at, is\_closed |
| `wa_click_logs` (opsional) | id, action, item\_type, item\_id, page, ip\_hash, user\_agent, created\_at |

### 6.2 Aturan Data

- Slug unik dan otomatis dari nama; `softDeletes` pada katalog dan promo.
- Harga disimpan sebagai integer (Rupiah), diformat `Rp 150.000` di tampilan.
- Promo dianggap aktif bila `is_active` dan tanggal sekarang berada di antara `starts_at` dan `ends_at`.
- Nomor WA dinormalisasi: `0813…` → `62813…`, hanya digit.

### 6.3 Layanan WhatsApp (Service Class)

Satu kelas `WhatsAppLink` bertanggung jawab: mengambil nomor & template dari settings, mengganti placeholder, meng-*encode* teks, dan mengembalikan URL `wa.me`. Semua tombol WA di aplikasi memakai kelas ini agar format konsisten.

### 6.4 Pencatatan Klik (Opsional)

Mencatat klik tombol WA (tanpa data pribadi sensitif) untuk statistik dashboard. Dapat dimatikan lewat pengaturan. Tidak menyimpan isi pesan pelanggan.

## 7. Struktur Halaman & Route

| URL | Halaman | Komponen |
| --- | --- | --- |
| `/` | Beranda linktree | `Home` (Livewire/Blade) |
| `/booking` | Form booking → WA | `BookingForm` (Livewire) |
| `/harga` | Daftar harga | `PriceList` |
| `/katalog` | Semua kategori | `CatalogIndex` |
| `/katalog/{kategori}` | Katalog per kategori | `CatalogCategory` |
| `/katalog/{kategori}/{item}` | Detail item | `CatalogShow` |
| `/promo` | Daftar promo | `PromoIndex` |
| `/promo/{slug}` | Detail promo | `PromoShow` |
| `/lokasi` | Lokasi & jam buka | `Locations` |
| `/konsultasi` | Redirect ke WA | Controller |
| `/instagram` | Redirect ke IG | Controller |
| `/admin` | Panel Filament | Filament |

Route `/konsultasi` dan `/instagram` berupa redirect agar tautan pendek dapat dicetak/QR tanpa berubah walau tujuan akhirnya diganti admin.

## 8. Desain & Gaya Visual

Mengacu pada poster: **feminin, elegan, hangat, premium**.

### 8.1 Palet Warna (token Tailwind, bisa diubah dari pengaturan)

| Peran | Warna acuan |
| --- | --- |
| Primary (pink magenta) | `#E6107A` |
| Primary gelap | `#C2095F` |
| Pink lembut (latar kartu) | `#FFE4EF` |
| Latar halaman | gradasi `#FFF5F9` → `#FFFFFF` |
| Aksen emas | `#C9A24B` |
| Teks utama | `#3B1A2B` |
| Teks sekunder | `#8A6477` |

### 8.2 Tipografi

- **Judul/brand:** font script elegan (mis. *Great Vibes* atau *Playfair Display Italic*) hanya untuk nama brand dan tagline.
- **Heading:** *Playfair Display* atau *Poppins SemiBold*.
- **Isi:** *Poppins* atau *Inter* (ringan, mudah dibaca).
- Gunakan `font-display: swap` dan batasi bobot font agar tetap ringan.

### 8.3 Komponen UI

- **Pill card menu:** sudut sangat bulat (`rounded-full`/`rounded-3xl`), border emas tipis, ikon dalam lingkaran gradasi pink, panah di kanan.
- **Kartu katalog:** foto rasio 4:5, sudut `rounded-2xl`, bayangan lembut, badge promo emas.
- **Tombol utama:** gradasi pink, teks putih; **tombol WhatsApp** hijau WA dengan ikon.
- **Aksen dekoratif:** garis emas, mahkota kecil, motif bunga/daun transparan (SVG ringan, bukan gambar besar).
- **Ikon:** Heroicons/Lucide via Blade Icons (SVG inline).
- **Mikro-interaksi:** hover/tap halus, transisi 150–200 ms, tanpa animasi berat.

### 8.4 Prinsip Layout

- **Mobile-first:** satu kolom di HP (maks lebar konten ±480 px di desktop untuk beranda), grid 2 kolom untuk katalog di HP, 3–4 kolom di desktop.
- Area sentuh minimal 44 px, kontras teks memenuhi WCAG AA.
- Mendukung mode terang saja pada v1 (dark mode opsional fase 2).

## 9. Teknologi

| Lapisan | Pilihan |
| --- | --- |
| Backend | **Laravel 12** (PHP 8.3+) |
| UI pelanggan | **Livewire 3** + **Blade**, **Tailwind CSS** Cdn |
| Interaktivitas ringan | Alpine.js (bawaan Livewire) |
| Admin | **Filament 4** (atau 3.x yang stabil) |
| Database | MySQL 8 / MariaDB (alternatif PostgreSQL) |
| Media | Spatie Media Library atau storage Laravel + konversi WebP (Intervention Image) |
| Pengaturan | Spatie Laravel Settings atau tabel `settings` + cache |
| Rich text | Filament Rich Editor / TipTap |
| SEO | `artesaos/seotools` atau implementasi Blade sendiri, `spatie/laravel-sitemap` |
| Deploy | shared hosting dengan PHP 8.2,&#32; |

### 9.1 Pembagian Peran Livewire vs Blade

- **Blade murni (statis, di-cache):** beranda, lokasi, detail promo — cepat dan ramah SEO.
- **Livewire:** form booking, pencarian/filter katalog, modal detail item.
- Hindari komponen Livewire berat pada halaman yang tidak butuh interaksi.

### 9.2 Struktur Kode (saran)

```
app/
  Filament/Resources/   (Category, CatalogItem, Promo, Location, MenuLink)
  Filament/Pages/       (Settings)
  Livewire/             (BookingForm, CatalogList, PriceList, ...)
  Models/
  Services/WhatsAppLink.php
  Settings/             (GeneralSettings, WhatsAppSettings, ...)
resources/views/
  components/           (menu-pill, catalog-card, price-row, wa-button)
  livewire/
  layouts/app.blade.php
```

## 10. Kebutuhan Non-Fungsional

### 10.1 Performa

- Target Lighthouse mobile: **Performance ≥ 90**, SEO ≥ 95, Accessibility ≥ 90.
- LCP < 2,5 detik pada 4G; total halaman beranda < 500 KB (di luar foto cover).
- Gambar WebP dengan `srcset`, `loading="lazy"`, dimensi eksplisit; Google Maps dimuat saat dibutuhkan.
- Eager loading relasi untuk mencegah N+1; cache query katalog dan pengaturan.

### 10.2 Keamanan

- Autentikasi Filament dengan hash password, *rate limiting* login, opsi 2FA.
- Validasi & sanitasi semua input; rich text disanitasi sebelum ditampilkan.
- Proteksi CSRF (bawaan Laravel), *throttle* pada form booking.
- Upload dibatasi tipe & ukuran (mis. JPG/PNG/WebP, maks 2 MB).
- HTTPS wajib, header keamanan dasar, backup database terjadwal.

### 10.3 Ketersediaan & Pemeliharaan

- Backup harian database dan folder media (retensi 7–14 hari).
- Log error terpusat; opsi Sentry/Flare.
- Mode maintenance dengan pesan ramah.

### 10.4 Kompatibilitas & Aksesibilitas

- Browser: dua versi terbaru Chrome, Safari, Firefox, Edge; Android & iOS.
- Teks alternatif gambar, label form, fokus keyboard terlihat, hierarki heading benar.
- Bahasa antarmuka: **Indonesia** (struktur siap multi-bahasa bila diperlukan).

## 11. Kriteria Penerimaan (Contoh)

1. Admin mengubah nomor WhatsApp di pengaturan; seluruh tombol WA memakai nomor baru tanpa deploy.
2. Admin menambah layanan "Nail Art" dengan harga & foto; item muncul di katalog dan daftar harga dalam kategori yang benar.
3. Pengunjung mengisi form booking; WhatsApp terbuka dengan pesan sesuai template dan data yang diisi.
4. Promo dengan tanggal berakhir kemarin tidak tampil di halaman publik.
5. Item yang dinonaktifkan tidak tampil di katalog, daftar harga, maupun pencarian.
6. Beranda memuat < 2,5 detik di jaringan 4G pada perangkat menengah.
7. Admin menyembunyikan menu "Instagram" di beranda; tombol hilang tanpa error.

## 12. Rencana Rilis

| Fase | Cakupan | Estimasi |
| --- | --- | --- |
| **Fase 1 – MVP** | Setup proyek, Filament (pengaturan, kategori, katalog, menu, lokasi, jam), beranda linktree, katalog, daftar harga, tombol WA, lokasi | 2–3 minggu |
| **Fase 2 – Pelengkap** | Form booking → WA, modul promo + halaman detail, SEO & sitemap, floating WA, optimasi gambar | 1–2 minggu |
| **Fase 3 – Penyempurnaan** | Log klik & dashboard statistik, QR code, cetak/PDF daftar harga, uji performa, UAT, go-live | 1 minggu |
| **Fase 4 – Opsional** | Multi-cabang penuh, dark mode, galeri hasil treatment, testimoni, halaman artikel/tips, multi-bahasa | Menyusul |

## 13. Risiko & Pertanyaan Terbuka

### Risiko

- **Ketergantungan pada WhatsApp:** bila nomor diblokir/berganti, semua alur terdampak → nomor disimpan di pengaturan agar cepat diganti.
- **Konten tidak diperbarui:** harga/promo kedaluwarsa → promo punya masa berlaku otomatis dan tanggal "terakhir diperbarui" pada daftar harga.
- **Foto berukuran besar** memperlambat situs → kompresi otomatis ke WebP.
- **Pesan WA otomatis tidak diterima admin** (pelanggan menutup tab sebelum kirim) → mitigasi lewat log klik sebagai indikator minat.

### Pertanyaan Terbuka

1. Apakah alamat "Head Japanese Spa, Jl. Sultan Iskandar Muda, Banda Aceh" adalah satu-satunya cabang, atau akan ada lebih dari satu?
2. Apakah produk skincare yang dijual memiliki varian (ukuran/seri) yang perlu ditampilkan, atau cukup satu harga per produk?
3. Apakah perlu menampilkan nama terapis/dokter atau portofolio hasil treatment?
4. Apakah cukup satu nomor WhatsApp, atau perlu nomor terpisah untuk booking dan konsultasi?
5. Domain dan hosting yang akan dipakai (shared hosting atau VPS)?
6. Apakah log klik/statistik diperlukan sejak MVP atau cukup fase berikutnya?

## 14. Lampiran – Pemetaan Poster ke Fitur

| Elemen poster | Fitur sistem | Sumber data |
| --- | --- | --- |
| Logo, nama, tagline | Header beranda | Pengaturan › Identitas |
| Chip layanan (Facial, Hair Cut, dst.) | Layanan unggulan | Pengaturan › Layanan unggulan |
| WA 081362673728 | Kartu kontak, tombol WA | Pengaturan › Kontak |
| Alamat Head Japanese Spa | Kartu lokasi, halaman Lokasi | Modul Lokasi |
| Booking Salon & Skincare | Form booking → WA | Template pesan booking |
| Daftar Harga Treatment | Halaman `/harga` | Modul Katalog |
| Promo Bulan Ini | Halaman `/promo` | Modul Promo |
| Skincare & Facial | Katalog kategori | Modul Kategori & Katalog |
| Hair, Nail & Spa | Katalog kategori | Modul Kategori & Katalog |
| Konsultasi WhatsApp | Tombol WA konsultasi | Template pesan konsultasi |
| Lokasi Salon | Halaman Lokasi / Maps | Modul Lokasi |
| Instagram Putri BeautyCare | Tautan IG | Pengaturan › Sosial media |
| Jam operasional Senin–Minggu 09.00–21.00 WIB | Blok jam buka + status buka/tutup | Modul Jam Operasional |
| Tagline "Your Beauty, Our Care" & "Follow for more" | Footer | Pengaturan › Tampilan |
