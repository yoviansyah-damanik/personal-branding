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

    public function delete(Sector $sector)
    {
        if ($sector->companies->count() > 0) {
            Alert::warning(__('Cannot delete data'), __("Cant remove the sector because the sector has multiple blogs."));
            return back();
        }

        $sector->delete();
        Alert::success(__('Successfully!'), __("Sector was successfully deleted."));
        return back();
    }
}
