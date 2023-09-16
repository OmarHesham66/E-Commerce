<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'description',
        'count_product',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
