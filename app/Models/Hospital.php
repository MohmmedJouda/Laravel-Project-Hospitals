<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    // الحقول الي بنضيفها بهادي الاري هيا اللحقول الي بيتم ارسالها للداتا بيز لتخزينها fillable
    // protected $fillable = ['name', 'is_active', 'location'];

    public function majors()
    {
        return $this->belongsToMany(Major::class, 'hospital_major', 'hospital_id', 'major_id');
    }

    public function getActiveStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Not Active';
    }


    // الراجعapi  هادي عشان اذا بدي اخفي اي حقل في
    //وقمت باخفاء هدول الحقلين
    protected $hidden = ['created_at', 'updated_at'];

    //    getActiveStatusAttributeمثل دالة ال ,  accessors عشان اضيف ال
    protected $appends = ['active_status'];
}
