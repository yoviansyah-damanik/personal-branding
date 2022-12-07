<?php

namespace App\Http\Livewire\Backend\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_tag_data' => '$refresh'];

    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $tags = Tag::withCount('blogs')
            ->where('name', 'like', "%$this->s%")
            ->orderBy('blogs_count', 'desc')
            ->latest()
            ->paginate(config('app.pagination_limit', 25));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.tag.index', compact('tags'));
    }

    public function edit_tag($tag_id)
    {
        $tag = Tag::whereId($tag_id)
            ->first();

        $this->emit('set_tag_edit', $tag);
    }
}
