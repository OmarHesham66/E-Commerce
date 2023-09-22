<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'users_order_id',
        'product_id',
        'option_id',
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
