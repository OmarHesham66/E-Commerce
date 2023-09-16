<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name	',
        'title',
        'description',
        'photo',
        'rating',
        'price',
        'discount',
        'avaliabile',
        'quantity',
        'category_id',
        'brand_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function Options()
    {
        return $this->hasMany(OptionsProduct::class, 'product_id');
    }
    public function OrderItem()
    {
        return $this->hasOne(OrderItem::class, 'product_id');
    }
    public function CartItem()
    {
        return $this->hasOne(CartItem::class, 'product_id');
    }
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'cart_items', 'users_cart_id', 'product_id', 'id', 'id');
    }
}
