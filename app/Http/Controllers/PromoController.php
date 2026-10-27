<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\WaClickLog;
use App\Services\WhatsAppLink;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::active()
            ->with('catalogItems')
            ->get();

        return view('pages.promo.index', compact('promos'));
    }

    public function show(string $slug, Request $request)
    {
        $promo = Promo::where('slug', $slug)
            ->with('catalogItems')
            ->firstOrFail();

        // Check if expired
        $isExpired = ! $promo->is_valid_now;

        $waUrl = WhatsAppLink::build('promo_claim', [
            'promo_title' => $promo->title,
        ]);

        return view('pages.promo.show', compact('promo', 'isExpired', 'waUrl'));
    }
}
