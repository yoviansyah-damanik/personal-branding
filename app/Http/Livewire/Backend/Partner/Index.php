<?php

namespace App\Http\Livewire\Backend\Partner;

use Exception;
use Throwable;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $listeners = ['refresh_partner_data' => '$refresh', 'do_delete_item'];

    public $deleted_id;
    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $partners = Partner::where('name', 'like', "%$this->s%")
            ->latest()
            ->paginate(config('app.pagination_limit', 25));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.partner.index', [
            'partners' => $partners
        ]);
    }

    public function delete_item($id)
    {
        $this->deleted_id = $id;
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the partner?'),
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
            $partner = partner::find($this->deleted_id);

            GeneralHelper::delete_image($partner->image);
            $partner->delete();

            $this->deleted_id = null;
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The partner was successfully deleted.')]
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
