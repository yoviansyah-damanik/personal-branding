<?php

namespace App\Http\Livewire\Backend\General\SocialMedia;

use Exception;
use Throwable;
use Livewire\Component;
use App\Helpers\GeneralHelper;
use App\Models\SocialMediaIcon;
use Illuminate\Validation\Rule;
use App\Models\SocialMediaAccount;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public $types, $name, $social_media_icon_id, $url;

    public function mount()
    {
        $this->types = SocialMediaIcon::get();
        $this->social_media_icon_id = $this->types->first()->id;
    }

    public function render()
    {
        $this->types = SocialMediaIcon::get();

        $this->dispatchBrowserEvent('tooltipReset');
        $this->dispatchBrowserEvent('selectricReset');
        return view('livewire.backend.general.social-media.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'social_media_icon_id' => [
                'required',
                Rule::in($this->types->pluck('id')->toArray())
            ],
            'url' => 'required|url',
        ];
    }

    public function validationAttributes()
    {
        return [
            'social_media_icon_id' => __('Type'),
            'name' => __('Account Name')
        ];
    }

    public function store_social_media()
    {
        $this->validate();

        try {
            SocialMediaAccount::create(
                [
                    'name' => $this->name,
                    'social_media_icon_id' => $this->social_media_icon_id,
                    'url' => $this->url
                ]
            );

            $this->reset();
            $this->emit('refresh_social_media_data');
            $this->type = 'facebook';
            $this->alert(
                'success',
                'Successfully!',
                ['text' => 'The Social Media successfully created.']
            );
        } catch (Exception $e) {
            $this->alert(
                'warning',
                'Something went wrong!',
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            $this->alert(
                'warning',
                'Something went wrong!',
                ['text' => $e->getMessage()]
            );
        }
    }
}
