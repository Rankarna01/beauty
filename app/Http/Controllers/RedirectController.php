<?php

namespace App\Http\Controllers;

use App\Models\WaClickLog;
use App\Services\WhatsAppLink;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function consultation(Request $request)
    {
        WaClickLog::record('consultation_click', 'general', null, '/konsultasi', $request);

        $waNumber = setting('contact.whatsapp_consultation', setting('contact.whatsapp_main', '6281362673728'));
        $waUrl = WhatsAppLink::build('consultation', [], $waNumber);

        return redirect()->away($waUrl);
    }

    public function instagram()
    {
        $instagramUrl = setting('social.instagram_url', 'https://instagram.com/putribeautycare');

        return redirect()->away($instagramUrl);
    }
}
