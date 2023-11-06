<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OptionsProduct extends Model
{
    use HasFactory;
    protected $table = 'options_product';
    protected $fillable = [
        'color',
        'hexa',
        'size',
        'quantity',
        'product_id',
    ];
    public $timestamps = false;
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
