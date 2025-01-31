<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sell_id',
        'product_id',
        'product_variant_id',
        'qty',
        'price',
        'total',
    ];

    public function product()
    {
       // return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class, 'product_id');


    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell_id');
    }
}
