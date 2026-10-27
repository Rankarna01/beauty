<?php

namespace Tests\Unit;

use App\Models\Location;
use App\Models\OperatingHour;
use App\Services\OperatingHoursService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperatingHoursServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_correctly_detects_when_salon_is_open(): void
    {
        $location = Location::create([
            'name' => 'Putri Beauty Care',
            'address' => 'Banda Aceh',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        // Jadwal Senin: 09:00:00 - 21:00:00
        OperatingHour::create([
            'location_id' => $location->id,
            'day_of_week' => 1, // Senin
            'opens_at' => '09:00:00',
            'closes_at' => '21:00:00',
            'is_closed' => false,
        ]);

        // Simulasi waktu Senin jam 14:00 (buka)
        $mondayOpen = Carbon::parse('2026-10-26 14:00:00', 'Asia/Jakarta'); // 2026-10-26 is Monday
        $this->assertTrue(OperatingHoursService::isOpenNow($location, $mondayOpen));

        // Simulasi waktu Senin jam 22:00 (tutup)
        $mondayClosed = Carbon::parse('2026-10-26 22:00:00', 'Asia/Jakarta');
        $this->assertFalse(OperatingHoursService::isOpenNow($location, $mondayClosed));

        // Simulasi waktu Senin jam 07:00 (belum buka)
        $mondayEarly = Carbon::parse('2026-10-26 07:00:00', 'Asia/Jakarta');
        $this->assertFalse(OperatingHoursService::isOpenNow($location, $mondayEarly));
    }

    public function test_it_returns_closed_if_day_is_marked_as_closed(): void
    {
        $location = Location::create([
            'name' => 'Putri Beauty Care',
            'address' => 'Banda Aceh',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        // Jadwal Minggu: Libur
        OperatingHour::create([
            'location_id' => $location->id,
            'day_of_week' => 0, // Minggu
            'opens_at' => '09:00:00',
            'closes_at' => '21:00:00',
            'is_closed' => true,
        ]);

        $sunday = Carbon::parse('2026-10-25 12:00:00', 'Asia/Jakarta'); // 2026-10-25 is Sunday
        $this->assertFalse(OperatingHoursService::isOpenNow($location, $sunday));
    }

    public function test_it_returns_formatted_today_hours_text(): void
    {
        $location = Location::create([
            'name' => 'Putri Beauty Care',
            'address' => 'Banda Aceh',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        OperatingHour::create([
            'location_id' => $location->id,
            'day_of_week' => 1, // Senin
            'opens_at' => '09:00:00',
            'closes_at' => '21:00:00',
            'is_closed' => false,
        ]);

        $monday = Carbon::parse('2026-10-26 10:00:00', 'Asia/Jakarta');
        $this->assertSame('09:00 - 21:00 WIB', OperatingHoursService::getTodayHoursText($location, $monday));
        $this->assertSame('09:00 - 21:00 WIB', (new OperatingHoursService())->getTodayHoursText($location, $monday));
    }

    public function test_it_returns_status_badge(): void
    {
        $location = Location::create([
            'name' => 'Putri Beauty Care',
            'address' => 'Banda Aceh',
            'is_main_branch' => true,
            'is_active' => true,
        ]);

        OperatingHour::create([
            'location_id' => $location->id,
            'day_of_week' => 1, // Senin
            'opens_at' => '09:00:00',
            'closes_at' => '21:00:00',
            'is_closed' => false,
        ]);

        $mondayOpen = Carbon::parse('2026-10-26 14:00:00', 'Asia/Jakarta');
        $badge = OperatingHoursService::getStatusBadge($location, $mondayOpen);

        $this->assertTrue($badge['is_open']);
        $this->assertSame('Buka Sekarang', $badge['label']);
        $this->assertSame('09:00 - 21:00 WIB', $badge['hours_text']);
        $this->assertSame('Senin', $badge['day_name']);
    }
}
