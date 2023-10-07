<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\Crypt;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }
    public function index()
    {
        $roles = Role::paginate();
        return view('Admin.Permission.permission', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Permission.Crud-Permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'perm' => 'required|array',
        ]);
        $result = Role::create_role($request);
        if ($result != 'done') {
            return $result;
        }
        notify()->success('Created Role With Permission Success !!', 'Creatation');
        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail(Crypt::decrypt($id))->first();
        $permissions = $role->Permissions()->pluck('type', 'name')->toArray();
        // dd($permissions);
        return view('Admin.Permission.Crud-Permission.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required',
            'perm' => 'required|array',
        ]);
        $role = Role::findOrFail(Crypt::decrypt($id))->first();
        $result = $role->update_role($request);
        if ($result != 'done') {
            return $result;
        }
        notify()->success('Updated Role With Permission Success !!', 'Updating');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail(Crypt::decrypt($id))->first();
        $role->delete();
        notify()->success('Deleted Role With Permission Success !!', 'Deleting');
        return redirect()->route('permission.index');
    }
}
