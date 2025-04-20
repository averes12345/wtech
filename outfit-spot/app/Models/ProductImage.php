<?php

namespace App\Models;

use Database\Factories\ProductImageFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'image_path',
        'alt',
    ];

    public function productColorSize(): BelongsTo
    {
        return $this->belongsTo(ProductColorSize::class, 'product_color_size_id');
    }
}
