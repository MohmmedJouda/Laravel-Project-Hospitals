<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Dotenv\Validator;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // paginate()  هادي الدالة بتقسيم البيانات المرجعة على حسب ما بدي
        // بدل ما ارجع كل البيانات
        // رقم 2 هو عدد البيانات المرجعة في الصفحة الواحدة

        $hospitals = Hospital::paginate(2);

        //عشان اعمل تعديل او customize
        //على response الي راجع

        return response()->json([
            'message' => "All Hospitals",
            'data' => $hospitals
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator($request->all(), [
            'name' => 'required',
            'is_active' => 'required',
            'location' => 'required',
        ]);
        $hospital = new Hospital();
        $hospital->name = $request->get('name');
        $hospital->is_active = $request->get('is_active');
        $hospital->location = $request->get('location');
        $hospital->save();
        $hospital->refresh();
        return response()->json([
            "message" => 'hospital add successfully',
            "data" => $hospital

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hospital = Hospital::FindOrFail($id);
        return $hospital;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::FindOrFail($id);
        $hospital->delete();
        return response()->json([
            "message" => 'hospital deleted successfully',
            "date" => $hospital
        ]);
    }
}
