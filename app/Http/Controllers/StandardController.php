<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Standard::all();
        return view('standards.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('standards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'chose_standard' => 'nullable|string',
            'title' => 'required|string',
            'details' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,png',
        ]);

        $standard = new Standard();
        $standard->chose_standard = $request->get('chose_standard');
        $standard->title = $request->get('title');
        $standard->details = $request->get('details');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $standard->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('standards', $imagename, ['disk' => 'public']);
            $standard->cover = $imagename;
        }
        $standard->save();
        $saved = $standard->save();
        if ($saved) {
            session()->flash('msg', 'standard Created Successfully');
            return redirect()->route('standards.index');
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
        $standard = Standard::find($id);
        return view('standards.edit', compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Standard $standard)
    {
        $request->validate([
            'chose_standard' => 'nullable|string',
            'title' => 'required|string',
            'details' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,png',
        ]);

        $standard->chose_standard = $request->get('chose_standard');
        $standard->title = $request->get('title');
        $standard->details = $request->get('details');

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $standard->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('standards', $imagename, ['disk' => 'public']);
            $standard->cover = $imagename;
        }
        $saved = $standard->save();
        if ($saved) {
            session()->flash('msg', 'standards Updated Successfully');    //flash()=> ت
            return redirect()->route('standards.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Standard $standard)
    {
        Storage::disk('public')->delete("hospitals/$standard->cover");
        $is_delete = $standard->delete();
        if ($is_delete) {
            session()->flash('del', 'hospital Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
