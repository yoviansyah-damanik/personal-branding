<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SectorController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomepageController;
use App\Http\Controllers\Backend\ExperienceController;

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ],
    function () {
        Route::get('/', [HomepageController::class, 'index'])
            ->name('homepage');

        // BLOG
        Route::middleware('category_check')
            ->controller(BlogController::class)
            ->group(function () {
                Route::get('/blog', 'index')
                    ->name('blog');
                Route::get('/blog/create', 'create')
                    ->name('blog.create');
                Route::post('/blog/store', 'store')
                    ->name('blog.store');
                Route::get('/blog/edit/{blog:slug}', 'edit')
                    ->name('blog.edit');
                Route::put('/blog/update/{blog:slug}', 'update')
                    ->name('blog.update');
                Route::delete('/blog/delete/{blog:slug}', 'delete')
                    ->name('blog.delete');
                Route::get('/blog/{blog:slug}', 'show')
                    ->name('blog.show');
            });

        // TAG
        Route::controller(TagController::class)
            ->group(function () {
                Route::get('/tag', 'index')
                    ->name('tag');
                Route::delete('/tag/{tag:id}', 'delete')
                    ->name('tag.delete');
            });

        // CATEGORY
        Route::controller(CategoryController::class)
            ->group(function () {
                Route::get('/category', 'index')
                    ->name('category');
                Route::delete('/category/{category:id}', 'delete')
                    ->name('category.delete');
            });

        // PROJECT
        Route::middleware('sector_check')
            ->controller(ProjectController::class)
            ->group(function () {
                Route::get('/project', 'index')
                    ->name('project');
                Route::get('/project', 'index')
                    ->name('project');
                Route::get('/project/create', 'create')
                    ->name('project.create');
                Route::post('/project/store', 'store')
                    ->name('project.store');
                Route::get('/project/edit/{project:slug}', 'edit')
                    ->name('project.edit');
                Route::put('/project/update/{project:slug}', 'update')
                    ->name('project.update');
                Route::delete('/project/delete/{project:slug}', 'delete')
                    ->name('project.delete');
                Route::get('/project/{project:slug}', 'show')
                    ->name('project.show');
            });

        // SECTOR
        Route::controller(SectorController::class)
            ->group(function () {
                Route::get('/sector', 'index')
                    ->name('sector');
                Route::delete('/sector/{sector:id}', 'delete')
                    ->name('sector.delete');
            });

        // EXPERIENCE
        Route::controller(ExperienceController::class)
            ->group(function () {
                Route::get('/experience', 'index')
                    ->name('experience');
            });

        // JOB
        Route::middleware('experience_check')
            ->controller(JobController::class)
            ->group(function () {
                Route::get('/job', 'index')
                    ->name('job');
            });

        // ACCOUNT
        Route::controller(AccountController::class)
            ->group(function () {
                Route::get('/account', 'index')
                    ->name('account');
            });

        // GENERAL
        Route::controller(GeneralController::class)
            ->group(function () {
                Route::get('/general', 'index')
                    ->name('general');
            });
    }
);
