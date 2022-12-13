<?php

namespace App\Http\Livewire\Backend\Experience;

use Livewire\Component;
use App\Models\Experience;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_experience_data' => '$refresh',
        'set_status_experience' => 'set_status'
    ];

    public function mount()
    {
        $this->status = 'all';
        $this->s = '';
    }

    public function render()
    {
        $experiences = Experience::where('name', 'like', "%$this->s%")
            ->latest();

        $experience_all = $experiences->get();
        $experience_total = $experience_all->count();
        $experience_drafted = $experience_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $experience_published = $experience_all->filter(function ($item) {
            return $item->status == 1;
        })->count();

        if ($this->status != 'all')
            if ($this->status == 'published')
                $experiences = $experiences->published();
            else
                $experiences = $experiences->drafted();

        $experiences = $experiences->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.experience.index', [
            'experiences' => $experiences,
            'experience_total' => $experience_total,
            'experience_drafted' => $experience_drafted,
            'experience_published' => $experience_published
        ]);
    }

    public function set_status($status)
    {
        $this->status = $status;
    }

    public function refresh_all()
    {
        $this->status = 'all';
        $this->s = '';
    }
}
