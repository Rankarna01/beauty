<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\OperatingHour;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $location = Location::updateOrCreate(
            ['name' => 'Putri Beauty Care & Head Japanese Spa'],
            [
                'address' => 'Jl. Sultan Iskandar Muda, Punge Ulee Lheue, Kec. Meuraxa',
                'city' => 'Banda Aceh',
                'maps_url' => 'https://maps.google.com/?q=Putri+Beauty+Care+Banda+Aceh',
                'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.0425719934274!2d95.305!3d5.555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMzMnMTguMCJOIDk1wrAxOCc0NS4wIkU!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid',
                'latitude' => 5.555000,
                'longitude' => 95.305000,
                'phone' => '081362673728',
                'is_main_branch' => true,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        // Jam Operasional: Senin - Minggu 09:00 - 21:00 WIB
        // day_of_week: 0 = Minggu, 1 = Senin, ..., 6 = Sabtu
        for ($day = 0; $day <= 6; $day++) {
            OperatingHour::updateOrCreate(
                [
                    'location_id' => $location->id,
                    'day_of_week' => $day,
                ],
                [
                    'opens_at' => '09:00:00',
                    'closes_at' => '21:00:00',
                    'is_closed' => false,
                ]
            );
        }
    }
}
