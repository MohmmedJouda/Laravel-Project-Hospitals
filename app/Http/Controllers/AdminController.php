<?php

namespace App\Http\Controllers;

use App\Mail\WellcomeMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::where('id', '!=', auth()->id())->get();
        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|string|exists:roles,id',
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|email|unique:admins,email',
            'password' => 'required|string|min:6|max:15'
        ]);
        $role = Role::where('id', $request->get('role_id'))->first();
        $admin = new Admin();
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));
        $admin->save();
        //بقوم بارسال الايميل من خلال هذه الدالة او من خلال الموديل
        //Mail::to($admin->email)->send(new WellcomeMail());
        $saved = $admin->save();
        $admin->assignRole($role);
        if ($saved) {
            session()->flash('msg', 'Admin Created Successfully');
            return redirect()->route('admins.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            // 'role_id' => 'required|string|exists:roles,id',
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|email',
            // 'password' => 'required|string|min:6|max:15'
        ]);
        // $role = Role::all();
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));
        $admin->save();
        $saved = $admin->save();
        // $admin->assignRole($role);
        if ($saved) {
            session()->flash('msg', 'Admin Updated Successfully');
            return redirect()->route('admins.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $is_delete = $admin->delete();
        if ($is_delete) {
            session()->flash('del', 'hospital Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
