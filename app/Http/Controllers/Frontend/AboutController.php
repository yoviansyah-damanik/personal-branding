<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('frontend.pages.about.index', [
            '_title' => __('About'),
            '_description' => __('Let me tell you about myself so you can get to know me better.')
        ]);
    }
}
