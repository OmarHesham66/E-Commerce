<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',
        'photo',
        // 'count_brand',
        'main_category_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function SuperCategory()
    {
        return $this->belongsTo(SuperCategory::class, 'main_category_id');
    }
    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
