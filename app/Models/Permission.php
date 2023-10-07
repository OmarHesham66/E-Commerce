<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permission';
    protected $fillable = [
        'role_id',
        'name',
        'type',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
