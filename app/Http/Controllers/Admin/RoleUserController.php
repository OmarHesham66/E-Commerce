<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RoleUserController extends Controller
{
    public function select($id)
    {
        $roles = Role::get();
        return view('Admin.Managers.Crud-Manager.createRole', compact('roles', 'id'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required'
        ]);
        $admin = Admin::find(Crypt::decrypt($request->post('id')));
        // dd($request->post('id'));
        RoleUser::create([
            'role_id' => $request->post('role'),
            'authorizable_type' => 'App\Models\Admin',
            'authorizable_id' => $admin->id,
        ]);
        return redirect()->route('admin.index');
    }
    public function unset(Request $request)
    {
        RoleUser::where('id', $request->post('id'))->delete();
        return redirect()->route('admin.index');
    }
}
