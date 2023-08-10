<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospital = Hospital::all();
        $item = Doctor::all();
        return view('doctors.index', compact('item', 'hospital'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospital = Hospital::all();
        return view('doctors.create', compact('hospital'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'hospital_id' => 'required',
            'email' => 'required|string|email',
            'phone' => 'nullable|string|numeric|min:9',
            // 'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png',
            // 'is_active' => 'in:on|string'
        ]);

        $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->hospital_id = $request->get('hospital_id');
        $doctor->email = $request->get('email');
        $doctor->phone = $request->get('phone');
        // $doctor->descrption = $request->get('descrption');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $doctor->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('doctors', $imagename, ['disk' => 'public']);
            $doctor->cover = $imagename;
        }
        // $doctor->is_active = $request->has('is_active');
        $doctor->save();
        $saved = $doctor->save();
        if ($saved) {
            session()->flash('msg', 'Doctor Created Successfully');
            return redirect()->route('doctors.index');
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
    public function edit(Doctor $doctor)
    {
        // $doc = Doctor::find($id);
        $hospital = Hospital::all();
        return view('doctors.edit', compact('doctor', 'hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string',
            'hospital_id' => 'required',
            'email' => 'required|string|email',
            'phone' => 'nullable|string|numeric|min:9',
            // 'descrption' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);

        // $item = Doctor::find($id);
        $doctor->name = $request->get('name');
        $doctor->hospital_id = $request->get('hospital_id');
        $doctor->email = $request->get('email');
        $doctor->phone = $request->get('phone');
        $doctor->descrption = $request->get('descrption');

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $doctor->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('doctors', $imagename, ['disk' => 'public']);
            $doctor->cover = $imagename;
        }
        // $doctor->is_active = $request->has('is_active');
        $saved = $doctor->save();
        if ($saved) {
            session()->flash('msg', 'Doctors Updated Successfully');    //flash()=> ت
            return redirect()->route('doctors.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        // $doctors = Doctor::find($id);
        Storage::disk('public')->delete("hospitals/$doctor->cover");
        $is_delete = $doctor->delete();
        if ($is_delete) {
            session()->flash('del', 'hospital Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
