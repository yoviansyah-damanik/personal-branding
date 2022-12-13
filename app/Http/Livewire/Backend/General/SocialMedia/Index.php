<?php

namespace App\Http\Livewire\Backend\General\SocialMedia;

use Exception;
use Throwable;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SocialMediaAccount;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;
    public $deleted_id;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_social_media_data' => '$refresh', 'do_delete_social_media'];

    public function render()
    {
        $social_media = SocialMediaAccount::latest()
            ->paginate(config('app.pagination_limit', 25));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.general.social-media.index', compact('social_media'));
    }

    public function delete_social_media($id)
    {
        $this->deleted_id = $id;
        $this->alert(
            'warning',
            __('Confirmation!'),
            [
                'text' => __('Are you sure you want to delete the social media account?'),
                'timer' => 0,
                'toast' => false,
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => __('Delete'),
                'showCancelButton' => true,
                'cancelButtonText' => __('Cancel'),
                'onConfirmed' => "do_delete_social_media",
                'allowOutsideClick' => false,
            ]
        );
    }

    public function do_delete_social_media()
    {
        try {
            SocialMediaAccount::whereId($this->deleted_id)
                ->delete();

            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('Media social account successfully deleted.')]
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
