<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoResource\Pages;
use App\Models\Promo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PromoResource extends Resource
{
    protected static ?string $model = Promo::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Katalog & Layanan';

    protected static ?string $modelLabel = 'Promo';

    protected static ?string $pluralModelLabel = 'Promo & Diskon';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Promo')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Promo')
                                    ->required()
                                    ->maxLength(150)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->maxLength(160)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('summary')
                                    ->label('Ringkasan Promo (Singkat)')
                                    ->rows(2)
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Detail Promo & Syarat Ketentuan')
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('catalogItems')
                                    ->relationship('catalogItems', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->label('Layanan / Produk yang Termasuk Promo')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Banner & Periode')
                            ->schema([
                                Forms\Components\FileUpload::make('banner_path')
                                    ->label('Banner Gambar Promo')
                                    ->image()
                                    ->directory('promos')
                                    ->columnSpanFull(),

                                Forms\Components\DateTimePicker::make('starts_at')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->default(now()),

                                Forms\Components\DateTimePicker::make('ends_at')
                                    ->label('Tanggal Berakhir')
                                    ->required()
                                    ->default(now()->addDays(14)),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->helperText('Promo dapat dilihat oleh pengunjung')
                                    ->default(true),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner_path')
                    ->label('Banner')
                    ->rounded()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Promo')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Mulai')
                    ->dateTime('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->label('Berakhir')
                    ->dateTime('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->state(function (Promo $record): string {
                        if (! $record->is_active) {
                            return 'Nonaktif';
                        }
                        if ($record->ends_at->isPast()) {
                            return 'Kadaluarsa';
                        }
                        if ($record->starts_at->isFuture()) {
                            return 'Akan Datang';
                        }

                        return 'Sedang Berjalan';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Sedang Berjalan' => 'success',
                        'Akan Datang' => 'info',
                        'Kadaluarsa' => 'gray',
                        default => 'danger',
                    }),

                Tables\Columns\TextColumn::make('catalog_items_count')
                    ->label('Total Item')
                    ->counts('catalogItems')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromos::route('/'),
            'create' => Pages\CreatePromo::route('/create'),
            'edit' => Pages\EditPromo::route('/{record}/edit'),
        ];
    }
}
