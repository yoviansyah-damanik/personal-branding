<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('backend.pages.organization.index');
    }

    public function show(Organization $organization)
    {
        return view('backend.pages.organization.show', ['organization' => $organization]);
    }

    public function create()
    {
        return view('backend.pages.organization.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:rasio=1/1',
                'name' => 'required|max:200',
                'description' => 'required',
                'start_period' => 'required|date',
                'is_end' => 'nullable',
                'end_period' => 'required_with:is_end|nullable|date'
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Organization::class, 'slug', $request->name);
            $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
            DB::transaction(function () use ($request, $slug, $filename) {
                $new_organization = new Organization;
                $new_organization->name = $request->name;
                $new_organization->start_period = $request->start_period;

                if ($request->is_end)
                    $new_organization->end_period = $request->end_period;

                $new_organization->description = $request->description;
                $new_organization->image = 'organization-images/' . $filename;
                $new_organization->slug = $slug;
                $new_organization->save();
            });

            $request->file('image')->storeAs('organization-images', $filename, 'public');

            DB::commit();
            Alert::success(__('Successfully!'), __('The organization was successfully created.'));
            return to_route('dashboard.organization.show', $slug);
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

    public function edit(Organization $organization)
    {
        return view('backend.pages.organization.edit', [
            'organization' => $organization,
        ]);
    }

    public function update(Organization $organization, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=1/1',
                'name' => 'required|max:200',
                'description' => 'required',
                'start_period' => 'required|date',
                'is_end' => 'nullable',
                'end_period' => 'required_with:is_end|nullable|date'
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $organization) {
                $organization->slug = null;
                $organization->name = $request->name;
                $organization->start_period = $request->start_period;

                if ($request->is_end)
                    $organization->end_period = $request->end_period;

                $organization->description = $request->description;
                $organization->save();
            });

            if ($request->file('image')) {
                $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
                GeneralHelper::delete_image($organization->image);
                $request->file('image')->storeAs('organization-images', $filename, 'public');

                $organization->image = 'organization-images/' . $filename;
                $organization->save();
            }

            $organization = $organization->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('The organization was successfully updated.'));
            return to_route('dashboard.organization.show', $organization->slug);
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

    public function delete(Organization $organization)
    {
        try {
            GeneralHelper::delete_image($organization->image);
            $organization->delete();

            Alert::success(__('Successfully!'), __('The organization was successfully deleted.'));
            return to_route('dashboard.organization');
        } catch (Exception $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
