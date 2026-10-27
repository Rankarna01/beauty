<?php

namespace Database\Seeders;

use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\Promo;
use Illuminate\Database\Seeder;

class CatalogItemSeeder extends Seeder
{
    public function run(): void
    {
        $skincareCategory = Category::where('slug', 'skincare-facial')->first();
        $nailCategory = Category::where('slug', 'nail-art')->first();
        $hairCategory = Category::where('slug', 'hair-nail-spa')->first();
        $productCategory = Category::where('slug', 'produk-skincare')->first();

        $items = [
            // ==========================================
            // 1. Skincare & Facial
            // ==========================================
            [
                'category_id' => $skincareCategory?->id,
                'type' => 'service',
                'name' => 'Facial Treatment Glowing & Deep Cleanse',
                'slug' => 'facial-treatment-glowing-deep-cleanse',
                'short_description' => 'Pembersihan pori mendalam, ekstraksi komedo tanpa sakit, dan masker pencerah.',
                'description' => 'Perawatan wajah esensial Putri Beauty Care untuk mengangkat kotoran, sel kulit mati, dan komedo penyumbat pori. Menggunakan serum vitamin C dan masker peel-off dingin.',
                'benefits' => [
                    'Pembersihan komedo menyeluruh dan steril',
                    'Mengurangi minyak berlebih dan mengecilkan pori-pori',
                    'Wajah langsung tampak lebih cerah seketika',
                    'Relaksasi totok wajah melancarkan sirkulasi darah',
                ],
                'duration_minutes' => 60,
                'price_type' => 'fixed',
                'price' => 150000,
                'compare_price' => 180000,
                'badge' => 'Favorit',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $skincareCategory?->id,
                'type' => 'service',
                'name' => 'Acne Bio-Peeling & Calming Mask',
                'slug' => 'acne-bio-peeling-calming-mask',
                'short_description' => 'Solusi tepat meredakan jerawat meradang dan bekas kemerahan.',
                'description' => 'Terapi intensif untuk kulit berjerawat dan sensitif. Mengandung tea tree organic dan salicylic acid dosis medis aman untuk menenangkan bakteri jerawat.',
                'benefits' => [
                    'Meredakan jerawat aktif dalam 1-2 hari',
                    'Memudarkan bekas kemerahan (PIE)',
                    'Masker tea tree menyejukkan kulit iritasi',
                ],
                'duration_minutes' => 60,
                'price_type' => 'fixed',
                'price' => 175000,
                'badge' => 'Best Seller',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],

            // ==========================================
            // 2. Nail Art (Berdasarkan Daftar Menu Poster PBC)
            // Deskripsi dikosongkan sesuai instruksi user
            // ==========================================
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Nail Gel / Polos',
                'slug' => 'nail-gel-polos',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 45,
                'price_type' => 'starting_from',
                'price' => 60000,
                'price_max' => 70000,
                'badge' => 'Tangan 60k • Kaki 70k',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'French Nail',
                'slug' => 'french-nail',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 70000,
                'price_max' => 80000,
                'badge' => 'Tangan 70k • Kaki 80k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Glitter Nail Art',
                'slug' => 'glitter-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 75000,
                'price_max' => 85000,
                'badge' => 'Tangan 75k • Kaki 85k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Ombre Nail Art',
                'slug' => 'ombre-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 80000,
                'price_max' => 90000,
                'badge' => 'Tangan 80k • Kaki 90k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Marble Nail Art',
                'slug' => 'marble-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 80000,
                'price_max' => 90000,
                'badge' => 'Tangan 80k • Kaki 90k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Cat Eye / 3D Nail',
                'slug' => 'cat-eye-3d-nail',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 80000,
                'price_max' => 90000,
                'badge' => 'Tangan 80k • Kaki 90k',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Chrome Nail Art',
                'slug' => 'chrome-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 80000,
                'price_max' => 90000,
                'badge' => 'Tangan 80k • Kaki 90k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Minimalis Nail Art',
                'slug' => 'minimalis-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 45,
                'price_type' => 'starting_from',
                'price' => 80000,
                'price_max' => 90000,
                'badge' => 'Tangan 80k • Kaki 90k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Motif Gambar Nail Art',
                'slug' => 'motif-gambar-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 60,
                'price_type' => 'starting_from',
                'price' => 90000,
                'price_max' => 100000,
                'badge' => 'Tangan 90k • Kaki 100k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Full Aksesoris Nail Art',
                'slug' => 'full-aksesoris-nail-art',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 60,
                'price_type' => 'starting_from',
                'price' => 100000,
                'price_max' => 110000,
                'badge' => 'Tangan 100k • Kaki 110k',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Nail Art Mix Motif',
                'slug' => 'nail-art-mix-motif',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 60,
                'price_type' => 'fixed',
                'price' => 85000,
                'badge' => 'Spesial 85K',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'category_id' => $nailCategory?->id,
                'type' => 'service',
                'name' => 'Nail Art + Extension',
                'slug' => 'nail-art-extension',
                'short_description' => null,
                'description' => null,
                'benefits' => null,
                'duration_minutes' => 75,
                'price_type' => 'fixed',
                'price' => 120000,
                'compare_price' => 130000,
                'badge' => 'Disc 10K',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 12,
            ],

            // ==========================================
            // 3. Hair & Head Spa
            // ==========================================
            [
                'category_id' => $hairCategory?->id,
                'type' => 'service',
                'name' => 'Head Japanese Spa & Scalp Detox Therapy',
                'slug' => 'head-japanese-spa-scalp-detox-therapy',
                'short_description' => 'Sensasi sirkulasi air hangat melingkar khas Jepang dengan deep scalp cleansing.',
                'description' => 'Pengalaman relaksasi spa kepala nomor satu di Banda Aceh. Menggabungkan teknik pijat akupresur kepala, leher, pundak, aromaterapi herbal, dan shower ring water circulation.',
                'benefits' => [
                    'Relaksasi mendalam menghilangkan migrain & stres',
                    'Membersihkan ketombe dan sisa residu minyak rambut',
                    'Sensasi water circulation ring Jepang yang menenangkan',
                    'Termasuk blow dry & styling cantik',
                ],
                'duration_minutes' => 75,
                'price_type' => 'fixed',
                'price' => 200000,
                'compare_price' => 250000,
                'badge' => 'Unggulan',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $hairCategory?->id,
                'type' => 'service',
                'name' => 'Creambath Tradisional Aromatherapy',
                'slug' => 'creambath-tradisional-aromatherapy',
                'short_description' => 'Nutrisi rambut berkilau dengan pijatan leher & bahu relaksasi.',
                'description' => 'Creambath kaya ekstrak alpukat, lidah buaya, atau ginseng yang menutrisi akar rambut hingga ujungnya.',
                'benefits' => [
                    'Menutrisi rambut kering dan rusak',
                    'Pijatan bahu & punggung melepaskan ketegangan otot',
                    'Rambut wangi dan halus tahan berhari-hari',
                ],
                'duration_minutes' => 60,
                'price_type' => 'fixed',
                'price' => 120000,
                'badge' => 'Populer',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],

            // ==========================================
            // 4. Produk Skincare
            // ==========================================
            [
                'category_id' => $productCategory?->id,
                'type' => 'product',
                'name' => 'Putri Glow Day Sunscreen SPF 50 PA++++',
                'slug' => 'putri-glow-day-sunscreen-spf50',
                'short_description' => 'Sunscreen ringan tanpa whitecast dengan efek tone-up alami.',
                'description' => 'Tabir surya harian bersertifikat BPOM dengan perlindungan spektrum luas UVA/UVB dan blue light. Mengandung Niacinamide dan Centella Asiatica.',
                'benefits' => [
                    'Tekstur seringan air, cepat meresap',
                    'Tidak menyumbat pori (non-comedogenic)',
                    'Efek glowing sehat tanpa rasa lengket',
                ],
                'duration_minutes' => null,
                'price_type' => 'fixed',
                'price' => 95000,
                'badge' => 'Baru',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
        ];

        foreach ($items as $itemData) {
            CatalogItem::updateOrCreate(['slug' => $itemData['slug']], $itemData);
        }

        // Promo Awal: Glowing Berdua
        Promo::updateOrCreate(
            ['slug' => 'promo-glowing-oktober'],
            [
                'title' => 'Promo Spesial Glowing Berdua (Diskon 25%)',
                'summary' => 'Treatment Facial Glow + Japanese Head Spa hemat hingga Rp 100.000 selama bulan ini.',
                'content' => '<p>Nikmati momen me-time sempurna bersama sahabat atau keluarga di <strong>Putri Beauty Care Banda Aceh</strong>! Paket bundling facial glowing dan Japanese head spa kini hadir dengan harga spesial.</p><h3>Syarat & Ketentuan:</h3><ul><li>Berlaku untuk reservasi jadwal via WhatsApp.</li><li>Promo berlaku hingga akhir bulan.</li><li>Tidak dapat digabung dengan promo voucher lain.</li></ul>',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(7),
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        // Promo Nail Art: Nail Art + Extension Disc 10K
        Promo::updateOrCreate(
            ['slug' => 'promo-nail-art-extension'],
            [
                'title' => 'Promo Nail Art + Extension (Potongan Rp 10.000)',
                'summary' => 'Dapatkan potongan langsung Rp 10.000 untuk setiap perawatan Nail Art + Extension cantik pilihanmu!',
                'content' => '<p>Ingin kuku lentik dan aesthetic tahan lama? Klaim potongan harga spesial Rp 10.000 khusus treatment <strong>Nail Art + Extension</strong> di Putri Beauty Care Banda Aceh.</p><h3>Ketentuan:</h3><ul><li>Berlaku untuk semua motif nail art custom.</li><li>Berlaku untuk reservasi WhatsApp dan langsung di outlet.</li></ul>',
                'starts_at' => now()->startOfMonth(),
                'ends_at' => now()->endOfMonth()->addDays(14),
                'is_active' => true,
                'sort_order' => 2,
            ]
        );
    }
}
