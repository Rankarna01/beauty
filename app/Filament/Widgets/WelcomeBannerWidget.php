<?php

namespace App\Filament\Widgets;

use App\Services\OperatingHoursService;
use Filament\Widgets\Widget;

class WelcomeBannerWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome-banner';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function getOperatingStatus(): array
    {
        $badge = OperatingHoursService::getStatusBadge();

        return [
            'isOpen' => $badge['is_open'],
            'todayText' => $badge['hours_text'],
        ];
    }
}
