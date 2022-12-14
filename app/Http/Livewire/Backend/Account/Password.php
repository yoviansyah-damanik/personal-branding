<?php

namespace App\Http\Livewire\Backend\Account;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Password extends Component
{
    use LivewireAlert;

    public $old_password, $new_password, $confirmation_password;
    public function render()
    {
        return view('livewire.backend.account.password');
    }

    public function rules()
    {
        return [
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:8',
            'confirmation_password' => 'required|same:new_password'
        ];
    }

    public function validationAttributes()
    {
        return [
            'old_password' => __('Old Password'),
            'new_password' => __('New Password'),
            'confirmation_password' => __('Confirmation New Password'),
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function update_password()
    {
        $this->validate();

        try {
            $user = User::find(Auth::id());
            $user->password = bcrypt($this->new_password);
            $user->save();

            $this->reset();
            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('Your password has been updated.')]
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
