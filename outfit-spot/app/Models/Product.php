<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductColorSize;
use App\Models\ProductImage;

class Product extends Model
{

    public function colorSizeVariants(){

        return $this->hasMany(ProductColorSize::class, 'products_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
