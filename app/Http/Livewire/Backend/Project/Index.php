<?php

namespace App\Http\Livewire\Backend\Project;

use App\Models\Sector;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_project_data' => '$refresh',
        'set_status_project' => 'set_status'
    ];

    public function mount()
    {
        $this->status = 'all';
        $this->s = '';
    }

    public function render()
    {
        $projects = Project::with('company')
            ->where('title', 'like', "%$this->s%")
            ->latest();

        $project_all = $projects->get();
        $project_total = $project_all->count();
        $project_drafted = $project_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $project_published = $project_all->filter(function ($item) {
            return $item->status == 1;
        })->count();

        if ($this->status != 'all')
            $projects = $projects->where('status', $this->status);

        $projects = $projects->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.project.index', [
            'projects' => $projects,
            'project_total' => $project_total,
            'project_drafted' => $project_drafted,
            'project_published' => $project_published
        ]);
    }

    public function set_status($status)
    {
        $this->status = $status;
    }

    public function refresh_all()
    {
        $this->s = '';
        $this->status = 'all';
    }
}
