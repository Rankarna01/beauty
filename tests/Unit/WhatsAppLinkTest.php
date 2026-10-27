<?php

namespace Tests\Unit;

use App\Services\WhatsAppLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhatsAppLinkTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_normalizes_indonesian_phone_numbers_correctly(): void
    {
        $this->assertEquals('6281362673728', WhatsAppLink::cleanPhoneNumber('081362673728'));
        $this->assertEquals('6281362673728', WhatsAppLink::cleanPhoneNumber('+62 813-6267-3728'));
        $this->assertEquals('6281362673728', WhatsAppLink::cleanPhoneNumber('0813-6267-3728'));
        $this->assertEquals('6281362673728', WhatsAppLink::cleanPhoneNumber('81362673728'));
    }

    public function test_it_interpolates_template_placeholders_accurately(): void
    {
        $template = "Halo {nama}, layanan {layanan} pada tanggal {tanggal}.";
        $result = WhatsAppLink::interpolate($template, [
            'nama' => 'Rina',
            'layanan' => 'Facial Treatment',
            'tanggal' => '28 Oktober 2026',
        ]);

        $this->assertEquals('Halo Rina, layanan Facial Treatment pada tanggal 28 Oktober 2026.', $result);
    }

    public function test_it_builds_a_valid_whatsapp_url(): void
    {
        $url = WhatsAppLink::build('consultation', [], '081362673728');

        $this->assertStringStartsWith('https://wa.me/6281362673728?text=', $url);
        $this->assertStringContainsString('konsultasi', rawurldecode($url));
    }
}
