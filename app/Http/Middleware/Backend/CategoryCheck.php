<?php

namespace App\Http\Middleware\Backend;

use Closure;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryCheck
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
        $category_count = Category::count();
        if (!$category_count) {
            Alert::warning(__('Attention!'), __('Please add a category first.'));
            return to_route('dashboard.category');
        }
        return $next($request);
    }
}
