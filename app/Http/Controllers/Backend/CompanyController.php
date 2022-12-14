<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Sector;
use App\Models\Company;
use App\Models\SectorDetail;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CompanyController extends Controller
{
    public function index()
    {
        return view('backend.pages.company.index');
    }

    public function show(Company $company)
    {
        return view('backend.pages.company.show', ['company' => $company]);
    }

    public function create()
    {
        $sectors = Sector::all();

        return view('backend.pages.company.create', [
            'sectors' => $sectors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:',
                'name' => 'required|max:200',
                'as_known' => 'required|max:60',
                'description' => 'required',
                'url' => 'nullable|url',
                'sectors' => 'required|array',
                'sectors.*' => ['required', Rule::in(Sector::get()->pluck('id'))],
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Company::class, 'slug', $request->name);
            $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
            DB::transaction(function () use ($request, $slug, $filename) {
                $company = Company::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'as_known' => $request->as_known,
                    'url' => $request->url,
                    'image' => 'company-images/' . $filename,
                    'slug' => $slug
                ]);

                if ($request->sectors)
                    foreach ($request->sectors as $sector) {
                        SectorDetail::create([
                            'company_id' => $company->id,
                            'sector_id' => $sector
                        ]);
                    }
            });

            $request->file('image')->storeAs('company-images', $filename, 'public');

            DB::commit();
            Alert::success(__('Successfully!'), __('The company was successfully created.'));
            return to_route('dashboard.company.show', $slug);
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

    public function edit(Company $company)
    {
        $sectors = Sector::all();

        return view('backend.pages.company.edit', [
            'company' => $company,
            'sectors' => $sectors,
        ]);
    }

    public function update(Company $company, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=7/4',
                'name' => 'required|max:200',
                'as_known' => 'required|max:60',
                'description' => 'required',
                'url' => 'nullable|url',
                'sectors' => 'required|array',
                'sectors.*' => ['required', Rule::in(Sector::get()->pluck('id'))],
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $company) {
                $company->slug = null;
                $company->name = $request->name;
                $company->description = $request->description;
                $company->as_known = $request->as_known;
                $company->url = $request->url;
                $company->save();

                if ($request->sectors) {
                    SectorDetail::where('company_id', $company->id)
                        ->delete();

                    foreach ($request->sectors as $sector) {
                        SectorDetail::create([
                            'company_id' => $company->id,
                            'sector_id' => $sector
                        ]);
                    }
                }
            });

            if ($request->file('image')) {
                GeneralHelper::delete_image($company->image);

                $filename = GeneralHelper::generate_filename($request->name, $request->file('image'));
                $request->file('image')->storeAs('company-images', $filename, 'public');

                $company->image = 'company-images/' . $filename;
                $company->save();
            }

            $company = $company->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('The company was successfully updated.'));
            return to_route('dashboard.company.show', $company->slug);
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

    public function delete(Company $company)
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () use ($company) {
                $company->delete();
                SectorDetail::where('company_id', $company->id)
                    ->delete();
            });

            DB::commit();
            GeneralHelper::delete_image($company->image);
            Alert::success(__('Successfully!'), __('The company was successfully deleted.'));
            return to_route('dashboard.company');
        } catch (Exception $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
