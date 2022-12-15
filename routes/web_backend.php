<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SectorController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomepageController;
use App\Http\Controllers\Backend\ExperienceController;
use App\Http\Controllers\Backend\OrganizationController;

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
            });

        // PROJECT
        Route::middleware('company_check')
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
            });

        // COMPANY
        Route::middleware('sector_check')->controller(CompanyController::class)
            ->group(function () {
                Route::get('/company', 'index')
                    ->name('company');
                Route::get('/company/create', 'create')
                    ->name('company.create');
                Route::post('/company/store', 'store')
                    ->name('company.store');
                Route::get('/company/edit/{company:slug}', 'edit')
                    ->name('company.edit');
                Route::put('/company/update/{company:slug}', 'update')
                    ->name('company.update');
                Route::delete('/company/delete/{company:slug}', 'delete')
                    ->name('company.delete');
                Route::get('/company/{company:slug}', 'show')
                    ->name('company.show');
            });

        // EXPERIENCE
        Route::controller(ExperienceController::class)
            ->group(function () {
                Route::get('/experience', 'index')
                    ->name('experience');
                Route::get('/experience/create', 'create')
                    ->name('experience.create');
                Route::post('/experience/store', 'store')
                    ->name('experience.store');
                Route::get('/experience/edit/{experience:slug}', 'edit')
                    ->name('experience.edit');
                Route::put('/experience/update/{experience:slug}', 'update')
                    ->name('experience.update');
                Route::delete('/experience/delete/{experience:slug}', 'delete')
                    ->name('experience.delete');
                Route::get('/experience/{experience:slug}', 'show')
                    ->name('experience.show');
            });

        // ORGANIZATION
        Route::controller(OrganizationController::class)
            ->group(function () {
                Route::get('/organization', 'index')
                    ->name('organization');
                Route::get('/organization/create', 'create')
                    ->name('organization.create');
                Route::post('/organization/store', 'store')
                    ->name('organization.store');
                Route::get('/organization/edit/{organization:slug}', 'edit')
                    ->name('organization.edit');
                Route::put('/organization/update/{organization:slug}', 'update')
                    ->name('organization.update');
                Route::delete('/organization/delete/{organization:slug}', 'delete')
                    ->name('organization.delete');
                Route::get('/organization/{organization:slug}', 'show')
                    ->name('organization.show');
            });

        // SOCIAL
        Route::controller(SocialController::class)
            ->group(function () {
                Route::get('/social', 'index')
                    ->name('social');
                Route::get('/social/create', 'create')
                    ->name('social.create');
                Route::post('/social/store', 'store')
                    ->name('social.store');
                Route::get('/social/edit/{social:slug}', 'edit')
                    ->name('social.edit');
                Route::put('/social/update/{social:slug}', 'update')
                    ->name('social.update');
                Route::delete('/social/delete/{social:slug}', 'delete')
                    ->name('social.delete');
                Route::get('/social/{social:slug}', 'show')
                    ->name('social.show');
            });

        // CONTACT
        Route::controller(ContactController::class)
            ->group(function () {
                Route::get('/contact', 'index')
                    ->name('contact');
                Route::get('/contact/{contact:ticket_number}', 'show')
                    ->name('contact.show');
            });

        // PARTNER
        Route::controller(PartnerController::class)
            ->group(function () {
                Route::get('/partner', 'index')
                    ->name('partner');
            });

        // ACCOUNT
        Route::controller(AccountController::class)
            ->group(function () {
                Route::get('/account', 'index')
                    ->name('account');
                Route::get('/account/information', 'information')
                    ->name('account.information');
                Route::get('/account/password', 'password')
                    ->name('account.password');
            });

        // GENERAL
        Route::controller(GeneralController::class)
            ->group(function () {
                Route::get('/general', 'index')
                    ->name('general');
                Route::get('/general/social_media', 'social_media')
                    ->name('general.social_media');
                Route::get('/general/seo', 'seo')
                    ->name('general.seo');
                Route::get('/general/site', 'site')
                    ->name('general.site');
                Route::put('/general/site/images', 'update_images')
                    ->name('general.site.images');
                Route::put('/general/site/information', 'update_information')
                    ->name('general.site.information');
                Route::put('/general/site/owner', 'update_owner')
                    ->name('general.site.owner');
                Route::put('/general/site/biography', 'update_biography')
                    ->name('general.site.biography');
                Route::put('/general/site/owner', 'update_owner')
                    ->name('general.site.owner');
            });
    }
);
