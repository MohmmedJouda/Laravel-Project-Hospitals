<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospital = Hospital::all();
        $item = Offer::all();
        return view('offers.index', compact('item', 'hospital'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospital = Hospital::all();
        return view('offers.create', compact('hospital'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'hospital_id' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'discount' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,png',
        ]);

        $offer = new Offer();
        $offer->title = $request->get('title');
        $offer->hospital_id = $request->get('hospital_id');
        $offer->discount = $request->get('discount');
        $offer->old_price = $request->get('old_price');
        $offer->new_price = $request->get('new_price');
        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $offer->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('offers', $imagename, ['disk' => 'public']);
            $offer->cover = $imagename;
        }
        $offer->save();
        $saved = $offer->save();
        if ($saved) {
            session()->flash('msg', 'Offer Created Successfully');
            return redirect()->route('offers.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $hospital = Hospital::all();
        return view('offers.edit', compact('offer', 'hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string',
            'hospital_id' => 'required',
            'old_price' => 'required',
            'new_price' => 'required',
            'discount' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,png',
        ]);

        // $item = offer::find($id);
        $offer->title = $request->get('title');
        $offer->hospital_id = $request->get('hospital_id');
        $offer->discount = $request->get('discount');
        $offer->old_price = $request->get('old_price');
        $offer->new_price = $request->get('new_price');

        if ($request->has('cover')) {
            $image = $request->file('cover');
            $imagename = time() . $offer->name . '.' . $image->getClientOriginalExtension();   //getClientOriginalExtension =>بترجع امتداد الصورة و هنا قمنا بدمج اسم الصورة مع امتدادها
            $request->file('cover')->storePubliclyAs('offers', $imagename, ['disk' => 'public']);
            $offer->cover = $imagename;
        }
        $saved = $offer->save();
        if ($saved) {
            session()->flash('msg', 'Offers Updated Successfully');    //flash()=> ت
            return redirect()->route('offers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {

        Storage::disk('public')->delete("hospitals/$offer->cover");
        $is_delete = $offer->delete();
        if ($is_delete) {
            session()->flash('del', 'hospital Deleted successfully');
            return redirect()->back();
        } else {
            return "somithing worng";
        }
    }
}
