<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use App\Mail\WellcomeMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;
    //بقوم بارسال الايميل من خلال هذه الفنكشن او من خلال الكونترولر
    protected static function booted()
    {
        static::created(function ($admin) {
            Mail::to($admin->email)->send(new WellcomeMail());
        });
        // static::creating();
    }
}
