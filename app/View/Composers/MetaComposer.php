<?php

namespace App\View\Composers;

use App\Models\Configuration;
use Illuminate\View\View;

class MetaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $_keyword = collect([]);
        $view->with('_keyword', $_keyword);
    }
}
