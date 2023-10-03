<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'option_id',
        'option',
        'quantity',
        'price',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function UserOrders()
    {
        return $this->belongsTo(UserOrder::class, 'users_order_id');
    }
}
