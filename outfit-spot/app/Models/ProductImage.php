<?php

namespace App\Models;

use Database\Factories\ProductImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'image_path',
        'alt',
    ];

    public function variants()
    {
        return $this->hasMany(ProductColorSize::class, 'product_image_id');
    }
}
