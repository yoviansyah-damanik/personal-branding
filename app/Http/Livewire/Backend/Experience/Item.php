<?php

namespace App\Http\Livewire\Backend\Experience;

use Exception;
use Throwable;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;
    protected $listeners = ['do_delete_item'];

    public function mount($experience)
    {
        $this->experience = $experience;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.experience.item');
    }

    public function publish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Experience::whereId($this->experience->id)
                    ->update(['status' => 1, 'published_at' => Carbon::now()]);
            });

            DB::commit();
            $this->emit('refresh_experience_data');
            $this->alert(
                'success',
                'Successfully publish the experience.'
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
                Experience::whereId($this->experience->id)
                    ->update(['status' => 0, 'published_at' => null]);
            });

            DB::commit();
            $this->emit('refresh_experience_data');
            $this->alert(
                'success',
                'Successfully unpublish the experience.'
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
                'text' => __('Are you sure you want to delete the experience?'),
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
            Experience::whereId($this->experience->id)
                ->delete();

            $this->emitUp('refresh_experience_data');
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The experience was successfully deleted.')]
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
