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
            'phoneMain',
            'cleanPhone',
            'instagramUrl',
            'instagramUsername',
            'showFloatingWa'
        ));
    }
}
