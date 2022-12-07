<?php

namespace App\Http\Livewire\Backend\Sector;

use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_sector_data' => '$refresh'];

    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $sectors = Sector::withCount('projects')
            ->where('name', 'like', "%$this->s%")
            ->orderBy('projects_count', 'desc')
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
}
