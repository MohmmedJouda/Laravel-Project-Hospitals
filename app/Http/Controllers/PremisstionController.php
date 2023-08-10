<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PremisstionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::all();
        return view('admin.permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
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
        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->guard_name = $request->get('guard_name');
        $saved = $permission->save();
        if ($saved) {
            session()->flash('msg', 'Permission Created Successfully');
            return redirect()->route('permissions.index');
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
    public function destroy(Permission $permission)
    {
        $is_delete = $permission->delete();
        if ($is_delete) {
            session()->flash('del', 'Permission Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
