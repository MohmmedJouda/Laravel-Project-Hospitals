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
    public function home(Request $request)
    {
        $query = $request->get('term');
        $hospitals = Hospital::where('is_active', '1')->where('name', 'like', "%{$request->get('term')}%")->get();
        $majors = Major::where('is_active', '1')->where('name', 'like', "%{$request->get('term')}%")->get();
        $doctors = Doctor::all();
        $offers = Offer::all();
        $standards = Standard::all();
        $partners = Partner::all();

        return view('frontend.home', compact('hospitals', 'majors', 'doctors', 'offers', 'standards', 'partners'));
    }
    public function search(Request $request)
    {
        // الحصول على نص البحث
        $term = $request->get('term');

        // إذا كان نص البحث فارغاً، نعيد مصفوفة فارغة فوراً لتجنب استهلاك الموارد
        if (empty($term)) {
            return response()->json([
                'hospitals' => [],
                'majors' => []
            ]);
        }
        // البحث في الأقسام النشطة
        $majors = Major::where('is_active', '1')
            ->where('name', 'like', "%{$term}%")
            ->select('id', 'name')
            ->limit(5)
            ->get();
            
        // البحث في المستشفيات النشطة
        $hospitals = Hospital::where('is_active', '1')
            ->where('name', 'like', "%{$term}%")
            ->select('id', 'name', 'location') // جلب الحقول المطلوبة فقط لسرعة الأداء
            ->limit(5) // تحديد عدد النتائج
            ->get();

        // إعادة النتيجة بصيغة JSON ليفهمها الـ JavaScript
        return response()->json([
            'hospitals' => $hospitals,
            'majors' => $majors
        ]);
    }
}
