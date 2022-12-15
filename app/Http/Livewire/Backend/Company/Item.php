<?php

namespace App\Http\Livewire\Backend\Company;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Company;
use Livewire\Component;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;

    protected $listeners = ['do_delete_item'];
    public function mount($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.company.item');
    }

    public function publish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Company::whereId($this->company->id)
                    ->update(['status' => 1, 'published_at' => Carbon::now()]);
            });

            DB::commit();
            $this->emit('refresh_company_data');
            $this->alert(
                'success',
                'Successfully publish the company.'
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
                Company::whereId($this->company->id)
                    ->update(['status' => 0, 'published_at' => null]);
            });

            DB::commit();
            $this->emit('refresh_company_data');
            $this->alert(
                'success',
                'Successfully unpublish the company.'
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
                'text' => __('Are you sure you want to delete the company?'),
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
            Company::whereId($this->company->id)
                ->delete();
            GeneralHelper::delete_image($this->company->image);

            $this->emitUp('refresh_company_data');
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The company was successfully deleted.')]
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
