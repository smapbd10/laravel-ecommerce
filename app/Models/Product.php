<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'description',
        'short_description',
        'category_id',
        'brand_id',
        'price',
        'sale_price',
        'cost_price',
        'compare_price',
        'stock',
        'low_stock_threshold',
        'weight',
        'dimensions',
        'type',
        'featured',
        'is_new',
        'is_bestseller',
        'is_digital',
        'is_downloadable',
        'warranty',
        'return_policy',
        'tax_rate',
        'shipping_class',
        'status',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_new' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_digital' => 'boolean',
        'is_downloadable' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
