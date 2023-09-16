<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $table = 'users_order';
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'users_order_id');
    }
    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_items');
    }
    public function Payment()
    {
        return $this->hasOne(Payment::class, 'users_order_id');
    }
}
