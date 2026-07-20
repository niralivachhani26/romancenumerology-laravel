<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Front\HomeController;

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
    // return view('welcome');
    return redirect()->route('home');
});
Route::get('/login', [AdminAuthController::class, 'login'])->name('userLogin');

// Route::group(['middleware' => 'userauth'], function () {
//     Route::get('/', [HomeController::class, 'index'])->name('user.index');
// });
