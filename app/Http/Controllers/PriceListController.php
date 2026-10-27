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
        $categories = Category::active()
            ->with(['activeItems' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->get();

        $lastUpdated = CatalogItem::max('updated_at');

        return view('pages.price-list', compact('categories', 'lastUpdated'));
    }
}
