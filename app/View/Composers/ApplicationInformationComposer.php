<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Configuration;
use App\Models\SocialMediaAccount;

class ApplicationInformationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        Configuration::get()->each(function ($item) use ($view) {
            return $view->with('_' . $item->attribute, $item->value);
        });
    }
}
