<?php

use App\Http\Controllers\UserController;
use App\Mail\MyEmail;
use App\Models\Appointment;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
    return redirect('/admin/login');
});

Route::get('/no-access',function(){
    echo "Not Allowed";
    die;
});


// Route::get('/testroute', function(){
    // $appointment=Appointment::all();
    // Mail::to('hello@gmail.com')->send(new MyEmail($appointment));
// });