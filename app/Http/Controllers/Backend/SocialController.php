<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SocialController extends Controller
{
    public function index()
    {
        return view('backend.pages.social.index');
    }

    public function show(Social $social)
    {
        return view('backend.pages.social.show', ['social' => $social]);
    }

    public function create()
    {
        return view('backend.pages.social.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:rasio=7/4',
                'name' => 'required|max:200',
                'description' => 'required',
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Social::class, 'slug', $request->name);
            $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
            DB::transaction(function () use ($request, $slug, $filename) {
                $new_social = new Social;
                $new_social->name = $request->name;
                $new_social->description = $request->description;
                $new_social->image = 'social-images/' . $filename;
                $new_social->slug = $slug;
                $new_social->save();
            });

            $request->file('image')->storeAs('social-images', $filename, 'public');

            DB::commit();
            Alert::success(__('Successfully!'), __('The social was successfully created.'));
            return to_route('dashboard.social.show', $slug);
        } catch (Exception $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        } catch (Throwable $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(Social $social)
    {
        return view('backend.pages.social.edit', [
            'social' => $social,
        ]);
    }

    public function update(Social $social, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=7/4',
                'name' => 'required|max:200',
                'description' => 'required',
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $social) {
                $social->slug = null;
                $social->name = $request->name;
                $social->description = $request->description;
                $social->save();
            });

            if ($request->file('image')) {
                $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
                GeneralHelper::delete_image($social->image);
                $request->file('image')->storeAs('social-images', $filename, 'public');

                $social->image = 'social-images/' . $filename;
                $social->save();
            }

            $social = $social->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('The social was successfully updated.'));
            return to_route('dashboard.social.show', $social->slug);
        } catch (Exception $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        } catch (Throwable $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        }
    }

    public function delete(Social $social)
    {
        try {
            GeneralHelper::delete_image($social->image);
            $social->delete();

            Alert::success(__('Successfully!'), __('The social was successfully deleted.'));
            return to_route('dashboard.social');
        } catch (Exception $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
