<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'invoice_id',
        'order_number'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function User()
    {
        return $this->belongsTo(UserOrder::class, 'user_id');
    }
}
