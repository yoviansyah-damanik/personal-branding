<?php

namespace App\Http\Livewire\Backend\Tag;

use Exception;
use Throwable;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_tag_edit'];
    public $tag_id, $name, $color, $isVisible;

    public function mount()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.tag.edit');
    }

    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'color' => 'required'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('Tag Name'),
            'color' => __('Tag Color')
        ];
    }

    public function update_tag()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Tag::whereId($this->tag_id)->update(
                    [
                        'name' => $this->name,
                        'slug' => null,
                        'color' => $this->color
                    ]
                );
            });

            DB::commit();
            $this->reset();
            $this->isVisible = false;
            $this->emit('refresh_tag_data');
            $this->alert(
                'success',
                __('Successfully!'),
                [
                    'text' => __('The tag was successfully updated.')
                ]
            );
        } catch (Exception $e) {
            DB::rollback();
            $this->alert(
                'info',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            $this->alert(
                'info',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }

    public function set_tag_edit($tag)
    {
        if (!$tag)
            $this->alert(
                'warning',
                'Ooopppsss',
                ['text' => __('Something went wrong!')]
            );

        $this->tag_id = $tag['id'];
        $this->name = $tag['name'];
        $this->color = $tag['color'];
        $this->isVisible = true;
    }
}
