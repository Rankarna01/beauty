<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Tampilan & Outlet';

    protected static ?string $modelLabel = 'Lokasi Cabang';

    protected static ?string $pluralModelLabel = 'Lokasi Cabang';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Cabang Salon')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Cabang / Outlet')
                                    ->required()
                                    ->maxLength(100)
                                    ->placeholder('contoh: Putri Beauty Care - Pusat'),

                                Forms\Components\TextInput::make('city')
                                    ->label('Kota')
                                    ->default('Banda Aceh')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\Textarea::make('address')
                                    ->label('Alamat Lengkap')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Nama jalan, nomor ruko/gedung, kelurahan, kecamatan'),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Nomor Telepon / WhatsApp Cabang')
                                    ->tel()
                                    ->placeholder('081362673728')
                                    ->maxLength(30),

                                Forms\Components\FileUpload::make('photo_path')
                                    ->label('Foto Tampak Depan Cabang')
                                    ->image()
                                    ->directory('locations')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Peta & Navigasi')
                            ->schema([
                                Forms\Components\TextInput::make('maps_url')
                                    ->label('Tautan Google Maps Langsung')
                                    ->url()
                                    ->placeholder('https://maps.app.goo.gl/...'),

                                Forms\Components\Textarea::make('maps_embed_url')
                                    ->label('URL Google Maps Embed (iframe src)')
                                    ->rows(3)
                                    ->placeholder('https://www.google.com/maps/embed?... atau kode <iframe src="..."></iframe>')
                                    ->helperText('Bisa masukkan kode <iframe> lengkap dari Google Maps ataupun link embed-nya langsung, sistem otomatis mengekstrak tautan peta.')
                                    ->dehydrateStateUsing(fn (?string $state) => Location::extractEmbedUrl($state)),

                                Forms\Components\Toggle::make('is_main_branch')
                                    ->label('Jadikan Cabang Utama (Pusat)')
                                    ->default(false),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Status Aktif')
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
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->rounded()
                    ->size(50),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Cabang')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Kontak')
                    ->copyable()
                    ->icon('heroicon-m-phone'),

                Tables\Columns\IconColumn::make('is_main_branch')
                    ->label('Pusat')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),

                Tables\Filters\TernaryFilter::make('is_main_branch')
                    ->label('Cabang Pusat'),
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
