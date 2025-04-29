<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'country_id',
    'street_address',
    'city',
    'region',
    'zip_code',
    ];

    protected  $table = 'shipping_details';
    //
}
