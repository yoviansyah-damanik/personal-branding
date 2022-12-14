<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralController extends Controller
{
    public function index()
    {
        return view('backend.pages.general.index');
    }

    public function social_media()
    {
        return view('backend.pages.general.social_media');
    }

    public function seo()
    {
        return view('backend.pages.general.seo');
    }

    public function site()
    {
        return view('backend.pages.general.site');
    }

    public function update_images(Request $request)
    {
        try {
            if ($request->file('logo')) {
                $filename = $request->file('logo')->store('branding-images', 'public');
                Configuration::where('attribute', 'app_logo')
                    ->update(['value' => asset('storage/' . $filename)]);
            }

            if ($request->file('favicon')) {
                $filename = $request->file('favicon')->store('branding-images', 'public');
                Configuration::where('attribute', 'app_favicon')
                    ->update(['value' => asset('storage/' . $filename)]);
            }

            if ($request->file('ads')) {
                $filename = $request->file('ads')->store('branding-images', 'public');
                Configuration::where('attribute', 'app_ads')
                    ->update(['value' => asset('storage/' . $filename)]);
            }

            Alert::success(
                __('Successfully!'),
                __('The application logo was successfully updated.')
            );
            return back();
        } catch (Exception $e) {
            Alert::warning(
                __('Something went wrong!'),
                $e->getMessage()
            );
            return back();
        } catch (Throwable $e) {
            Alert::warning(
                __('Something went wrong!'),
                $e->getMessage()
            );
            return back();
        }
    }

    public function update_information(Request $request)
    {
        try {
            if ($request->app_name)
                Configuration::where('attribute', 'app_name')
                    ->update(['value' => $request->app_name]);
            if ($request->app_abb_name)
                Configuration::where('attribute', 'app_abb_name')
                    ->update(['value' => $request->app_abb_name]);
            if ($request->app_description)
                Configuration::where('attribute', 'app_description')
                    ->update(['value' => $request->app_description]);

            Configuration::where('attribute', 'is_maintenance')
                ->update(['value' => $request->has('maintenance')]);

            Alert::success(
                __('Successfully!'),
                __('The application information was successfully updated.')
            );
            return back();
        } catch (Exception $e) {
            Alert::warning(
                __('Something went wrong!'),
                $e->getMessage()
            );
            return back();
        } catch (Throwable $e) {
            Alert::warning(
                __('Something went wrong!'),
                $e->getMessage()
            );
            return back();
        }
    }
}
