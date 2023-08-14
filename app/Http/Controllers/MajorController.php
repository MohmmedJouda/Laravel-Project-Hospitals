<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Major::all();
        return view('majors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);

        $item = new Major;
        $item->name = $request->get('name');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $item->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('majors', $imagename, ['disk' => 'public']);
            $item->cover = $imagename;
        }
        $item->is_active = $request->has('is_active');
        $item->save();
        $saved = $item->save();
        if ($saved) {
            session()->flash('msg', 'Majors Created Successfully');
            return redirect()->route('majors.index');
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
        $data = Major::find($id);
        return view('majors.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string', 
            'cover' => 'nullable|image|mimes:jpg,png'
        ]);
        $item = Major::find($id);
        $item->name = $request->get('name');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $item->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('majors', $imagename, ['disk' => 'public']);
            $item->cover = $imagename;
        }
        $item->is_active = $request->has('is_active');
        $saved = $item->save();
        if ($saved) {
            session()->flash('msg', 'Major Updated Successfully');    //flash()=> ت
            return redirect()->route('majors.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = major::find($id);
        Storage::disk('public')->delete("majors/$major->cover");
        $is_delete = $major->delete();
        if ($is_delete) {
            session()->flash('del', 'major Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
