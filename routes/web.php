<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Backend\AuthenticationController;

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

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/login', [AuthenticationController::class, 'index'])
    ->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])
    ->name('login.do');

require_once('web_backend.php');
