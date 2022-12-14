<?php

namespace App\Http\Livewire\Backend\Category;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_category_edit'];
    public $category_id, $name, $isVisible;

    public function mount()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.backend.category.edit');
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

    public function update_category()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Category::whereId($this->category_id)->update(
                    [
                        'name' => $this->name,
                        'slug' => null,
                    ]
                );
            });

            DB::commit();
            $this->reset();
            $this->isVisible = false;
            $this->emit('refresh_category_data');
            $this->alert(
                'success',
                __('Successfully!'),
                [
                    'text' => __('The category was successfully updated.')
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

    public function set_category_edit($category)
    {
        if (!$category)
            $this->alert(
                'warning',
                'Ooopppsss',
                ['text' => __('Something went wrong!')]
            );

        $this->category_id = $category['id'];
        $this->name = $category['name'];
        $this->isVisible = true;
    }
}
