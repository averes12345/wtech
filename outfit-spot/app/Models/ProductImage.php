<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_color_sizes_id',
        'image_path',
        'alt',
        'is_main',
    ];

    public $timestamps = false;

    public function productColorSize(): BelongsTo
    {
        return $this->belongsTo(ProductColorSize::class, 'product_color_sizes_id');
    }
}
