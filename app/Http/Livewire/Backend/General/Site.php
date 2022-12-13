<?php

namespace App\Http\Livewire\Backend\General;

use Livewire\Component;
use Livewire\WithFileUploads;

class Site extends Component
{
    use WithFileUploads;

    public $app_logo, $app_favicon, $app_name, $app_abb_name;

    public function render()
    {
        return view('livewire.backend.general.site');
    }

    public function validationAttribute()
    {
        return [
            'app_logo' => __('Application Logo'),
            'app_favicon' => __('Application Favicon'),
            'app_name' => __('Application Name'),
            'app_abb_name' => __('Application Abbreviation Name'),
            'maintenance' => __('Maintenance'),
        ];
    }
}
