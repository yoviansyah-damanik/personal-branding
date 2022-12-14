<?php

namespace App\Http\Livewire\Backend\Sector;

use Exception;
use Throwable;
use App\Models\Sector;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_sector_data' => '$refresh', 'do_delete_item'];

    public $deleted_id;
    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $sectors = Sector::withCount('companies')
            ->where('name', 'like', "%$this->s%")
            ->orderBy('companies_count', 'desc')
            ->latest()
            ->paginate(config('app.pagination_limit', 25));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.sector.index', compact('sectors'));
    }

    public function edit_sector($sector_id)
    {
        $sector = Sector::whereId($sector_id)
            ->first();

        $this->emit('set_sector_edit', $sector);
    }

    public function delete_item($id)
    {
        $this->deleted_id = $id;
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the sector?'),
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
            $sector = Sector::find($this->deleted_id);

            if ($sector->companies->count() > 0)
                return $this->alert(
                    'warning',
                    __("Can't delete data"),
                    ['text' => __("Can't remove the sector because the sector has multiple companies.")]
                );

            $sector->delete();

            $this->deleted_id = null;
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The sector was successfully deleted.')]
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
