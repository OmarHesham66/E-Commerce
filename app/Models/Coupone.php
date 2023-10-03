<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupone extends Model
{
    use HasFactory;
    protected $table = 'coupones';
    protected $fillable = [
        'name',
        'detiles',
        'code',
        'discount',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
