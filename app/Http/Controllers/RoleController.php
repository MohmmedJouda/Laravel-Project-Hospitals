<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::withCount('permissions')->get();
        return view('admin.roles.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:0|max:20',
            'guard_name' => 'required|string|in:admin,web'
        ]);
        $role = new Role();
        $role->name = $request->get('name');
        $role->guard_name = $request->get('guard_name');
        $saved = $role->save();
        if ($saved) {
            session()->flash('msg', 'Roule Created Successfully');
            return redirect()->route('roles.index');
        }
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
    public function destroy(Role $role)
    {
        $is_delete = $role->delete();
        if ($is_delete) {
            session()->flash('del', 'Role Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
