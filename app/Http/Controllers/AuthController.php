<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Validator;




class AuthController extends Controller
{

    public function dashboard()
    {
        return view('admin.home');
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'in:on',
        ]);
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if (Auth::attempt($credentials, $request->get('remember'))) {
            session()->flash('message', 'logined Successfully');
            return redirect('admin/home');
        } else {
            return view('admin.auth.login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return view('admin.auth.login');
    }

    public function changePassword()
    {
        return view('admin.auth.change_password');
    }




    public function postPassword(Request $request)
    {
        //كلمة المرور 123456
        // هاد الشرط لفحص كلمة المرور القديمة من gaurd
        if (!Hash::check($request['password'], Auth::user()->password)) {
            return response()->json(['error' => ['The old password does not match our records.']]);
        }
        $request->validate([
            'password' => 'required',
            'new-password' => 'required|string|confirmed',
        ]);
        $user = auth()->user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
        return view(('admin.home'));
    }
}
