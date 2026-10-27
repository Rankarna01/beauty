# Spesifikasi Arsitektur & Teknis – Putri Beauty Care Website

*Dokumen Acuan Teknis Fullstack (Laravel 12, Livewire 3, Filament, Tailwind CSS)*

---

## 1. Ringkasan Eksekutif & Filosofi Desain

Putri Beauty Care adalah platform web profil dan katalog digital interaktif bergaya *mobile-first linktree modern* untuk salon, aesthetic & skincare di Banda Aceh. 

### Prinsip Inti Rekayasa:
1. **Zero E-Commerce Friction**: Tidak ada keranjang belanja, checkout, atau payment gateway. Seluruh konversi (booking, pembelian skincare, konsultasi) diarahkan langsung ke WhatsApp dengan *pre-formatted dynamic messages*.
2. **100% Dynamic Content via Admin**: Seluruh teks, jam buka, kontak WhatsApp, nomor alternatif, daftar menu pill, harga, promo, dan tautan sosial media dapat dikelola oleh staf/admin non-teknis melalui Filament Admin Panel tanpa modifikasi kode.
3. **High-Performance Mobile First**: Mayoritas pengunjung berasal dari Instagram bio dan chat WhatsApp via smartphone. LCP ditargetkan < 2.5 detik pada jaringan 4G dengan bundle CSS/JS yang ramping dan aset gambar teroptimasi otomatis ke format WebP.
4. **Clean & Secure Architecture**: Penggunaan Service Layer (`WhatsAppLink`, `OperatingHoursService`), Form Request validation, sanitasi rich-text HTML, rate-limiting anti-spam, serta penerapan prinsip Single Responsibility.

---

## 2. Tech Stack & Ekosistem

| Komponen | Teknologi | Keterangan & Rationale |
|---|---|---|
| **Backend Framework** | Laravel 12 (PHP 8.3+) | Modern, stabil, kaya fitur bawaan (auth, queue, caching, validation). |
| **Admin Panel** | Filament 3.x / 4.x | Panel administratif berbasis TALL stack yang sangat cepat dikembangkan, bersih, dan modular. |
| **Reactive Frontend** | Livewire 3 + Alpine.js | Pengalaman SPA interaktif (pencarian katalog instan, filter, form modal booking) tanpa overhead API Vue/React terpisah. |
| **Server-Rendered Views**| Blade Components | Halaman beranda, lokasi, detail promo menggunakan Blade statis/ter-cache untuk TTFB ultra cepat dan SEO optimal. |
| **Styling & Design System**| Tailwind CSS | Utility-first dengan kustomisasi tema warna brand, responsif, dan dukungan CSS Print untuk daftar harga. |
| **Database** | MySQL 8.0+ / MariaDB 10.6+ | Relasional, andal untuk relasi kategori, katalog, promo, dan jam operasional. |
| **Media & Asset Engine** | Spatie MediaLibrary / Intervention Image | Kompresi otomatis, resizing responsif, dan konversi ke WebP saat upload. |
| **Pengaturan Global** | Spatie Laravel Settings / `settings` table | Pengaturan key-value ter-cache dengan fallback nilai default. |
| **Iconography** | Blade Heroicons / Blade Lucide | Inline SVG tanpa payload webfont eksternal berlebih. |

---

## 3. Skema Basis Data & Model Relasi

### 3.1 Entity Relationship Diagram (ERD Konseptual)

```
[ users ] (Admin & Staff)
    
[ settings ] (Key-Value Dynamic Configuration)

[ menu_links ] (Urutan dan tautan pill beranda)

[ categories ] 
      │ 1
      │
      ▼ N
[ catalog_items ] ──1:N── [ catalog_item_images ]
      │
      │ N
      ▼ M (Pivot: catalog_item_promo)
  [ promos ]

[ locations ] 
      │ 1
      │
      ▼ N
[ operating_hours ]

[ wa_click_logs ] (Pencatatan analitik anonim)
```

### 3.2 Rincian Struktur Tabel

#### 1. `users`
*Pengguna panel administrasi.*
- `id`: unsigned bigint, PK
- `name`: varchar(255)
- `email`: varchar(255), unique
- `password`: varchar(255)
- `role`: enum (`super_admin`, `admin`, `staff`), default: `admin`
- `is_active`: boolean, default: true
- `remember_token`: varchar(100), nullable
- `timestamps`

#### 2. `settings`
*Konfigurasi global aplikasi.*
- `id`: unsigned bigint, PK
- `group`: varchar(50) (e.g. `general`, `contact`, `social`, `whatsapp_templates`, `appearance`, `seo`)
- `key`: varchar(100), unique index
- `value`: text/json, nullable
- `type`: varchar(30) (`string`, `text`, `json`, `boolean`, `integer`)
- `timestamps`

#### 3. `menu_links`
*Daftar tombol menu pill bergaya Linktree di beranda.*
- `id`: unsigned bigint, PK
- `label`: varchar(100) (e.g. "Booking Salon & Skincare")
- `description`: varchar(255), nullable (e.g. "Pilih jadwal perawatan favoritmu")
- `icon`: varchar(100), nullable (nama ikon Blade/Heroicons)
- `badge_text`: varchar(50), nullable (e.g. "Hot", "Promo")
- `type`: enum (`internal_route`, `external_url`, `whatsapp`)
- `url`: varchar(255)
- `sort_order`: integer, default: 0
- `is_active`: boolean, default: true
- `timestamps`

#### 4. `categories`
*Kelompok layanan atau lini produk skincare.*
- `id`: unsigned bigint, PK
- `name`: varchar(100)
- `slug`: varchar(120), unique
- `type`: enum (`service`, `product`), default: `service`
- `icon`: varchar(100), nullable
- `description`: text, nullable
- `sort_order`: integer, default: 0
- `is_active`: boolean, default: true
- `timestamps`

#### 5. `catalog_items`
*Katalog master untuk treatment salon maupun produk skincare.*
- `id`: unsigned bigint, PK
- `category_id`: unsigned bigint, FK -> `categories.id` (onDelete cascade/restrict)
- `type`: enum (`service`, `product`), default: `service`
- `name`: varchar(200)
- `slug`: varchar(220), unique
- `short_description`: varchar(300), nullable
- `description`: text, nullable
- `benefits`: json, nullable (array of bullet points manfaat)
- `duration_minutes`: integer, nullable (durasi estimasi treatment)
- `price_type`: enum (`fixed`, `starting_from`, `contact_us`), default: `fixed`
- `price`: unsigned integer, default: 0 (dalam Rupiah)
- `price_max`: unsigned integer, nullable (jika rentang harga)
- `compare_price`: unsigned integer, nullable (harga coret/asli)
- `badge`: varchar(50), nullable (e.g. "Best Seller", "Favorit")
- `is_featured`: boolean, default: false
- `is_active`: boolean, default: true
- `sort_order`: integer, default: 0
- `timestamps`, `softDeletes`

#### 6. `catalog_item_images`
*Galeri foto item katalog.*
- `id`: unsigned bigint, PK
- `catalog_item_id`: unsigned bigint, FK -> `catalog_items.id` (onDelete cascade)
- `image_path`: varchar(255)
- `alt_text`: varchar(255), nullable
- `sort_order`: integer, default: 0
- `timestamps`

#### 7. `promos`
*Halaman dan banner promo spesial bulanan.*
- `id`: unsigned bigint, PK
- `title`: varchar(200)
- `slug`: varchar(220), unique
- `banner_path`: varchar(255), nullable
- `summary`: varchar(300), nullable
- `content`: longtext, nullable (Rich Text / TipTap HTML)
- `starts_at`: datetime
- `ends_at`: datetime
- `is_active`: boolean, default: true
- `sort_order`: integer, default: 0
- `timestamps`, `softDeletes`

#### 8. `catalog_item_promo` (Pivot)
- `catalog_item_id`: unsigned bigint, FK -> `catalog_items.id`
- `promo_id`: unsigned bigint, FK -> `promos.id`
- Primary Key: (`catalog_item_id`, `promo_id`)

#### 9. `locations`
*Data cabang salon dan outlet.*
- `id`: unsigned bigint, PK
- `name`: varchar(150) (e.g. "Putri Beauty Care & Head Japanese Spa")
- `address`: text
- `city`: varchar(100), default: "Banda Aceh"
- `maps_url`: varchar(500), nullable (tautan ke aplikasi Google Maps)
- `maps_embed_url`: text, nullable (URL iframe embed Google Maps)
- `latitude`: decimal(10, 8), nullable
- `longitude`: decimal(11, 8), nullable
- `phone`: varchar(50), nullable
- `photo_path`: varchar(255), nullable
- `is_main_branch`: boolean, default: false
- `is_active`: boolean, default: true
- `sort_order`: integer, default: 0
- `timestamps`

#### 10. `operating_hours`
*Jadwal buka-tutup cabang per hari.*
- `id`: unsigned bigint, PK
- `location_id`: unsigned bigint, FK -> `locations.id` (onDelete cascade)
- `day_of_week`: tinyint (0 = Minggu, 1 = Senin, ..., 6 = Sabtu)
- `opens_at`: time, nullable (e.g. 09:00:00)
- `closes_at`: time, nullable (e.g. 21:00:00)
- `is_closed`: boolean, default: false
- `timestamps`

#### 11. `wa_click_logs` (Analitik Ringan)
*Pencatatan interaksi klik CTA WhatsApp tanpa menyimpan informasi pribadi pelanggan.*
- `id`: unsigned bigint, PK
- `action_type`: varchar(50) (`booking_submit`, `catalog_inquiry`, `promo_claim`, `consultation_click`, `floating_click`)
- `item_type`: varchar(50), nullable (`catalog_item`, `promo`, `general`)
- `item_id`: unsigned bigint, nullable
- `source_page`: varchar(100), nullable
- `ip_hash`: varchar(64), nullable (SHA-256 hash dengan salt untuk anonymization)
- `user_agent`: varchar(255), nullable
- `created_at`: timestamp

---

## 4. Desain Layanan Inti (Core Service Layer)

### 4.1 WhatsApp Link Generator Service (`App\Services\WhatsAppLink`)
Bertanggung jawab menghasilkan tautan `https://wa.me/...` terstandarisasi, menangani sanitasi nomor telepon (konversi `08xx` ke `628xx`), dan interpolasi template pesan dinamis.

#### Logika Interpolasi:
Placeholder yang didukung:
- `{nama}` : Nama pelanggan dari form booking
- `{layanan}` : Daftar nama layanan yang dipilih (dipisahkan koma atau bullet)
- `{tanggal}` : Tanggal booking terformat (e.g. "Senin, 28 Oktober 2026")
- `{jam}` : Jam kedatangan yang dipilih (e.g. "14:00 WIB")
- `{catatan}` : Catatan khusus pelanggan
- `{nama_produk}` : Nama item katalog / skincare
- `{harga}` : Harga terformat Rupiah (e.g. "Rp 150.000")
- `{url_item}` : Tautan lengkap detail produk/layanan

```php
namespace App\Services;

class WhatsAppLink
{
    public static function cleanPhoneNumber(string $number): string
    {
        $cleaned = preg_replace('/[^0-9]/', '', $number);
        if (str_starts_with($cleaned, '0')) {
            $cleaned = '62' . substr($cleaned, 1);
        }
        return $cleaned;
    }

    public static function build(string $type, array $placeholders = []): string
    {
        $phone = self::cleanPhoneNumber(setting('contact.whatsapp_main', '6281362673728'));
        $template = setting("whatsapp_templates.{$type}", self::getDefaultTemplate($type));
        
        $message = str_replace(
            array_keys($placeholders),
            array_values($placeholders),
            $template
        );

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode(trim($message));
    }
}
```

### 4.2 Operating Hours & Status Service (`App\Services\OperatingHoursService`)
Menghitung status "Buka Sekarang" atau "Tutup" secara *real-time* berbasis zona waktu **Asia/Jakarta (WIB)** dengan membandingkan hari dan waktu operasional lokasi utama.

---

## 5. Struktur Route & Arsitektur URL

| URI | Nama Route | Handler / Komponen | Tipe Respons |
|---|---|---|---|
| `/` | `home` | `App\Http\Controllers\HomeController` | Blade (Server-Rendered + Cache) |
| `/booking` | `booking` | `App\Livewire\BookingForm` | Livewire 3 Component |
| `/harga` | `price-list` | `App\Livewire\PriceList` | Livewire / Blade dengan CSS Print |
| `/katalog` | `catalog.index` | `App\Livewire\CatalogList` | Livewire 3 (Reaktif filter & search) |
| `/katalog/{category:slug}` | `catalog.category` | `App\Livewire\CatalogList` | Livewire 3 (Filtered by category) |
| `/katalog/{category:slug}/{item:slug}` | `catalog.show` | `App\Http\Controllers\CatalogController@show` | Blade Component + Open Graph SEO |
| `/promo` | `promo.index` | `App\Http\Controllers\PromoController@index` | Blade Page |
| `/promo/{promo:slug}` | `promo.show` | `App\Http\Controllers\PromoController@show` | Blade Page + WA Claim CTA |
| `/lokasi` | `locations` | `App\Http\Controllers\LocationController@index` | Blade Page + Lazy Map Embed |
| `/konsultasi` | `redirect.consultation`| `App\Http\Controllers\RedirectController@consultation` | 302 Redirect ke WhatsApp |
| `/instagram` | `redirect.instagram` | `App\Http\Controllers\RedirectController@instagram` | 302 Redirect ke Instagram Profile |
| `/admin/*` | `filament.admin.*` | Filament Admin Panel Resources & Pages | Filament 3/4 SPA |

---

## 6. Desain Visual & Token Desain (Tailwind Theme)

### 6.1 Token Warna
- **Primary Brand (Pink Magenta)**: `#E6107A` (`brand-primary`)
- **Primary Dark (Deep Magenta)**: `#C2095F` (`brand-primary-dark`)
- **Soft Pink (Card & Pill Background)**: `#FFE4EF` (`brand-soft-pink`)
- **Background Gradient**: `linear-gradient(180deg, #FFF5F9 0%, #FFFFFF 100%)`
- **Gold Accent (Borders & Badges)**: `#C9A24B` (`brand-gold`)
- **Text Main**: `#3B1A2B` (`brand-text-main`)
- **Text Muted/Secondary**: `#8A6477` (`brand-text-muted`)
- **WhatsApp Green**: `#25D366`

### 6.2 Tipografi
- **Brand Title / Script Accent**: `Playfair Display Italic` atau `Great Vibes` (digunakan hemat untuk sentuhan feminin pada nama salon/slogan).
- **Heading**: `Playfair Display` (serif anggun) & `Poppins SemiBold`.
- **Body & Controls**: `Poppins` / `Inter` dengan rendering tajam pada layar smartphone.

### 6.3 Standar Komponen UI
- **Pill Menu Cards**: Sudut melengkung (`rounded-3xl` / `rounded-full`), border emas tipis `1px border-[#C9A24B]/30`, ikon dalam wadah gradasi melingkar, indikator panah kanan chevron.
- **Catalog Cards**: Rasio gambar 4:5, `rounded-2xl`, bayangan halus `shadow-sm hover:shadow-md transition-all duration-200`, harga tebal dengan format mata uang rupiah.
- **Floating WhatsApp**: Tombol mengambang di pojok kanan bawah dengan z-index tinggi, animasi denyut (*pulse*) halus, dan toggle aktif/mati dari admin.

---

## 7. Keamanan & Kualitas Non-Fungsional

1. **Proteksi Input & Form**:
   - Validasi ketat pada `BookingForm` (panjang nama maks 100 karakter, tanggal minimal hari ini, sanitasi catatan teks).
   - Rate limiting via `throttle:10,1` untuk mencegah penyalahgunaan klik bot.
2. **Sanitasi Konten**:
   - Konten Rich Text TipTap pada halaman promo disanitasi menggunakan library HTML Purifier sebelum dirender untuk mencegah XSS tersimpan.
3. **Privasi Data**:
   - `wa_click_logs` hanya menyimpan hash IP satu arah (`hash('sha256', $ip . config('app.key'))`) tanpa data identitas sensitif pengguna.
4. **Optimasi Media**:
   - Semua upload gambar salon/treatment dikompresi dan dikonversi otomatis ke WebP dengan kompresi kualitas 80% dan pembatasan resolusi maksimal 1200px lebar.
5. **Aksesibilitas (WCAG AA)**:
   - Kontras warna teks `#3B1A2B` di atas `#FFF5F9` memenuhi rasio kontras 4.5:1.
   - Semua elemen interaktif memiliki area tap minimum 44x44 piksel.
6. **SEO & Structured Data**:
   - Metadata Open Graph dinamis per halaman katalog/promo.
   - Tag JSON-LD schema `LocalBusiness` (BeautySalon) pada beranda memuat nama, alamat Banda Aceh, koordinat geo, jam operasional, dan nomor kontak.
