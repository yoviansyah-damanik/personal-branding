<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Throwable;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use App\Models\TagDetail;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{
    public function index()
    {
        return view('backend.pages.blog.index');
    }

    public function show(Blog $blog)
    {
        return view('backend.pages.blog.show', ['blog' => $blog]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.pages.blog.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|dimensions:rasio=7/4',
                'title' => 'required|max:200',
                'body' => 'required',
                'tags' => 'nullable|array',
                'tags.*' => Rule::in(Tag::get()->pluck('id')),
                'category' => [
                    'required',
                    Rule::in(Category::get()->pluck('id'))
                ]
            ]
        );

        DB::beginTransaction();
        try {
            $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
            DB::transaction(function () use ($request, $slug) {
                $filename = $request->file('image')->store('blog-images', 'public');

                $blog = Blog::create([
                    'title' => $request->title,
                    'body' => $request->body,
                    'category_id' => $request->category,
                    'image' => $filename,
                    'slug' => $slug
                ]);

                if ($request->tags)
                    foreach ($request->tags as $tag) {
                        TagDetail::create([
                            'blog_id' => $blog->id,
                            'tag_id' => $tag
                        ]);
                    }
            });

            DB::commit();
            Alert::success(__('Successfully!'), __('Blog was successfully created.'));
            return to_route('dashboard.blog.show', $slug);
        } catch (Exception $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        } catch (Throwable $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.pages.blog.edit', [
            'blog' => $blog,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(Blog $blog, Request $request)
    {
        $request->validate(
            [
                'image' => 'nullable|image|dimensions:rasio=7/4',
                'title' => 'required|max:200',
                'body' => 'required',
                'tags' => 'nullable|array',
                'tags.*' => Rule::in(Tag::get()->pluck('id')),
                'category' => [
                    'required',
                    Rule::in(Category::get()->pluck('id'))
                ]
            ]
        );

        DB::beginTransaction();
        try {
            DB::transaction(function () use ($request, $blog) {
                if ($request->file('image')) {
                    GeneralHelper::delete_image($blog->image);
                    $filename = $request->file('image')->store('blog-images', 'public');
                    $blog->image = $filename;
                }

                $blog->slug = null;
                $blog->title = $request->title;
                $blog->body = $request->body;
                $blog->category_id = $request->category;
                $blog->save();

                if ($request->tags) {
                    TagDetail::where('blog_id', $blog->id)
                        ->delete();

                    foreach ($request->tags as $tag) {
                        TagDetail::create([
                            'blog_id' => $blog->id,
                            'tag_id' => $tag
                        ]);
                    }
                }
            });

            $blog = $blog->refresh();
            DB::commit();
            Alert::success(__('Successfully!'), __('Blog was successfully updated.'));
            return to_route('dashboard.blog.show', $blog->slug);
        } catch (Exception $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        } catch (Throwable $e) {
            DB::rollback();
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back()->withInput();
        }
    }

    public function delete(Blog $blog)
    {
        try {
            GeneralHelper::delete_image($blog->image);
            $blog->delete();

            Alert::success(__('Successfully!'), __('Blog was successfully deleted.'));
            return to_route('dashboard.blog');
        } catch (Exception $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        } catch (Throwable $e) {
            Alert::info(__('Something went wrong!'), $e->getMessage());
            return back();
        }
    }
}
