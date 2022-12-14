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
            'socials' => $socials,
            '_title' => __('Socials'),
            '_description' => __('Social activities that I routinely do without strings attached. Caring can grow for many reasons. Sensitivity of feelings will make us think about the actions we will take. Will we just sympathize or will we empathize to provide action.'),
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
            'social' => $social,
            '_title' => $social->name,
            '_description' => $social->excerpt,
            '_image' => $social->image_path
        ]);
    }
}
