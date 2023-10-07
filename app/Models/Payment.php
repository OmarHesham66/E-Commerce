<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'payment_method',
        'total_price',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function UserOrder()
    {
        return $this->belongsTo(UserOrder::class, 'order_id');
    }
    public function User()
    {
        return $this->belongsTo(UserOrder::class, 'user_id');
    }
}
