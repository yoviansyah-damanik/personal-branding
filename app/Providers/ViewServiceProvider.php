<?php

namespace App\Providers;

use App\View\Composers\ApplicationInformationComposer;
use App\View\Composers\MetaComposer;
use Illuminate\Support\Facades\View;
use App\View\Composers\ContactComposer;
use App\View\Composers\SidebarComposer;
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
        View::composer('*', ApplicationInformationComposer::class);
        View::composer(['frontend.partials.social-media', 'frontend.sections.contact'], SocialMediaComposer::class);
        View::composer(['frontend.partials.social-media', 'frontend.sections.contact', 'backend.pages.general.site'], ContactComposer::class);
        View::composer(['frontend.partials.main.header', 'frontend.partials.content.header'], MetaComposer::class);
        View::composer(['frontend.partials.content.sidebar'], SidebarComposer::class);
    }
}
