<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'address_name',
        'city',
        'state',
        'zip_code',
        'phone_number',
        'email',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Order()
    {
        return $this->belongsTo(UserOrder::class, 'order_id', 'id');
    }
}
