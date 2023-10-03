<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $table = 'users_order';
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status_order',
        'status_payment',
        'payment_method',
        'coupone_id',
        'shiping_price',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected static function booted()
    {
        static::creating(function (UserOrder $userOrder) {
            $year = now()->year;
            $order = UserOrder::latest()->first();
            if ($order) {
                $userOrder->order_number = $order->order_number + 1;
            } else {
                $userOrder->order_number = (int)((string)$year . '0001');
            }
        });
    }
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name',
                'option_id',
                'option',
                'quantity',
                'price',
            ]);
    }
    public function Payment()
    {
        return $this->hasOne(Payment::class, 'users_order_id');
    }
    public function Addresses()
    {
        return $this->hasMany(Address::class, 'order_id', 'id');
    }
    public function billing()
    {
        return $this->hasOne(Address::class, 'order_id', 'id')->where('type', 'billing');
    }
    public function shiping()
    {
        return $this->hasOne(Address::class, 'order_id', 'id')->where('type', 'shiping');
    }
}
