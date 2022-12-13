<?php

namespace App\Http\Livewire\Backend\Company;

use App\Models\Sector;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_company_data' => '$refresh',
        'filter_by_sector',
        'set_status_company' => 'set_status'
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
        $companies = Company::with('sectors')
            ->select('companies.*')
            ->where('name', 'like', "%$this->s%")
            ->latest();

        $company_all = $companies->get();
        $company_total = $company_all->count();
        $company_drafted = $company_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $company_published = $company_all->filter(function ($item) {
            return $item->status == 1;
        })->count();
        if ($this->sector_id != 'all')
            $companies = $companies->join('sector_details', 'companies.id', '=', 'sector_details.company_id')
                ->where('sector_details.sector_id', $this->sector_id);

        if ($this->status != 'all')
            if ($this->status == 'published')
                $companies = $companies->published();
            else
                $companies = $companies->drafted();

        $companies = $companies->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.company.index', [
            'companies' => $companies,
            'company_total' => $company_total,
            'company_drafted' => $company_drafted,
            'company_published' => $company_published,
        ]);
    }

    public function filter_by_sector($sector_id)
    {
        $this->sector_id = $sector_id;
    }

    public function refresh_all()
    {
        $this->sector_id = 'all';
        $this->status = 'all';
        $this->s = '';
    }

    public function set_status($status)
    {
        $this->status = $status;
    }
}
