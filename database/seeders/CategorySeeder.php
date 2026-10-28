<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Utama (Parent Categories)
        $mainCategories = [
            [
                'name' => 'Skincare & Facial Treatment',
                'slug' => 'skincare-facial',
                'type' => 'service',
                'icon' => 'fa-solid fa-spa',
                'description' => 'Perawatan wajah komprehensif: Basic, Premiere, Peeling, hingga Dermapen Treatment.',
                'sort_order' => 1,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Nail Art',
                'slug' => 'nail-art',
                'type' => 'service',
                'icon' => 'fa-solid fa-hand-sparkles',
                'description' => 'Layanan Nail Gel, French Nail, Glitter, Ombre, Cat Eye, dan Nail Art Aesthetic.',
                'sort_order' => 2,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Nail Treatment',
                'slug' => 'nail-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-hand-holding-heart',
                'description' => 'Perawatan kuku higienis, Manicure, Pedicure, Callus Treatment, Footspa, dan Refleksi.',
                'sort_order' => 3,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Eye Treatment',
                'slug' => 'eye-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-eye',
                'description' => 'Treatment bulu mata lentik natural: Lash Lift dan Lash Lift + Tint.',
                'sort_order' => 4,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Pricelist Salon & Hair',
                'slug' => 'hair-nail-spa',
                'type' => 'service',
                'icon' => 'fa-solid fa-shower',
                'description' => 'Perawatan rambut salon, Creambath, Hairmask, Hairspa Keratin, dan Japanese Head Spa.',
                'sort_order' => 5,
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'name' => 'Produk Skincare',
                'slug' => 'produk-skincare',
                'type' => 'product',
                'icon' => 'fa-solid fa-pump-soap',
                'description' => 'Rangkaian produk skincare resmi teruji aman untuk perawatan harian di rumah.',
                'sort_order' => 6,
                'is_active' => true,
                'parent_id' => null,
            ],
        ];

        foreach ($mainCategories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        $facialParent = Category::where('slug', 'skincare-facial')->first();

        // 2. Sub-Treatment Kategori di bawah Skincare & Facial Treatment
        $subTreatments = [
            [
                'parent_id' => $facialParent?->id,
                'name' => 'Basic Treatment',
                'slug' => 'basic-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-seedling',
                'description' => 'Treatment wajah harian esensial mulai Rp 100.000 (Tambah 1 treatment jadi Rp 150.000).',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'parent_id' => $facialParent?->id,
                'name' => 'Premiere Treatment',
                'slug' => 'premiere-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-gem',
                'description' => 'Perawatan wajah premiere Rp 135.000 (Tambah 1 jadi Rp 200.000 + Free Microdermabrasi).',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'parent_id' => $facialParent?->id,
                'name' => 'Peeling Treatment',
                'slug' => 'peeling-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-wand-magic-sparkles',
                'description' => 'Eksfoliasi dan regenerasi kulit: Enzim, Acne, Whitening, Bibir Rejuve, hingga 3D Peel.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'parent_id' => $facialParent?->id,
                'name' => 'Dermapen Treatment',
                'slug' => 'dermapen-treatment',
                'type' => 'service',
                'icon' => 'fa-solid fa-syringe',
                'description' => 'Terapi microneedling intensif untuk acne scar bopeng, whitening, dan DNA salmon PDRN.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($subTreatments as $sub) {
            Category::updateOrCreate(['slug' => $sub['slug']], $sub);
        }
    }
}
