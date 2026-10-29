<?php

namespace App\Services;

use App\Models\Location;
use App\Models\OperatingHour;
use Carbon\Carbon;

class OperatingHoursService
{
    /**
     * Periksa apakah salon sedang buka saat ini berbasis WIB (Asia/Jakarta).
     */
    public static function isOpenNow(?Location $location = null, ?Carbon $customTime = null): bool
    {
        $now = $customTime ?? Carbon::now('Asia/Jakarta');
        $location = $location ?? self::getDefaultLocation();

        if (! $location) {
            return false;
        }

        $dayOfWeek = $now->dayOfWeek; // 0 = Minggu, 1 = Senin, ..., 6 = Sabtu
        $todaySchedule = OperatingHour::where('location_id', $location->id)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (! $todaySchedule || $todaySchedule->is_closed) {
            return false;
        }

        $currentTime = $now->format('H:i:s');
        $opensAt = $todaySchedule->opens_at;
        $closesAt = $todaySchedule->closes_at;

        return $currentTime >= $opensAt && $currentTime <= $closesAt;
    }

    /**
     * Dapatkan jadwal hari ini untuk lokasi utama.
     */
    public static function getTodaySchedule(?Location $location = null, ?Carbon $customTime = null): ?OperatingHour
    {
        $now = $customTime ?? Carbon::now('Asia/Jakarta');
        $location = $location ?? self::getDefaultLocation();

        if (! $location) {
            return null;
        }

        return OperatingHour::where('location_id', $location->id)
            ->where('day_of_week', $now->dayOfWeek)
            ->first();
    }

    /**
     * Dapatkan teks jam buka hari ini.
     */
    public static function getTodayHoursText(?Location $location = null, ?Carbon $customTime = null): string
    {
        $schedule = self::getTodaySchedule($location, $customTime);

        return $schedule ? $schedule->formatted_hours : '09.00 - 18.00 WIB';
    }

    /**
     * Dapatkan ringkasan badge status dan jam buka hari ini.
     */
    public static function getStatusBadge(?Location $location = null, ?Carbon $customTime = null): array
    {
        $now = $customTime ?? Carbon::now('Asia/Jakarta');
        $isOpen = self::isOpenNow($location, $now);
        $schedule = self::getTodaySchedule($location, $now);
        $hoursText = self::getTodayHoursText($location, $now);

        return [
            'is_open' => $isOpen,
            'label' => $isOpen ? 'Buka Sekarang' : 'Tutup',
            'badge_color' => $isOpen ? 'bg-emerald-500' : 'bg-gray-400',
            'hours_text' => $hoursText,
            'day_name' => $schedule?->day_name ?? 'Hari Ini',
        ];
    }

    protected static function getDefaultLocation(): ?Location
    {
        return Location::where('is_main_branch', true)->first()
            ?? Location::where('is_active', true)->first();
    }
}
