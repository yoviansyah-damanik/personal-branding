<?php

namespace App\Http\Livewire\Backend\Category;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_category_data' => '$refresh', 'do_delete_item'];

    public $deleted_id;
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

    public function delete_item($id)
    {
        $this->deleted_id = $id;
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the category?'),
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
            $category = Category::find($this->deleted_id);

            if ($category->blogs->count() > 0)
                return $this->alert(
                    'warning',
                    __("Can't delete data"),
                    ['text' => __("Can't remove the category because the category has multiple blogs.")]
                );

            $category->delete();

            $this->deleted_id = null;
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The category was successfully deleted.')]
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
