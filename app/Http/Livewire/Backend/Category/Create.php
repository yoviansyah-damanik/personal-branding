<?php

namespace App\Http\Livewire\Backend\Category;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public $name;

    public function render()
    {
        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.category.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|max:20',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('Category Name'),
        ];
    }

    public function store_category()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Category::create(
                    [
                        'name' => $this->name,
                    ]
                );
            });
            DB::commit();
            $this->reset('name');
            $this->emit('refresh_category_data');
            $this->alert(
                'success',
                __('Successfully!'),
                [
                    'text' => __('Category was successfully created.')
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
