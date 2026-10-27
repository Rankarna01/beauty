<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Putri');
        $response->assertSee('BEAUTY CARE');
        $response->assertSee('Cantik');
        $response->assertSee('Percaya Diri');
        $response->assertSee('081362673728');
        $response->assertSee('Facial Treatment');
        $response->assertSee('fa-brands fa-whatsapp', false);
        $response->assertSee('fa-solid fa-location-dot', false);
        $response->assertSee('footerGoldGrad', false);
        $response->assertSee('Your Beauty,');
        $response->assertSee('Our Care');
        $response->assertSee('Salon');
        $response->assertSee('Skincare');
        $response->assertSee('Aesthetic');
        $response->assertSee('Follow');
        $response->assertSee('for more');
    }
}
