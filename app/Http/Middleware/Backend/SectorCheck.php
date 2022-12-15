<?php

namespace App\Http\Middleware\Backend;

use Closure;
use App\Models\Sector;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SectorCheck
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
        $sector_count = Sector::count();
        if (!$sector_count) {
            Alert::warning(__('Attention!'), __('Please add a sector first.'));
            return to_route('dashboard.sector');
        }
        return $next($request);
    }
}
