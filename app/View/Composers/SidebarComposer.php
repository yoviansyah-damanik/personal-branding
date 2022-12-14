<?php

namespace App\View\Composers;

use App\Models\Blog;
use App\Models\Company;
use App\Models\Social;
use Illuminate\View\View;
use App\Models\Organization;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $_other_blog = Blog::published()
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $_other_organization = Organization::published()
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $_other_social = Social::published()
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $_other_company = Company::published()
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $view->with('_other_blog', $_other_blog);
        $view->with('_other_organization', $_other_organization);
        $view->with('_other_social', $_other_social);
        $view->with('_other_company', $_other_company);
    }
}
