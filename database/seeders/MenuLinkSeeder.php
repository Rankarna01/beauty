<?php

namespace Database\Seeders;

use App\Models\MenuLink;
use Illuminate\Database\Seeder;

class MenuLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'label' => 'BOOKING SALON & SKINCARE',
                'description' => 'Pilih jadwal kamu sekarang',
                'icon' => 'calendar',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/booking',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'label' => 'DAFTAR HARGA TREATMENT',
                'description' => 'Lihat semua layanan & harga',
                'icon' => 'tag',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/harga',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'label' => 'PROMO BULAN INI',
                'description' => 'Jangan sampai kelewatan!',
                'icon' => 'percent',
                'badge_text' => 'HOT',
                'type' => 'internal_route',
                'url' => '/promo',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'label' => 'SKINCARE & FACIAL',
                'description' => 'Rawat kulitmu, tampil maksimal',
                'icon' => 'facial',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/katalog/skincare-facial',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'label' => 'HAIR, NAIL & SPA',
                'description' => 'Perawatan lengkap untukmu',
                'icon' => 'spa',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/katalog/hair-nail-spa',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'label' => 'KONSULTASI WHATSAPP',
                'description' => 'Tanya langsung ke admin',
                'icon' => 'whatsapp',
                'badge_text' => null,
                'type' => 'whatsapp',
                'url' => '/konsultasi',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'label' => 'LOKASI SALON',
                'description' => 'Temukan kami di Google Maps',
                'icon' => 'location',
                'badge_text' => null,
                'type' => 'internal_route',
                'url' => '/lokasi',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'label' => 'INSTAGRAM PUTRI BEAUTYCARE',
                'description' => 'Lihat hasil treatment & update',
                'icon' => 'instagram',
                'badge_text' => null,
                'type' => 'external_url',
                'url' => '/instagram',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            MenuLink::updateOrCreate(
                ['label' => $link['label']],
                $link
            );
        }
    }
}
