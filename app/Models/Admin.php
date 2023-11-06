<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'photo',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_users')->withPivot(['id']);
    }
    public function HasPermission($permission)
    {
        return $this->role()->whereHas('permissions', function ($q) use ($permission) {
            $q->where('name', $permission)->where('type', 'allow');
        })->exists();
    }
    public function HasRole($role)
    {
        return $this->role()->where('roles.id', $role->id)->exists();
    }
    public function receivesBroadcastNotificationsOn()
    {
        return 'Admin.' . $this->id;
    }
}
