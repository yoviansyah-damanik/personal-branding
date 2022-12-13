<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\ContactComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\SocialMediaComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.partials.social-media', SocialMediaComposer::class);
        View::composer('frontend.partials.social-media', ContactComposer::class);
    }
}
