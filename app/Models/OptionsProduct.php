<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function Options()
    {
        return $this->belongsTo(OptionsProduct::class, 'product_id');
    }
}
