<?php

namespace App\Filament\Widgets;

use App\Models\CatalogItem;
use App\Models\Location;
use App\Models\Promo;
use App\Services\OperatingHoursService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $serviceCount = CatalogItem::where('type', 'service')->where('is_active', true)->count();
        $productCount = CatalogItem::where('type', 'product')->where('is_active', true)->count();

        $activePromosCount = Promo::where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now())
            ->count();

        $branchCount = Location::where('is_active', true)->count();
        $isOpen = OperatingHoursService::isOpenNow();

        return [
            Stat::make('Layanan Treatment', $serviceCount . ' Layanan')
                ->description('Treatment aktif & siap dibooking')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),

            Stat::make('Produk Skincare', $productCount . ' Produk')
                ->description('Skincare tersedia di katalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),

            Stat::make('Promo Berjalan', $activePromosCount . ' Promo Aktif')
                ->description('Diskon spesial aktif saat ini')
                ->descriptionIcon('heroicon-m-gift')
                ->color('warning'),

            Stat::make('Status Salon Saat Ini', $isOpen ? '🟢 BUKA SEKARANG' : '⚪ TUTUP')
                ->description($branchCount . ' Cabang aktif di Banda Aceh')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color($isOpen ? 'success' : 'gray'),
        ];
    }
}
