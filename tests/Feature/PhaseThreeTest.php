<?php

namespace Tests\Feature;

use App\Livewire\CatalogList;
use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\Promo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhaseThreeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create([
            'name' => 'Skincare & Facial',
            'slug' => 'skincare-facial',
            'type' => 'service',
            'is_active' => true,
        ]);

        $this->item = CatalogItem::create([
            'category_id' => $this->category->id,
            'name' => 'Facial Treatment Glowing',
            'slug' => 'facial-treatment-glowing',
            'type' => 'service',
            'price_type' => 'fixed',
            'price' => 150000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);

        $this->activePromo = Promo::create([
            'title' => 'Promo Diskon Glowing',
            'slug' => 'promo-diskon-glowing',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDays(7),
            'is_active' => true,
        ]);

        $this->expiredPromo = Promo::create([
            'title' => 'Promo Kadaluwarsa',
            'slug' => 'promo-kadaluwarsa',
            'starts_at' => now()->subDays(10),
            'ends_at' => now()->subDays(1),
            'is_active' => true,
        ]);
    }

    public function test_catalog_index_page_can_be_rendered(): void
    {
        $response = $this->get('/katalog');

        $response->assertStatus(200);
        $response->assertSeeLivewire(CatalogList::class);
    }

    public function test_catalog_category_page_can_be_rendered(): void
    {
        $response = $this->get('/katalog/skincare-facial');

        $response->assertStatus(200);
        $response->assertSeeLivewire(CatalogList::class);
    }

    public function test_catalog_item_detail_page_can_be_rendered(): void
    {
        $response = $this->get('/katalog/skincare-facial/facial-treatment-glowing');

        $response->assertStatus(200);
        $response->assertSee('Facial Treatment Glowing');
        $response->assertSee('Rp 150.000');
    }

    public function test_price_list_page_can_be_rendered(): void
    {
        $response = $this->get('/harga');

        $response->assertStatus(200);
        $response->assertSee('Daftar Harga Treatment');
        $response->assertSee('Skincare & Facial');
        $response->assertSee('Facial Treatment Glowing');
    }

    public function test_promo_index_page_displays_active_promos_and_hides_expired_ones(): void
    {
        $response = $this->get('/promo');

        $response->assertStatus(200);
        $response->assertSee('Promo Diskon Glowing');
        $response->assertDontSee('Promo Kadaluwarsa');
    }

    public function test_promo_detail_page_can_be_rendered(): void
    {
        $response = $this->get('/promo/promo-diskon-glowing');

        $response->assertStatus(200);
        $response->assertSee('Promo Diskon Glowing');
        $response->assertSee('Klaim Promo Ini via WhatsApp');
    }

    public function test_livewire_catalog_search_filters_items(): void
    {
        Livewire::test(CatalogList::class)
            ->assertSee('Facial Treatment Glowing')
            ->set('search', 'NonExistingKeyword')
            ->assertDontSee('Facial Treatment Glowing')
            ->assertSee('Tidak Ada Item Ditemukan');
    }
}
