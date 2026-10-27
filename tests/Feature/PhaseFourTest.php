<?php

namespace Tests\Feature;

use App\Livewire\BookingForm;
use App\Models\CatalogItem;
use App\Models\Category;
use App\Models\Location;
use App\Services\WhatsAppLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhaseFourTest extends TestCase
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

        $this->service = CatalogItem::create([
            'category_id' => $this->category->id,
            'name' => 'Facial Glow Treatment',
            'slug' => 'facial-glow-treatment',
            'type' => 'service',
            'price_type' => 'fixed',
            'price' => 150000,
            'duration_minutes' => 60,
            'is_active' => true,
        ]);

        $this->product = CatalogItem::create([
            'category_id' => $this->category->id,
            'name' => 'Putri Glow Day Sunscreen SPF 50',
            'slug' => 'putri-glow-day-sunscreen-spf50',
            'type' => 'product',
            'price_type' => 'fixed',
            'price' => 95000,
            'is_active' => true,
        ]);

        $this->location = Location::create([
            'name' => 'Putri Beauty Care Banda Aceh',
            'address' => 'Jl. Sultan Iskandar Muda, Punge Ulee Lheue',
            'city' => 'Banda Aceh',
            'phone' => '081362673728',
            'is_main_branch' => true,
            'is_active' => true,
        ]);
    }

    public function test_booking_page_can_be_rendered(): void
    {
        $response = $this->get('/booking');

        $response->assertStatus(200);
        $response->assertSeeLivewire(BookingForm::class);
    }

    public function test_booking_form_validation(): void
    {
        Livewire::test(BookingForm::class)
            ->set('name', '')
            ->set('selectedServices', [])
            ->call('submit')
            ->assertHasErrors(['name', 'selectedServices']);
    }

    public function test_booking_form_redirects_to_whatsapp_with_formatted_message(): void
    {
        Livewire::test(BookingForm::class)
            ->set('name', 'Rina Marlina')
            ->set('selectedServices', [$this->service->id])
            ->set('date', date('Y-m-d'))
            ->set('time', '14:00')
            ->set('notes', 'Minta terapis senior ya kak')
            ->call('submit')
            ->assertRedirect();
    }

    public function test_locations_page_can_be_rendered(): void
    {
        $response = $this->get('/lokasi');

        $response->assertStatus(200);
        $response->assertSee('Putri Beauty Care Banda Aceh');
        $response->assertSee('Jl. Sultan Iskandar Muda');
        $response->assertSee('Buka Google Maps');
    }

    public function test_consultation_route_redirects_to_whatsapp(): void
    {
        $response = $this->get('/konsultasi');

        $response->assertStatus(302);
        $this->assertStringContainsString('https://wa.me/', $response->headers->get('Location'));
    }

    public function test_instagram_route_redirects_to_profile(): void
    {
        $response = $this->get('/instagram');

        $response->assertStatus(302);
        $this->assertStringContainsString('instagram.com', $response->headers->get('Location'));
    }

    public function test_whatsapp_link_generates_correct_templates_for_product_and_service(): void
    {
        $serviceUrl = WhatsAppLink::buildForItem($this->service);
        $this->assertStringContainsString('https://wa.me/', $serviceUrl);
        $this->assertStringContainsString(rawurlencode('Facial Glow Treatment'), $serviceUrl);

        $productUrl = WhatsAppLink::buildForItem($this->product, ['nama' => 'Siti', 'alamat' => 'Banda Aceh']);
        $this->assertStringContainsString('https://wa.me/', $productUrl);
        $this->assertStringContainsString(rawurlencode('Putri Glow Day Sunscreen'), $productUrl);
    }
}
