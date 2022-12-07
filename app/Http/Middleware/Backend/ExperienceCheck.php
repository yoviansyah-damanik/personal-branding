<?php

namespace App\Http\Middleware\Backend;

use Closure;
use App\Models\Experience;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ExperienceCheck
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
        $experience_count = Experience::count();
        if (!$experience_count) {
            Alert::warning('Attention!', 'Please add a experience first.');
            return to_route('dashboard.experience');
        }
        return $next($request);
    }
}
