<?php

namespace App\View\Composers;

use App\Models\Configuration;
use Illuminate\View\View;

class ContactComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $configs = Configuration::whereIn('attribute', ['phone_number', 'email'])
            ->get();

        $phone_number = $configs->filter(fn ($item) => $item->attribute == 'phone_number')->first()->value;
        $email = $configs->filter(fn ($item) => $item->attribute == 'email')->first()->value;

        $view->with('_phone_number', $phone_number);
        $view->with('_email', $email);
    }
}
