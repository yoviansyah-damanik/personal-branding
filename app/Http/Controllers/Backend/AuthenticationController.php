<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticationController extends Controller
{
    public function index()
    {
        return view('backend.pages.auth.auth-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($fieldType, $request->username)
            ->first();

        if (!empty($user) && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            $request->session()->regenerate();
            $user->update(['last_login' => Carbon::now()]);
            return redirect()->intended('/dashboard');
        }

        Alert::warning(__('Ooopppss!'), __('Unknown authentication.'));
        return to_route('login')->withInput();
    }

    public function logout()
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return to_route('login');
    }
}
