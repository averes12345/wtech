<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function productImage(): BelongsTo
    {
        return $this->belongsTo(ProductImage::class);
    }
}
