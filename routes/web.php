<?php

use Illuminate\Support\Facades\Route;
use App\Models\Permission; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// MiddleWare for Admin And Other Users Checking
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/1', function () {return "admin Role";});
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/2', function () {return "user Role";});
});



// MiddleWare for Users Permission Checking
Route::group(['middleware' => ['auth', 'permission:create_post']], function () {
    // Routes accessible only by users with the 'create_post' permission
    Route::get('/3', function () {return "permission:create_post";});
});

Route::group(['middleware' => ['auth', 'permission:edit_post']], function () {
    Route::get('/4', function () {return "permission:edit_post";});
});

Route::group(['middleware' => ['auth', 'permission:delete_post']], function () {
    // Routes accessible only by users with the 'delete_post' permission
});
