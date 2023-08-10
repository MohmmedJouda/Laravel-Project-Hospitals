<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hospitals_number = Hospital::count();
        $majors_number = Major::count();
        $doctors_number = Doctor::count();
        $admins_number = Doctor::count();
        return view('admin.home', compact('hospitals_number', 'majors_number', 'doctors_number', 'admins_number'));
    }
}
