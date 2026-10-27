<?php

namespace App\Filament\Widgets;

use App\Models\CatalogItem;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCatalogWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Katalog Treatment & Produk Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CatalogItem::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan / Produk')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'service' => 'success',
                        'product' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'service' => 'Layanan',
                        'product' => 'Produk',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('formatted_price')
                    ->label('Harga'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false)
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Ubah')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (CatalogItem $record): string => route('filament.admin.resources.catalog-items.edit', $record)),
            ]);
    }
}
