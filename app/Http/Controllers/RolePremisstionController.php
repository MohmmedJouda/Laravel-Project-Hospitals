<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePremisstionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'role_id' => 'required|string|exists:roles,id',
            'permission_id' => 'required|string|exists:permissions,id'
        ]);
        if (!$validator->fails()) {
            $role = Role::where('id', $request->get('role_id'))->first();
            $permission = Permission::where('id', $request->get('permission_id'))->first();
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
            $is_saved = $role->save();
            if ($is_saved) {
                return response()->json([
                    'message' => "permission added Successfully"
                ], 201);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], 400);
        }
    }

    /**
     * Display the specified resource.s
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->first();
        $rolePermissions = $role->permissions;
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $permission->setAttribute('assign', false);
            foreach ($rolePermissions as $rolePermission) {
                if ($permission->id == $rolePermission->id) {
                    $permission->setAttribute('assign', true);
                    break;
                }
            }
        }
        return view('admin.roles.role-permission', compact('permissions', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
