<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authentificable;

class Admin extends Model
{
    protected $guard = 'admin';
}
