<?php

namespace App\Models;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sell extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $fillable = ['invoice_no', 'customer_id', 'total', 'grand_total', 'status', 'payment_method_id'];

    protected $fillable =
        [
            'id',
            'dates',
            'times',
            'seller_id_buyer',
            'seller_id_seller',
            'total',
            'promo_code',
            'discount',
            'grand_total',
            'payment_method_id',
            'status',
            'coupon_code_id',
            'invoice_no',
            'customer_id',
            'table_id'
        ];

    // public function sellDetail()
    // {
    //     return $this->hasMany(SellDetail::class);
    // }

    // Relationship with SellDetail
    public function sellDetail()
    {
        return $this->hasMany(SellDetail::class, 'sell_id');
    }

    // Relationship with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    
    // public function buyer()
    // {
    //     return $this->belongsTo(Seller::class, 'seller_id_buyer', 'id');
    // }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
        });

    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public static function invoiceNo()
    {
        $part1 = strtoupper(bin2hex(random_bytes(2))); // 6 characters (e.g., 1AD0D5)
        $part2 = strtoupper(bin2hex(random_bytes(2))); // 6 characters (e.g., 1268C0)

        return "{$part1}-{$part2}";
    }

    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }
    
}

