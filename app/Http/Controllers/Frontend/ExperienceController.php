<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::published()
            ->get();

        return view('frontend.pages.experience.index', [
            'experiences' => $experiences,
            '_title' => __('Experiences')
        ]);
    }
}
