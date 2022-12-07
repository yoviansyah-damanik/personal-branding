<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        return view('backend.pages.general.index');
    }

    public function social_media()
    {
        return view('backend.pages.general.social_media');
    }

    public function seo()
    {
        return view('backend.pages.general.seo');
    }

    public function site()
    {
        return view('backend.pages.general.site');
    }
}
