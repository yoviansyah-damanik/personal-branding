<?php

namespace App\Http\Livewire\Backend\Partner;

use Exception;
use Throwable;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\GeneralHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public $image, $name;

    public function render()
    {
        return view('livewire.backend.partner.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'image' => 'required|image',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('Partner Name'),
            'image' => __('Image')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store_partner()
    {
        $this->validate();

        try {
            $filename = GeneralHelper::generate_filename($this->name, $this->image);
            $this->image->storeAs('partner-images', $filename, 'public');

            Partner::create([
                'name' => $this->name,
                'image' => 'partner-images/' . $filename
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('resetPreview');
            $this->emit('refresh_partner_data');
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('The partner was successfully created.')]
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
