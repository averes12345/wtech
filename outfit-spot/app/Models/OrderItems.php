<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    //
    protected $fillable = [
        'orders_id',
        'specific_product_id',
        'quantity',
    ];

    public function specificProduct()
    {
        return $this->belongsTo(ProductColorSize::class, 'specific_product_id');
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, ProductColorSize::class,'id' ,'id', 'specific_product_id', 'products_id');
    }


}
