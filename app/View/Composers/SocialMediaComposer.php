<?php

namespace App\View\Composers;

use App\Models\SocialMediaAccount;
use Illuminate\View\View;

class SocialMediaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $social_media = SocialMediaAccount::get();

        $view->with('_social_media', $social_media);
    }
}
