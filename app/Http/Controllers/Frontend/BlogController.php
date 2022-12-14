<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('frontend.pages.blog.index', [
            'blogs' => $blogs,
            '_title' => __('Blogs'),
            '_description' => __('You can find various interesting blogs about me here.'),
        ]);
    }

    public function show(Blog $blog)
    {
        if ($blog->status != 1)
            return to_route('blog');

        $random_blog = Blog::inRandomOrder()
            ->whereNot('id', $blog->id)
            ->limit(3)
            ->get();

        return view('frontend.pages.blog.show', [
            'blog' => $blog,
            'random_blog' => $random_blog,
            '_title' => $blog->title,
            '_description' => $blog->excerpt,
            '_image' => $blog->image_path
        ]);
    }
}
