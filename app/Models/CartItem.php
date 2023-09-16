<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = [
        'product_id',
        'options_id',
        'quantity',
        'users_cart_id',
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
    public function UserCarts()
    {
        return $this->belongsTo(UserCart::class, 'users_cart_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function Options()
    {
        return $this->belongsTo(OptionsProduct::class, 'options_id');
    }
}
