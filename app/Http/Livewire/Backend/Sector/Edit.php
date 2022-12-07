<?php

namespace App\Http\Livewire\Backend\Sector;

use Exception;
use Throwable;
use App\Models\Sector;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    protected $listeners = ['set_sector_edit'];
    public $sector_id, $name, $color, $isVisible;

    public function mount()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.backend.sector.edit');
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
            'name' => __('Sector Name'),
            'color' => __('Sector Color')
        ];
    }

    public function update_sector()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Sector::whereId($this->sector_id)->update(
                    [
                        'name' => $this->name,
                        'color' => $this->color,
                        'slug' => null,
                    ]
                );
            });

            DB::commit();
            $this->reset();
            $this->isVisible = false;
            $this->emit('refresh_sector_data');
            $this->alert(
                'success',
                __('Successfully!'),
                [
                    'text' => __('Sector was successfully updated.')
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

    public function set_sector_edit($sector)
    {
        if (!$sector)
            $this->alert(
                'warning',
                'Ooopppsss',
                ['text' => __('Something went wrong!')]
            );

        $this->sector_id = $sector['id'];
        $this->name = $sector['name'];
        $this->color = $sector['color'];
        $this->isVisible = true;
    }
}
