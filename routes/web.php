<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\SocialController;
use App\Http\Controllers\Frontend\CompanyController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\ExperienceController;
use App\Http\Controllers\Frontend\OrganizationController;
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

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/project', [ProjectController::class, 'index'])
    ->name('project');

Route::get('/company', [CompanyController::class, 'index'])
    ->name('company');
Route::get('/company/{company:slug}', [CompanyController::class, 'show'])
    ->name('company.show');

Route::get('/about', [AboutController::class, 'index'])
    ->name('about');

Route::get('/experience', [ExperienceController::class, 'index'])
    ->name('experience');

Route::get('/organization', [OrganizationController::class, 'index'])
    ->name('organization');
Route::get('/organization/{organization:slug}', [OrganizationController::class, 'show'])
    ->name('organization.show');

Route::get('/social', [SocialController::class, 'index'])
    ->name('social');
Route::get('/social/{social:slug}', [SocialController::class, 'show'])
    ->name('social.show');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');


require_once('web_backend.php');
