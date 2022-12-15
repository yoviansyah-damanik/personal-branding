<?php

namespace App\Http\Livewire\Backend\Project;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Project;
use Livewire\Component;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;

    protected $listeners = ['do_delete_item'];
    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.project.item');
    }

    public function publish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Project::whereId($this->project->id)
                    ->update(['status' => 1, 'published_at' => Carbon::now()]);
            });

            DB::commit();
            $this->emit('refresh_project_data');
            $this->alert(
                'success',
                'Successfully publish the project.'
            );
        } catch (Exception $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }

    public function unpublish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Project::whereId($this->project->id)
                    ->update(['status' => 0, 'published_at' => null]);
            });

            DB::commit();
            $this->emit('refresh_project_data');
            $this->alert(
                'success',
                'Successfully unpublish the project.'
            );
        } catch (Exception $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }

    public function delete_item()
    {
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the project?'),
                'timer' => 0,
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => __('Delete'),
                'showCancelButton' => true,
                'cancelButtonText' => __('Cancel'),
                'onConfirmed' => "do_delete_item",
                'allowOutsideClick' => false,
            ]
        );
    }

    public function do_delete_item()
    {
        try {
            Project::whereId($this->project->id)
                ->delete();
            GeneralHelper::delete_image($this->project->image);

            $this->emitUp('refresh_project_data');
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The project was successfully deleted.')]
            );
        } catch (Exception $e) {
            $this->alert(
                'warning',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            $this->alert(
                'warning',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }
}
