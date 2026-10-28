<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\Category;
use App\Services\WhatsAppLink;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index()
    {
        $categories = Category::parents()
            ->active()
            ->with([
                'activeItems' => fn ($query) => $query->orderBy('sort_order'),
                'children' => fn ($q) => $q->active()->with(['activeItems' => fn ($iq) => $iq->orderBy('sort_order')]),
            ])
            ->get();

        $lastUpdated = CatalogItem::max('updated_at');

        return view('pages.price-list', compact('categories', 'lastUpdated'));
    }
}
