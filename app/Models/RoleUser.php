<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    use HasFactory;
    protected $table = 'role_users';
    protected $fillable = [
        'role_id',
        'authorizable_type',
        'authorizable_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function authorizable()
    {
        return $this->morphTo();
    }
}
