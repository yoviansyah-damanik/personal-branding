<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProjectController extends Controller
{
    public function index()
    {
        return view('backend.pages.project.index');
    }

    public function show(Project $project)
    {
        return view('backend.pages.project.show', ['project' => $project]);
    }

    public function create()
    {
        $companies = Company::all();
        return view('backend.pages.project.create', [
            'companies' => $companies
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:rasio=7/4',
                'title' => 'required|max:200',
                'description' => 'required',
                'url' => 'nullable|url',
                'company' => [
                    'required',
                    Rule::in(Company::get()->pluck('id'))
                ]
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Project::class, 'slug', $request->title);
            DB::transaction(function () use ($request, $slug) {
                $filename = $request->file('image')->store('project-images', 'public');

                Project::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'company_id' => $request->company,
                    'image' => $filename,
                    'url' => $request->url,
                    'slug' => $slug
                ]);
            });

            DB::commit();
            Alert::success(__('Successfully!'), __('The project was successfully created.'));
            return to_route('dashboard.project.show', $slug);
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

    public function edit(Project $project)
    {
        $companies = Company::all();

        return view('backend.pages.project.edit', [
            'project' => $project,
            'companies' => $companies
        ]);
    }

    public function update(Project $project, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=7/4',
                'title' => 'required|max:200',
                'description' => 'required',
                'url' => 'nullable|url',
                'company' => [
                    'required',
                    Rule::in(Company::get()->pluck('id'))
                ]
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $project) {


                $project->slug = null;
                $project->title = $request->title;
                $project->description = $request->description;
                $project->company_id = $request->company;
                $project->url = $request->url;
                $project->save();
            });

            if ($request->file('image')) {
                GeneralHelper::delete_image($project->image);
                $filename = $request->file('image')->store('project-images', 'public');
                $project->image = $filename;
                $project->save();
            }

            $project = $project->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('The project was successfully updated.'));
            return to_route('dashboard.project.show', $project->slug);
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

    public function delete(Project $project)
    {
        try {
            GeneralHelper::delete_image($project->image);
            $project->delete();

            Alert::success(__('Successfully!'), __('The project was successfully deleted.'));
            return to_route('dashboard.project');
        } catch (Exception $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
