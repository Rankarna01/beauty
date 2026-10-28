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
            'starting_from' => $this->price_max
                ? format_rupiah($this->price) . ' - ' . format_rupiah($this->price_max)
                : 'Mulai ' . format_rupiah($this->price),
            default => $this->price_max
                ? format_rupiah($this->price) . ' - ' . format_rupiah($this->price_max)
                : format_rupiah($this->price),
        };
    }

    public function getPrimaryImageAttribute(): ?string
    {
        return $this->images->first()?->image_path;
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $path = $this->images->first()?->image_path;
        if (! $path) {
            $catSlug = $this->category?->slug ?? '';
            $itemSlug = $this->slug ?? '';

            if ($catSlug === 'nail-art' || str_contains($itemSlug, 'nail-art') || str_contains($itemSlug, 'gel-polos') || str_contains($itemSlug, 'french-nail')) {
                return asset('images/nail_art_default.jpg');
            }

            if ($catSlug === 'nail-treatment' || str_contains($itemSlug, 'menicure') || str_contains($itemSlug, 'pedicure') || str_contains($itemSlug, 'callus') || str_contains($itemSlug, 'footspa') || str_contains($itemSlug, 'menipedi') || str_contains($itemSlug, 'refleksi')) {
                return asset('images/nail_treatment_default.jpg');
            }

            if ($catSlug === 'eye-treatment' || str_contains($itemSlug, 'lash')) {
                return asset('images/eye_treatment_default.jpg');
            }

            if ($catSlug === 'hair-nail-spa' || str_contains($itemSlug, 'crembath') || str_contains($itemSlug, 'creambath') || str_contains($itemSlug, 'hair') || str_contains($itemSlug, 'head-japanese-spa')) {
                return asset('images/hair_spa_default.jpg');
            }

            return 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=400&q=80';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
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
