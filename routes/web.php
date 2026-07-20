<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\Quiz3Controller;
use App\Http\Controllers\Front\ApiController;
use App\Http\Controllers\Front\AffiliateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Front\AffiliateContestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\TestPromptResponseController;

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
//     // return redirect()->route('admin.dashboard');
// });
// Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
// Route::get('/new-mailerlite', [HomeController::class, 'mailerlite'])->name('mailerlite');

// Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/optimize-clear', function() {
    \Artisan::call('optimize:clear');
     dd('Optimize clear executed.');
  });

/*Soulmate Number Route Start*/
Route::get('/', [HomeController::class, 'getSoulmateNumber'])->name('getSoulmateNumber');
Route::post('/soulmate-number', [HomeController::class, 'postSoulmateNumber'])->name('postSoulmateNumber');
Route::get('/soulmate-number/thankyou', [HomeController::class, 'getSoulmateNumberThankyou'])->name('getSoulmateNumberThankyou');
Route::get('/soulmate-number/report/{slug?}', [HomeController::class, 'getGPTReport'])->name('getGPT1');
Route::get('/soulmate-number/download-pdf/{slug?}', [HomeController::class, 'getDownloadPDF'])->name('getDownloadPDF');
Route::get('/soulmate-number/mail', [HomeController::class, 'getSoulmatMail'])->name('getSoulmatMail');
/*Soulmate Number Route End*/


Route::get('/salescopywriting', [HomeController::class, 'salesCopyWriting'])->name('salesCopyWriting');
Route::get('/padGeneration', [HomeController::class, 'padGeneration'])->name('padGeneration');
Route::group(['prefix' => 'orders', 'as' => 'order.'], function() {
    Route::post('orders', [OrderController::class, 'store'])->name('store');
});

Route::get('/thankyou', [HomeController::class, 'thankyou'])->name('thankyou');

Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms-condition', [HomeController::class, 'termsOfService'])->name('termsOfService');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::view('/loginpage', 'front.login.login2' );
Route::view('/thank-you', 'front.login.thankyou' );
Route::view('/product', 'front.login.product' );
Route::get('/forgotpassword', [HomeController::class, 'forgotpassword'])->name('forgotpassword');
Route::get('/resetPassword', [HomeController::class, 'resetPassword'])->name('resetPassword');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/transcript/{slug}', [TranscriptController::class, 'transcript'])->name('transcript');

Route::post('/save-data', [TranscriptController::class, 'savedata'])->name('savedata');


Route::get('/sketchgenerator', [HomeController::class, 'sketchgenerator']);
Route::get('/sketchgeneratorcolor', [HomeController::class, 'sketchgeneratorcolor']);
Route::get('/sketchgeneratorbackgroundcolor', [HomeController::class, 'sketchgeneratorbackgroundcolor']);
Route::get('/sketchgeneratorbackground', [HomeController::class, 'sketchgeneratorbackground']);

// Route::get('/{page}', [HomeController::class, 'page'])->name('page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.'] ,function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');
});

//generrate PDF
Route::get('/save-pdf-content', [HomeController::class, 'savePdfContent'])->name('savePdfContent');
Route::get('/pdf-generate/{transcript}', [HomeController::class, 'newPdfGeneration'])->name('newPdfGeneration');
Route::get('sketch/show/{transcript}', [HomeController::class, 'showSketch'])->name('showSketch');
//test sketch routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'] ,function () {
    Route::get('/test-sketch/create', [TestPromptResponseController::class, 'create'])->name('testSketchPromptCreate');
    Route::post('/test-sketch/store', [TestPromptResponseController::class, 'store'])->name('testSketchPromptStore');
    Route::get('/test-pdf/create', [TestPromptResponseController::class, 'createTestPdfContent'])->name('createTestPdfContent');
    Route::post('/test-pdf/store', [TestPromptResponseController::class, 'storeTestPdfContent'])->name('storeTestPdfContent');
});

//subscriber routes to product access
Route::group(['prefix' => 'subscriber', 'as' =>'subscriber.'], function() {
    Route::get('/login', [OrderController::class, 'subscriberLogin'])->name('login');
    Route::post('/product', [OrderController::class, 'subscriberProduct'])->name('product');
});
