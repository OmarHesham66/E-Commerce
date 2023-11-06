<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::updating(function (User $user) {
            if (request()->has('photo') && request()->photo != null) {
                $new_photo = request()->file('photo');
                $path_new_photo = self::save_photo('users_photos', $new_photo);
                if ($user->photo != 'users_photos/Profile.png') {
                    Storage::disk('Images')->delete($user->original['photo']);
                }
                $user->photo = $path_new_photo;
            }
            if (request()->has('password') && request()->password != null) {
                $user->password = bcrypt(request()->post('password'));
            }
        });
    }
    public function Payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
    public function UserCart()
    {
        return $this->hasOne(UserCart::class, 'user_id');
    }
    public function UserOrder()
    {
        return $this->hasMany(UserOrder::class, 'user_id');
    }
    public static function save_photo($path, $photo)
    {
        $ex = $photo->getClientOriginalExtension();
        $fileName = time() . '.' . $ex;
        $photo->storeAs($path, $fileName, 'Images');
        return "$path/$fileName";
    }
}
