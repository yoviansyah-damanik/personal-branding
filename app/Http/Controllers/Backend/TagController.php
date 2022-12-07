<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function index()
    {
        return view('backend.pages.tag.index');
    }

    public function delete(Tag $tag)
    {
        if ($tag->blogs->count() > 0) {
            Alert::warning(__('Cannot delete data'), __("Cant remove the tag because the tag has multiple blogs."));
            return back();
        }

        $tag->delete();
        Alert::success(__('Successfully!'), __("Tag was successfully deleted."));
        return back();
    }
}
