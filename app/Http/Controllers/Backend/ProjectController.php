<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Sector;
use App\Models\Project;
use App\Models\SectorDetail;
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
        $sectors = Sector::all();

        return view('backend.pages.project.create', [
            'sectors' => $sectors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:rasio=5/3',
                'title' => 'required|max:200',
                'body' => 'required',
                'sectors' => 'required|array',
                'sectors.*' => Rule::in(Sector::get()->pluck('id'))
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Project::class, 'slug', $request->title);
            DB::transaction(function () use ($request, $slug) {
                $filename = $request->file('image')->store('project-images', 'public');

                $project = Project::create([
                    'title' => $request->title,
                    'body' => $request->body,
                    'image' => $filename,
                    'slug' => $slug
                ]);

                if ($request->sectors)
                    foreach ($request->sectors as $sector) {
                        SectorDetail::create([
                            'project_id' => $project->id,
                            'sector_id' => $sector
                        ]);
                    }
            });

            DB::commit();
            Alert::success(__('Successfully!'), __('Project was successfully created.'));
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
        $sectors = Sector::all();

        return view('backend.pages.project.edit', [
            'project' => $project,
            'sectors' => $sectors,
        ]);
    }

    public function update(Project $project, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=5/3',
                'title' => 'required|max:200',
                'body' => 'required',
                'sectors' => 'required|array',
                'sectors.*' => Rule::in(Sector::get()->pluck('id'))
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $project) {
                if ($request->file('image')) {
                    GeneralHelper::delete_image($project->image);
                    $filename = $request->file('image')->store('project-images', 'public');
                    $project->image = $filename;
                }

                $project->slug = null;
                $project->title = $request->title;
                $project->body = $request->body;
                $project->save();

                if ($request->sectors) {
                    SectorDetail::where('project_id', $project->id)
                        ->delete();

                    foreach ($request->sectors as $sector) {
                        SectorDetail::create([
                            'project_id' => $project->id,
                            'sector_id' => $sector
                        ]);
                    }
                }
            });

            $project = $project->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('Project was successfully updated.'));
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

            Alert::success(__('Successfully!'), __('Project was successfully deleted.'));
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
