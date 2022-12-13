<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::published()
            ->latest()
            ->get();

        return view('frontend.pages.company.index', [
            'companies' => $companies
        ]);
    }

    public function show(Company $company)
    {
        $random_company = Company::whereNot('id', $company->id)
            ->published()
            ->inRandomOrder()
            ->get();

        return view('frontend.pages.company.show', [
            'company' => $company,
            'random_company' => $random_company
        ]);
    }
}
