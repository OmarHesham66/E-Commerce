<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    use HasFactory;

    // protected $with = ['Options'];
    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_id',
        'option_id',
        'quantity',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function booted()
    {
        static::creating(function (CartItem $cart) {
            $cart->id = Str::uuid();
        });
    }
    public function UserCart()
    {
        return $this->belongsTo(UserCart::class, 'cart_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function Option()
    {
        return $this->belongsTo(OptionsProduct::class, 'option_id');
    }
}
