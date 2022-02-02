<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;
use App\Models\User;
use App\Models\Task;

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

Route::get('/login', function () {
    return view('login');
});
Route::get('/tasks',[TaskController::class,'index']);
Route::delete('/tasks/{id}',[TasksController::class,'destroy']);
Route::put('/tasks/{id}',[TasksController::class,'update']);
Route::post('/tasks',[TasksController::class,'store'])->name('savetasks');
Route::get('/tasks/create',[TasksController::class,'create']);
// Route::resource('/tasks',[TasksController::class]);

Route::resource('product',ProductController::class);
// Route::resource('/book',BookController::class);
Route::get('/book',[BookController::class,'index']);
Route::get('/book/create',[BookController::class,'create']);
Route::post('/book',[BookController::class,'store']);
// Route::group(['middleware' => ['web']], function () {
    
//     Route::post('/book',[BookController::class,'store']);

// });
// Route::view(user,'user');

// mails
Route::get('send-mail',function(){
    // $details = [
    //     'title'=>'Mail from Winterdev.com',
    //     'body'=>'This is for testing usinng email smtp'
    // ];
    Mail::to('snowdevin.sd@gmail.com')->send(new \App\Mail\MyTestMail);
    dd("Email is Sent.");
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// download excel
Route::get('file-export', [BookController::class, 'export'])->name('file-export');