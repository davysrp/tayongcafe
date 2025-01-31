<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class CouponCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'coupon_name',
        'coupon_code',

        'status',
        'start_date',
        'expired_date',
        'flat',
        'percentage',
        'discount_cap',
        'max_use',
        'use_per_customer',
        'start_date',
        'expired_date',
        'status',
    ];

}
