<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CatalogItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'type',
        'name',
        'slug',
        'short_description',
        'description',
        'benefits',
        'duration_minutes',
        'price_type',
        'price',
        'price_max',
        'compare_price',
        'badge',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'duration_minutes' => 'integer',
            'price' => 'integer',
            'price_max' => 'integer',
            'compare_price' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CatalogItemImage::class)->orderBy('sort_order');
    }

    public function promos(): BelongsToMany
    {
        return $this->belongsToMany(Promo::class, 'catalog_item_promo');
    }

    public function getFormattedPriceAttribute(): string
    {
        return match ($this->price_type) {
            'contact_us' => 'Hubungi Kami',
            'starting_from' => 'Mulai ' . format_rupiah($this->price),
            default => $this->price_max
                ? format_rupiah($this->price) . ' - ' . format_rupiah($this->price_max)
                : format_rupiah($this->price),
        };
    }

    public function getPrimaryImageAttribute(): ?string
    {
        return $this->images->first()?->image_path;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeServices(Builder $query): Builder
    {
        return $query->where('type', 'service');
    }

    public function scopeProducts(Builder $query): Builder
    {
        return $query->where('type', 'product');
    }
}
