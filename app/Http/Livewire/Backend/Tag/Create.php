<?php

namespace App\Http\Livewire\Backend\Tag;

use App\Helpers\GeneralHelper;
use Exception;
use Throwable;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public $name, $color;

    public function mount()
    {
        $this->color = GeneralHelper::generate_random_color();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.tag.create');
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

    public function store_tag()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Tag::create(
                    [
                        'name' => $this->name,
                        'color' => $this->color
                    ]
                );
            });
            DB::commit();
            $this->reset('name');
            $this->color = GeneralHelper::generate_random_color();
            $this->emit('refresh_tag_data');
            $this->alert(
                'success',
                __('Successfully!'),
                [
                    'text' => __('Tag was successfully created.')
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
}
