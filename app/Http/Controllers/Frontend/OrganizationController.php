<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::published()
            ->inRandomOrder()
            ->get();

        return view('frontend.pages.organization.index', [
            'organizations' => $organizations,
            '_title' => __('Organizations'),
            '_description' => __('I joined various organizations to improve myself and just as a hobby.'),
        ]);
    }

    public function show(Organization $organization)
    {
        $random_organization = Organization::published()
            ->whereNot('id', $organization->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('frontend.pages.organization.show', [
            'organization' => $organization,
            'random_organization' => $random_organization,
            '_title' => $organization->name,
            '_description' => $organization->excerpt,
            '_image' => $organization->image_path
        ]);
    }
}
