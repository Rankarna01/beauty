<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MenuLink;
use App\Models\WaClickLog;
use App\Services\OperatingHoursService;
use App\Services\WhatsAppLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menuLinks = MenuLink::active()->get();
        if ($menuLinks->isEmpty()) {
            $menuLinks = collect([
                (object)[
                    'label' => 'BOOKING SALON & SKINCARE',
                    'description' => 'Pilih jadwal kamu sekarang',
                    'icon' => 'calendar',
                    'url' => '/booking',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'DAFTAR HARGA TREATMENT',
                    'description' => 'Lihat semua layanan & harga',
                    'icon' => 'tag',
                    'url' => '/harga',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'PROMO BULAN INI',
                    'description' => 'Jangan sampai kelewatan!',
                    'icon' => 'percent',
                    'url' => '/promo',
                    'badge_text' => 'HOT',
                ],
                (object)[
                    'label' => 'SKINCARE & FACIAL',
                    'description' => 'Rawat kulitmu, tampil maksimal',
                    'icon' => 'facial',
                    'url' => '/katalog/skincare-facial',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'HAIR, NAIL & SPA',
                    'description' => 'Perawatan lengkap untukmu',
                    'icon' => 'spa',
                    'url' => '/katalog/hair-nail-spa',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'KONSULTASI WHATSAPP',
                    'description' => 'Tanya langsung ke admin',
                    'icon' => 'whatsapp',
                    'url' => '/konsultasi',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'LOKASI SALON',
                    'description' => 'Temukan kami di Google Maps',
                    'icon' => 'location',
                    'url' => '/lokasi',
                    'badge_text' => null,
                ],
                (object)[
                    'label' => 'INSTAGRAM PUTRI BEAUTYCARE',
                    'description' => 'Lihat hasil treatment & update',
                    'icon' => 'instagram',
                    'url' => '/instagram',
                    'badge_text' => null,
                ],
            ]);
        }

        $location = Location::mainBranch()->first() ?? Location::active()->first();
        $operatingStatus = OperatingHoursService::getStatusBadge($location);

        $brandName = setting('general.brand_name', 'Putri Beauty Care');
        $tagline = setting('general.tagline', 'Salon, Aesthetic & Skincare');
        $slogan = setting('general.slogan', 'Your Beauty, Our Care');
        $footerText = setting('general.footer_text', 'Salon, Skincare & Aesthetic Banda Aceh · Follow for more updates');
        $chips = setting('appearance.featured_service_chips', [
            'Facial Treatment',
            'Hair Cut',
            'Creambath',
            'Hairmask',
            'Manicure',
            'Nail Art',
            'Head Spa',
        ]);

        $coverPhoto = setting('general.cover_photo') ?? setting('appearance.header_image');
        $headerImageUrl = null;
        if ($coverPhoto) {
            $headerImageUrl = str_starts_with($coverPhoto, 'http') ? $coverPhoto : asset('storage/' . $coverPhoto);
        }

        $phoneMain = setting('contact.whatsapp_main', '6281362673728');
        $cleanPhone = WhatsAppLink::cleanPhoneNumber($phoneMain);
        $instagramUrl = setting('social.instagram_url', 'https://instagram.com/putribeautycare');
        $instagramUsername = setting('social.instagram_username', 'putribeautycare');
        $showFloatingWa = (bool) setting('appearance.show_floating_wa', true);

        return view('home', compact(
            'menuLinks',
            'location',
            'operatingStatus',
            'brandName',
            'tagline',
            'slogan',
            'footerText',
            'chips',
            'headerImageUrl',
            'phoneMain',
            'cleanPhone',
            'instagramUrl',
            'instagramUsername',
            'showFloatingWa'
        ));
    }
}
