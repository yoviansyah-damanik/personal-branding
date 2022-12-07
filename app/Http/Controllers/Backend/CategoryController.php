<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.pages.category.index');
    }

    public function delete(Category $category)
    {
        if ($category->blogs->count() > 0) {
            Alert::warning(__('Cannot delete data'), __("Cant remove the category because the category has multiple blogs."));
            return back();
        }

        $category->delete();
        Alert::success(__('Successfully!'), __("Category was successfully deleted."));
        return back();
    }
}
