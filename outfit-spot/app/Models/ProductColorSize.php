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
        return $this->hasMany(ProductImage::class, 'product_color_size_id');
    }

}

