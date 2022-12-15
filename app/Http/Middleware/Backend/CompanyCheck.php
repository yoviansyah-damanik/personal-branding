<?php

namespace App\Http\Middleware\Backend;

use Closure;
use App\Models\Company;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $company_count = Company::count();
        if (!$company_count) {
            Alert::warning(__('Attention!'), __('Please add a company first.'));
            return to_route('dashboard.company');
        }
        return $next($request);
    }
}
