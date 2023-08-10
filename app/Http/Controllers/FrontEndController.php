<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Major;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Standard;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home()
    {
        $hospitals = Hospital::where('is_active', '1')->get();
        $majors = Major::where('is_active', '1')->get();
        $doctors = Doctor::all();
        $offers = Offer::all();
        $standards = Standard::all();
        $partners = Partner::all();
        return view('frontend.home', compact('hospitals', 'majors', 'doctors', 'offers', 'standards', 'partners'));
    }
}
