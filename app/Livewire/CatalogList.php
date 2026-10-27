<?php

namespace App\Livewire;

use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\WaClickLog;
use App\Services\WhatsAppLink;
use Livewire\Attributes\Url;
use Livewire\Component;

class CatalogList extends Component
{
    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'kategori')]
    public string $categorySlug = '';

    public string $typeFilter = 'all'; // all, service, product

    public ?int $selectedItemId = null;

    public function mount(?string $category = null)
    {
        if ($category) {
            $this->categorySlug = $category;
        }
    }

    public function selectCategory(string $slug = '')
    {
        $this->categorySlug = $slug;
    }

    public function openDetail(int $itemId)
    {
        $this->selectedItemId = $itemId;
    }

    public function closeDetail()
    {
        $this->selectedItemId = null;
    }

    public function logWhatsAppClick(int $itemId)
    {
        $item = CatalogItem::find($itemId);
        if ($item) {
            WaClickLog::record('catalog_inquiry', 'catalog_item', $item->id, '/katalog');
        }
    }

    public function getWhatsAppUrl(CatalogItem $item): string
    {
        $url = route('catalog.show', [
            'category' => $item->category->slug,
            'item' => $item->slug,
        ]);

        return WhatsAppLink::build('catalog_item', [
            'nama_produk' => $item->name,
            'harga' => $item->formatted_price,
            'url_item' => $url,
        ]);
    }

    public function render()
    {
        $categories = Category::active()
            ->withCount('activeItems')
            ->get();

        $query = CatalogItem::active()
            ->with(['category', 'images']);

        if (! empty($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('short_description', 'like', $searchTerm);
            });
        }

        if (! empty($this->categorySlug)) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        if ($this->typeFilter !== 'all') {
            $query->where('type', $this->typeFilter);
        }

        $items = $query->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        $selectedItem = $this->selectedItemId
            ? CatalogItem::with(['category', 'images'])->find($this->selectedItemId)
            : null;

        return view('livewire.catalog-list', [
            'categories' => $categories,
            'items' => $items,
            'selectedItem' => $selectedItem,
        ]);
    }
}
