<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Size;

class ProductColorSize extends Model
{
    public $timestamps = false;

    public function color(){
        return $this->belongsTo(Color::class, 'colors_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function size(){
        return $this->belongsTo(Size::class, 'sizes_id');
    }
    public function images(){
        return $this->hasMany(ProductImage::class, 'product_color_sizes_id');
    }

}

