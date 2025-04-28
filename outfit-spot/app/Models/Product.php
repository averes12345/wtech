<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductColorSize;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    public function colorSizeVariants(){

        return $this->hasMany(ProductColorSize::class, 'products_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


}
