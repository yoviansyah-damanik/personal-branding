<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('backend.pages.account.index');
    }

    public function information()
    {
        return view('backend.pages.account.information');
    }

    public function password()
    {
        return view('backend.pages.account.password');
    }
}
