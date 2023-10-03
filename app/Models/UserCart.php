<?php

namespace App\Models;

use App\Traits\Get_Cookies;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory, Get_Cookies;
    protected $table = 'users_cart';
    protected $fillable = [
        'user_id',
        'cookie_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function booted()
    {
        static::addGlobalScope(function (Builder $builder) {
            $builder->where('cookie_id', Get_Cookies::get_cookie());
        });
    }
    public function CartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')
            ->using(CartItem::class)
            ->withPivot([
                'id',
                'option_id',
                'quantity',
            ]);
    }
}
