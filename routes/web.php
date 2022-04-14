<?php

use App\Http\Controllers\DeshboardController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMailMarkdown;
use App\Jobs\sendTestMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//For Service Provider
use App\Paymentservice\PaypalApi;

// forFacades
use App\PostCardSendingService;
use App\Postcard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//service provider
Route::get('/provide',function(PaypalApi $payment){
   dd($payment->pay());
});

//Facades
Route::get('/postcards', function () {
    $postCardService = new PostCardSendingService('USA',6,4);
    $postCardService->hello('Hello from laravel USA','test@test.com');
});

Route::get('/facades',function(){

    Postcard::hello('hello from facades','abc@gmail.com');
       //  Postcard::something();
      // Postcard::any();
});

//practice queue
Route::get('/queue', function () {


    $user=User::findOrFail(4);
    // method:1
    // dispatch(function(){
    //    we can write Mail function here
    // })->delay(now()->addSecond(5));
   
    //method:2
    //dispatch(new sendTestMailJob($user))->delay(now()->addSeconds(5));

    //method:3
    sendTestMailJob::dispatch($user)->delay(now()->addSeconds(5));
    echo "Mail sent";    

});


//Cache Practice
Route::get('/cache',[HomeController::class,'cache_store']);
Route::get('/redis/{id}',[HomeController::class,'redis']);
Route::get('/update/{id}',[HomeController::class,'redis_update']);
Route::get('/delete/{id}',[HomeController::class,'redis_delete']);


//serialization
Route::get('/index/{id}',[HomeController::class,'index']);

//exceptoion
Route::get('/getdata',[HomeController::class,'exception']);

//practice Rate limiting
Route::get('/rate',function(){
    return "Hii! Route Calling";
})->middleware('throttle:limit_request');


Route::middleware(['auth'])->group(function(){
    //Route::get('/post',[PostController::class,'index'])->name('post_index')->middleware(['can:isAdmin']);
    // Route::post('/post',[PostController::class,'create'])->name('post_create');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post_edit');
    Route::put('/post/edit/{id}',[PostController::class,'update'])->name('post_update');
    Route::get('/post/delete/{id}',[PostController::class,'destroy'])->name('post_delete');
});

Route::get('/',[HomeController::class,'show_post'])->name('home');

Route::get('/post',[PostController::class,'index'])->name('post_index');
Route::post('/post',[PostController::class,'create'])->name('post_create');
//Route::get('/event',[PostController::class,'event']);

//database notification
Route::get('/notification',[NotificationController::class,'databaseNotification']);



Route::get('/dashboard',[DeshboardController::class,"show_post"])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
