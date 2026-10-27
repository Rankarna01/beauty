<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogItemResource\Pages;
use App\Models\CatalogItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CatalogItemResource extends Resource
{
    protected static ?string $model = CatalogItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Katalog & Layanan';

    protected static ?string $modelLabel = 'Treatment / Produk';

    protected static ?string $pluralModelLabel = 'Treatment & Produk';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Utama')
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->label('Kategori'),

                                Forms\Components\Select::make('type')
                                    ->options([
                                        'service' => 'Layanan (Treatment / Perawatan)',
                                        'product' => 'Produk (Skincare / Kosmetik)',
                                    ])
                                    ->default('service')
                                    ->required()
                                    ->label('Tipe Item'),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Item')
                                    ->required()
                                    ->maxLength(150)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->maxLength(160)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Deskripsi Singkat (Ringkasan)')
                                    ->rows(2)
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Harga & Durasi')
                            ->schema([
                                Forms\Components\Select::make('price_type')
                                    ->options([
                                        'fixed' => 'Harga Tetap (Fixed)',
                                        'starting_from' => 'Mulai Dari (Starting From)',
                                        'range' => 'Rentang Harga (Range)',
                                        'free' => 'Konsultasi / Gratis',
                                    ])
                                    ->default('fixed')
                                    ->required()
                                    ->label('Jenis Penentuan Harga'),

                                Forms\Components\TextInput::make('price')
                                    ->label('Harga Utama')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),

                                Forms\Components\TextInput::make('price_max')
                                    ->label('Harga Maksimal (khusus jenis Range)')
                                    ->numeric()
                                    ->prefix('Rp'),

                                Forms\Components\TextInput::make('compare_price')
                                    ->label('Harga Coret / Asli (Sebelum Diskon)')
                                    ->numeric()
                                    ->prefix('Rp'),

                                Forms\Components\TextInput::make('duration_minutes')
                                    ->label('Durasi Pengerjaan')
                                    ->numeric()
                                    ->suffix('menit')
                                    ->placeholder('contoh: 60'),

                                Forms\Components\TextInput::make('badge')
                                    ->label('Label Khusus / Badge')
                                    ->placeholder('Best Seller / Populer / New')
                                    ->maxLength(50),
                            ])->columns(2),

                        Forms\Components\Section::make('Keunggulan & Manfaat')
                            ->schema([
                                Forms\Components\TagsInput::make('benefits')
                                    ->label('Daftar Manfaat / Benefit (Tekan Enter tiap butir)')
                                    ->placeholder('Tambah keunggulan...')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Foto & Galeri')
                            ->schema([
                                Forms\Components\Repeater::make('images')
                                    ->relationship('images')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image_path')
                                            ->label('Foto')
                                            ->image()
                                            ->directory('catalog')
                                            ->required(),
                                        Forms\Components\Toggle::make('is_primary')
                                            ->label('Jadikan Foto Sampul Utama')
                                            ->default(false),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->defaultItems(1)
                                    ->label('Galeri Foto'),
                            ]),

                        Forms\Components\Section::make('Status & Pengurutan')
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Tampilkan sebagai Unggulan')
                                    ->helperText('Akan muncul di highlight beranda')
                                    ->default(false),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->helperText('Tampil untuk pengunjung')
                                    ->default(true),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan Tampilan')
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
                Tables\Columns\ImageColumn::make('images.image_path')
                    ->label('Foto')
                    ->circular()
                    ->stacked()
                    ->limit(2),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan / Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (CatalogItem $record) => Str::limit($record->short_description, 40)),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'service' => 'success',
                        'product' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'service' => 'Jasa / Treatment',
                        'product' => 'Produk Skincare',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration_minutes')
                    ->label('Durasi')
                    ->formatStateUsing(fn ($state) => $state ? "{$state} mnt" : '-')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),

                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'service' => 'Jasa / Treatment',
                        'product' => 'Produk Skincare',
                    ])
                    ->label('Filter Tipe Item'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Unggulan'),
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
            'index' => Pages\ListCatalogItems::route('/'),
            'create' => Pages\CreateCatalogItem::route('/create'),
            'edit' => Pages\EditCatalogItem::route('/{record}/edit'),
        ];
    }
}
