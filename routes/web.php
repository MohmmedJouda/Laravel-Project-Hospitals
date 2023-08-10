<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\PremisstionController;
use App\Http\Controllers\RolePremisstionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/layout', function () {
    return view('admin.layout');
});

// Route::get('/home', function () {
//     return view('admin.home');
// });


// auth==> اسم ال middleware
// admin==> اسم ال guard
// Route::get('/', function () {
//     return view('admin.layout');
// })->name('admin.layout');

Route::prefix('admin/')->middleware('auth:admin')->group(function () {
    Route::get('home', [AuthController::class, 'dashboard'])->name('admin.home');
    Route::resource('hospitals', HospitalController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('standards', StandardController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PremisstionController::class);
    Route::resource('permissions/role', RolePremisstionController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('change-password', [AuthController::class, 'changePassword'])->name('admin.change-password');
    Route::post('change-password', [AuthController::class, 'postPassword'])->name('admin.post-change');
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
    Route::get('home', [HomeController::class, 'index'])->name('admin.home');
});

Route::prefix('admin/')->middleware('guest:admin')->group(function () {
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
});

Route::fallback(function () {
    return view('admin.error404');
});



////////////////////////////  Front End Routes  /////////////////


Route::get('/', [FrontEndController::class, 'home'])->name('home');
