<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Social;
use App\Models\Company;
use App\Models\Partner;
use App\Models\Experience;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()
            ->latest()
            ->limit(3)
            ->get();

        $companies = Company::with('sectors')
            ->published()
            ->latest()
            ->get();

        $organizations = Organization::published()
            ->inRandomOrder()
            ->get();

        $socials = Social::published()
            ->latest()
            ->get();

        $experiences = Experience::published()
            ->orderBy('start_period', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $partners = Partner::get();

        return view('frontend.index', [
            'companies' => $companies,
            'organizations' => $organizations,
            'socials' => $socials,
            'experiences' => $experiences,
            'blogs' => $blogs,
            'partners' => $partners,
            '_title' => __('Home')
        ]);
    }
}
