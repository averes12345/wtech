<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductColorSize extends Model
{
    protected $table = 'product_color_size';

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'product_image_id',
        'status',
        'count_in_stock',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_color_size_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
