<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'title',
        'slug',
        'describtion',
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

    protected static function booted()
    {
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }
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
        return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id', 'id', 'id');
    }
    public function scopeFilter(Builder $builder, $data)
    {
        $arr = array_merge([
            'category_id' => null,
            'discount' => null,
            'fashion' => [],
            'search' => null
        ], $data);
        $builder->when($arr['category_id'], function ($builder, $value) {
            return $builder->where('category_id', $value);
        });
        $builder->when($arr['discount'], function ($builder, $value) {
            return $builder->where('discount', $value);
        });
        $builder->when($arr['fashion'], function ($builder, $value) {
            return $builder->select('products.*', 'super-categories.name as super-category-name')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('super-categories', 'super-categories.id', '=', 'categories.super_categories_id')
                ->whereIn(
                    'super-categories.name',
                    $value
                );
        });
        $builder->when($arr['search'], function ($builder, $value) {
            return $builder->select('products.*', 'categories.name')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->where('categories.name', 'LIKE', '%' . $value . '%');
            // ->orwhere(DB::raw('products.id any (select id from prodoucts)'));
        });
    }
}
