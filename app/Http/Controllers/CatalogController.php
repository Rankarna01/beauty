<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\WaClickLog;
use App\Services\WhatsAppLink;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(?string $category = null)
    {
        return view('pages.catalog.index', compact('category'));
    }

    public function show(string $categorySlug, string $itemSlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $item = CatalogItem::where('slug', $itemSlug)
            ->where('category_id', $category->id)
            ->with(['category', 'images'])
            ->firstOrFail();

        $relatedItems = CatalogItem::active()
            ->where('category_id', $category->id)
            ->where('id', '!=', $item->id)
            ->take(4)
            ->get();

        $waUrl = WhatsAppLink::build('catalog_item', [
            'nama_produk' => $item->name,
            'harga' => $item->formatted_price,
            'url_item' => url()->current(),
        ]);

        return view('pages.catalog.show', compact('item', 'category', 'relatedItems', 'waUrl'));
    }
}
