<?php

namespace App\Http\Livewire\Backend\Tag;

use Exception;
use Throwable;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_tag_data' => '$refresh', 'do_delete_item'];

    public $deleted_id;
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

    public function delete_item($id)
    {
        $this->deleted_id = $id;
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the tag?'),
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
            Tag::whereId($this->deleted_id)
                ->delete();

            $this->deleted_id = null;
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The tag was successfully deleted.')]
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
