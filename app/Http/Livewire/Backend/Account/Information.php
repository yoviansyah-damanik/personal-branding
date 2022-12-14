<?php

namespace App\Http\Livewire\Backend\Account;

use Exception;
use Throwable;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Information extends Component
{
    use LivewireAlert;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
    }

    public function render()
    {
        return view('livewire.backend.account.information');
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'username' => 'required|max:24|unique:users,username,' . Auth::id(),
            'email' => 'required|email:dns|unique:users,email,' . Auth::id(),
        ];
    }

    public function validationAttribute()
    {
        return [
            'name' => __('Account Name'),
            'username' => __('Username'),
            'email' => __('Email')
        ];
    }

    public function updated($attribute)
    {
        if ($attribute == 'username')
            $this->username = Str::lower($this->username);

        $this->validateOnly($attribute);
    }

    public function update_information_account()
    {
        $this->validate();

        try {
            $user = User::find(Auth::id());
            $user->name = $this->name;
            $user->email = $this->email;
            $user->username = $this->username;
            $user->save();

            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('Your information account has been updated.')]
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
