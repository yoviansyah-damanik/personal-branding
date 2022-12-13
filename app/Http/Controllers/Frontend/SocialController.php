<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::published()
            ->latest()
            ->get();

        return view('frontend.pages.social.index', [
            'socials' => $socials
        ]);
    }

    public function show(Social $social)
    {
        $random_social = Social::whereNot('id', $social->id)
            ->published()
            ->limit(3)
            ->inRandomOrder()
            ->get();

        return view('frontend.pages.social.show', [
            'random_social' => $random_social,
            'social' => $social
        ]);
    }
}
