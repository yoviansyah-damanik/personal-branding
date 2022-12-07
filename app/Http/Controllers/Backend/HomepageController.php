<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\User;
use App\Models\History;
use App\Models\Project;
use App\Models\Visitor;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index()
    {
        $user_count = User::count();
        $blog_draft_count = Blog::draft()->count();
        $blog_publish_count = Blog::publish()->count();
        $tag_count = Tag::count();
        $experience_count = Experience::count();
        $project_count = Project::count();
        $visitor_count = Visitor::human()->count();
        $history_count = History::count();
        $category_count = Category::count();

        return view('backend.pages.index', [
            'user_count' => $user_count,
            'blog_draft_count' => $blog_draft_count,
            'blog_publish_count' => $blog_publish_count,
            'tag_count' => $tag_count,
            'experience_count' => $experience_count,
            'project_count' => $project_count,
            'visitor_count' => $visitor_count,
            'history_count' => $history_count,
            'category_count' => $category_count
        ]);
    }
}
