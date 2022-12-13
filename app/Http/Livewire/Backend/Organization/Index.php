<?php

namespace App\Http\Livewire\Backend\Organization;

use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_organization_data' => '$refresh',
        'set_status_organization' => 'set_status'
    ];

    public function mount()
    {
        $this->s = '';
        $this->status = 'all';
    }

    public function render()
    {
        $organizations = Organization::where('name', 'like', "%$this->s%")
            ->latest();

        $organization_all = $organizations->get();
        $organization_total = $organization_all->count();
        $organization_drafted = $organization_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $organization_published = $organization_all->filter(function ($item) {
            return $item->status == 1;
        })->count();

        if ($this->status != 'all')
            if ($this->status == 'published')
                $organizations = $organizations->published();
            else
                $organizations = $organizations->drafted();


        $organizations = $organizations->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.organization.index', [
            'organizations' => $organizations,
            'organization_total' => $organization_total,
            'organization_drafted' => $organization_drafted,
            'organization_published' => $organization_published,
        ]);
    }

    public function refresh_all()
    {
        $this->status = 'all';
        $this->s = '';
    }

    public function set_status($status)
    {
        $this->status = $status;
    }
}
