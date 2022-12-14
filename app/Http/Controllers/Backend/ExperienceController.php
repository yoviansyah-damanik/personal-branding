<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Validation\Rule;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('backend.pages.experience.index');
    }

    public function show(Experience $experience)
    {
        return view('backend.pages.experience.show', ['experience' => $experience]);
    }

    public function create()
    {
        return view('backend.pages.experience.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:200',
                'description' => 'required',
                'position' => 'required|max:50',
                'start_period' => 'required|date',
                'is_end' => 'nullable',
                'end_period' => 'required_with:is_end|nullable|date'
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Experience::class, 'slug', $request->name);
            DB::transaction(function () use ($request, $slug) {
                $new_experience = new Experience;
                $new_experience->name = $request->name;
                $new_experience->position = $request->position;
                $new_experience->start_period = $request->start_period;

                if ($request->is_end)
                    $new_experience->end_period = $request->end_period;

                $new_experience->description = $request->description;
                $new_experience->slug = $slug;
                $new_experience->save();
            });

            DB::commit();
            Alert::success(__('Successfully!'), __('The experience was successfully created.'));
            return to_route('dashboard.experience.show', $slug);
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

    public function edit(Experience $experience)
    {
        return view('backend.pages.experience.edit', [
            'experience' => $experience
        ]);
    }

    public function update(Experience $experience, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:200',
                'description' => 'required',
                'position' => 'required|max:50',
                'start_period' => 'required|date',
                'is_end' => 'nullable',
                'end_period' => 'required_with:is_end|nullable|date'
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $experience) {
                $experience->slug = null;
                $experience->name = $request->name;
                $experience->position = $request->position;
                $experience->start_period = $request->start_period;

                if ($request->is_end)
                    $experience->end_period = $request->end_period;

                $experience->description = $request->description;
                $experience->save();
            });

            DB::commit();
            Alert::success(__('Successfully!'), __('The experience was successfully updated.'));
            return to_route('dashboard.experience.show', $experience->slug);
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

    public function delete(Experience $experience)
    {
        try {
            $experience->delete();

            Alert::success(__('Successfully!'), __('The experience was successfully deleted.'));
            return to_route('dashboard.experience');
        } catch (Exception $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
