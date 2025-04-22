<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductColorSize;

class ProductColorSize extends Model
{
    public function color(){
        return $this->belongsTo(Color::class, 'colors_id');
    }
    public function size(){
        return $this->belongsTo(Size::class, 'sizes_id');
    }
    public function images(){
        return $this->hasMany(ProductImage::class, 'product_color_sizes_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'products_id');
    }


    public function getIdFromForeignKeys(int $productId, int $colorId, int $sizeId){
        return ProductColorSize::where('products_id', $productId)->where('colors_id', $colorId)->where('sizes_id', $sizeId)->value('id');
    }

}

