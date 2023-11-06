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
        'invoice_id',
        'payment_method',
        'currency',
        'total_price',
        'transction_id',
        'transction_data',
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
