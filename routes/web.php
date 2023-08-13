<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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

//Route::get('/dashboard', [AdminLayoutController::class, 'dashboard']);
//Route::get('/tables', [AdminLayoutController::class, 'tables']);



//login & registration-------------------------

Route::get('/login', [AuthController::class, 'login']);
Route::post('/user-login', [AuthController::class, 'userLogin']);
/* Route::get('/registration', [AdminLayoutController::class, 'registration']); */

Route::get('/teacher-register', [AuthController::class, 'teacherRegister']);
Route::post('/teacher-registration', [AuthController::class, 'registrationTeacher']);

Route::get('/student-register', [AuthController::class, 'studentRegister']);
Route::post('/student-registration', [AuthController::class, 'registrationStudent']);



//middleware to make routes protected
Route::middleware(['checkLogin'])->group(function () {

    Route::get('/dashboard',[AdminLayoutController::class, 'dashboard']);
    Route::get('/tables',[AdminLayoutController::class, 'tables']);
    
    Route::get('/logout',[AuthController::class,'logout']);
    //Route::get('/pending-users', [UserController::class, 'pendingUsers']);


    Route::middleware(['checkIfSuperAdmin'])->group(function () {

       Route::get('/pending-users', [UserController::class, 'pendingUsers']);
        Route::get('/approve-user/{userid}', [UserController::class, 'approveUser']);

    });


});