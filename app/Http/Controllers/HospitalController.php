<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Major;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Reques\validate;


class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Hospital::all();
        $majors = Major::all();
        return view('hospitals.index', compact('item', 'majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('hospitals.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'info' => 'nullable|string',
            // 'is_active' => 'in:on|string',
            'cover' => 'nullable|image|mimes:jpg,png'

        ]);

        $item = new Hospital;
        $item->name = $request->get('name');
        $item->location = $request->get('location');
        $item->info = $request->get('info');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $item->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('hospitals', $imagename, ['disk' => 'public']);
            $item->cover = $imagename;
        }
        $item->is_active = $request->has('is_active');
        $item->save();
        $saved = $item->save();
        $item->majors()->attach($request->get('majors'));
        if ($saved) {
            session()->flash('msg', 'Hospital Created Successfully');
            return redirect()->route('hospitals.index');
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
        $hos = Hospital::find($id);
        return view('hospitals.edit', compact('hos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'info' => 'nullable|string',
            // 'is_active' => 'in:on|string',
            'cover' => 'nullable|image|mimes:jpg,png'

        ]);

        $item = Hospital::find($id);
        $item->name = $request->get('name');
        $item->location = $request->get('location');
        $item->info = $request->get('info');

        if ($request->has('cover')) {
            $image = $request->file('cover');

            $imagename = time() . $item->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('hospitals', $imagename, ['disk' => 'public']);
            $item->cover = $imagename;
        }
        $item->is_active = $request->has('is_active');
        $saved = $item->save();
        if ($saved) {
            session()->flash('msg', 'Hospital Updated Successfully');    //flash()=> ت
            return redirect()->route('hospitals.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $majors = Major::find($id);
        // $majors->delete();
        $hospital = Hospital::find($id);
        Storage::disk('public')->delete("hospitals/$hospital->cover");
        $is_delete = $hospital->delete();
        if ($is_delete) {
            session()->flash('del', 'hospital Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
