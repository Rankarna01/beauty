<?php

namespace App\Filament\Resources\MenuLinkResource\Pages;

use App\Filament\Resources\MenuLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuLink extends EditRecord
{
    protected static string $resource = MenuLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
