<?php

namespace App\Http\Livewire\Backend\Social;

use App\Models\Social;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_social_data' => '$refresh',
        'set_status_social' => 'set_status'
    ];

    public function mount()
    {
        $this->s = '';
        $this->status = 'all';
    }

    public function render()
    {
        $socials = Social::where('name', 'like', "%$this->s%")
            ->latest();

        $social_all = $socials->get();
        $social_total = $social_all->count();
        $social_drafted = $social_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $social_published = $social_all->filter(function ($item) {
            return $item->status == 1;
        })->count();

        if ($this->status != 'all')
            if ($this->status == 'published')
                $socials = $socials->published();
            else
                $socials = $socials->drafted();


        $socials = $socials->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.social.index', [
            'socials' => $socials,
            'social_total' => $social_total,
            'social_drafted' => $social_drafted,
            'social_published' => $social_published,
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
