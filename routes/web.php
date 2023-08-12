<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLayoutController;


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

Route::get('super-admin/dashboard', [AdminLayoutController::class, 'dashboard']);
Route::get('super-admin/tables', [AdminLayoutController::class, 'tables']);
Route::get('/login', [AdminLayoutController::class, 'login']);
Route::get('/registration', [AdminLayoutController::class, 'registration']);