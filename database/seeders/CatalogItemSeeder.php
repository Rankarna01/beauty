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
        $hairCategory = Category::where('slug', 'hair-nail-spa')->first();
        $productCategory = Category::where('slug', 'produk-skincare')->first();

        $items = [
            // Skincare & Facial
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

            // Hair, Nail & Spa
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
            [
                'category_id' => $hairCategory?->id,
                'type' => 'service',
                'name' => 'Nail Art Aesthetic & Gel Manicure',
                'slug' => 'nail-art-aesthetic-gel-manicure',
                'short_description' => 'Kuku cantik rapi dengan gel polish tahan hingga 4 minggu.',
                'description' => 'Perawatan kuku higienis, perapihan kutikula, dan pewarnaan gel UV dengan desain custom aesthetic kekinian.',
                'benefits' => [
                    'Pilihan warna gel polish premium lengkap',
                    'Tahan gores dan kilap hingga 4 minggu',
                    'Peralatan disterilkan dengan autoclave',
                ],
                'duration_minutes' => 50,
                'price_type' => 'starting_from',
                'price' => 110000,
                'badge' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Produk Skincare
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

        // Tambahkan Promo Awal
        $promo = Promo::updateOrCreate(
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
    }
}
