<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    public function items(){
        return $this->hasMany(OrderItems::class, 'orders_id', 'id');
    }

    protected $fillable = [
        'user_id',
    ];
}
