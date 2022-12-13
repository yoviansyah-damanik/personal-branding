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
            'organizations' => $organizations
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
            'random_organization' => $random_organization
        ]);
    }
}
