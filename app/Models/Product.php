<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    //use SoftDeletes;
   // protected $fillable2 =c ['product_name', 'photo', 'price', 'product_description'];
    protected $fillable =
    [
        'names',
        'category_id',
        'price',
        'product_number',
        'detail',
        'photo',
        'day_warranty',
        'status',
        'seller_id',
        'sku',
    ];




    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->sku = $model->generateRandomString(20);
            $model->status = 1;
            $model->save();
        });

    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);

        return $randomString;
    }


}
