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
        'filter_by_sector',
        'set_status_project' => 'set_status'
    ];

    public function mount()
    {
        $this->status = 'all';
        $this->sector_id = 'all';
        $this->sectors = Sector::get();
        $this->s = '';
    }

    public function render()
    {
        $projects = Project::with('sectors')
            ->select('projects.*')
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

        if ($this->sector_id != 'all')
            $projects = $projects->join('sector_details', 'projects.id', '=', 'sector_details.project_id')
                ->where('sector_details.sector_id', $this->sector_id);

        $projects = $projects->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.project.index', [
            'projects' => $projects,
            'project_total' => $project_total,
            'project_drafted' => $project_drafted,
            'project_published' => $project_published
        ]);
    }

    public function filter_by_sector($sector_id)
    {
        $this->sector_id = $sector_id;
    }

    public function refresh_all()
    {
        $this->sector_id = 'all';
    }

    public function set_status($status)
    {
        $this->status = $status;
    }
}
