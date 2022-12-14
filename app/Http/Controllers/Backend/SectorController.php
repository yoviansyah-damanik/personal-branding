<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class SectorController extends Controller
{
    public function index()
    {
        return view('backend.pages.sector.index');
    }
}
