<?php

namespace App\Http\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_category_data' => '$refresh'];

    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $categories = Category::withCount('blogs')
            ->where('name', 'like', "%$this->s%")
            ->orderBy('blogs_count', 'desc')
            ->latest()
            ->paginate(config('app.pagination_limit', 25));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.category.index', compact('categories'));
    }

    public function edit_category($category_id)
    {
        $category = Category::whereId($category_id)
            ->first();

        $this->emit('set_category_edit', $category);
    }
}
