<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
    public function Admins()
    {
        return $this->morphedByMany(Admin::class, 'authorizable', 'role_users')
            ->using(RoleUser::class)
            ->withPivot(['id']);
    }
    public static function create_role($request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->post('role')]);
            foreach ($request->post('perm') as $key => $value) {
                Permission::create([
                    'role_id' => $role->id,
                    'name' => $key,
                    'type' => $value,
                ]);
            }
            DB::commit();
            return 'done';
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
    public function update_role($request)
    {
        // $this->c
        try {
            DB::beginTransaction();
            $this->update(['name' => $request->post('role')]);
            foreach ($request->post('perm') as $key => $value) {
                Permission::updateOrCreate([
                    'role_id' => $this->id,
                    'name' => $key,
                ], [
                    'type' => $value,
                ]);
            }
            DB::commit();
            return 'done';
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage();
        }
    }
}
