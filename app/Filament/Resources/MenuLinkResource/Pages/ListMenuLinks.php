<?php

namespace App\Filament\Resources\MenuLinkResource\Pages;

use App\Filament\Resources\MenuLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuLinks extends ListRecords
{
    protected static string $resource = MenuLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
