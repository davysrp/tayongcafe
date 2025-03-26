<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer  extends Authenticatable
{
    use HasFactory, SoftDeletes;
    use HasApiTokens;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number','password','is_general'
    ];
}
