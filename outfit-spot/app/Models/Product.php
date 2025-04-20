<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductColorSize;

class Product extends Model
{

    public function colorSizeVariants(){

        return $this->hasMany(ProductColorSize::class, 'product_id');
    }
    //
}
