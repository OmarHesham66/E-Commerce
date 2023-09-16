<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperCategory extends Model
{
    use HasFactory;
    protected $table = 'super-categories';
    protected $fillable = [
        'name',
        'description',
        // 'count_category',
        // 'count_brand',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Categories()
    {
        return $this->hasMany(Category::class, 'super_categories_id');
    }

    public function Products()
    {
        return $this->hasManyThrough(Product::class, Category::class, 'super_categories_id', 'category_id');
    }
}
