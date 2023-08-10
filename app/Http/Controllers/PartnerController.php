<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Partner::all();
        return view('partners.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpg,png',
        ]);

        $partner = new Partner();
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $partner->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('partners', $imagename, ['disk' => 'public']);
            $partner->cover = $imagename;
        }
        $partner->save();
        $saved = $partner->save();
        if ($saved) {
            session()->flash('msg', 'partner Created Successfully');
            return redirect()->route('partners.index');
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
        $data = Partner::find($id);
        return view('partners.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpg,png',
        ]);

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $partner->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('partners', $imagename, ['disk' => 'public']);
            $partner->cover = $imagename;
        }
        $saved = $partner->save();
        if ($saved) {
            session()->flash('msg', 'partners Updated Successfully');    //flash()=> ت
            return redirect()->route('partners.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partner = Partner::find($id);
        Storage::disk('public')->delete("partners/$partner->cover");
        $is_delete = $partner->delete();
        if ($is_delete) {
            session()->flash('del', 'partner Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
