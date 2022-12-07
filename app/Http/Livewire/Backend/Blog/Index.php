<?php

namespace App\Http\Livewire\Backend\Blog;

use App\Models\Tag;
use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refresh_blog_data' => '$refresh',
        'filter_by_category',
        'filter_by_tag',
        'set_status_blog' => 'set_status'
    ];

    public function mount()
    {
        $this->status = 'all';
        $this->category_id = 'all';
        $this->tag_id = 'all';
        $this->categories = Category::get();
        $this->tags = Tag::get();
        $this->s = '';
    }

    public function render()
    {
        $blogs = Blog::with('category', 'tags')
            ->select('blogs.*')
            ->where('title', 'like', "%$this->s%")
            ->latest();

        $blog_all = $blogs->get();
        $blog_total = $blog_all->count();
        $blog_drafted = $blog_all->filter(function ($item) {
            return $item->status == 0;
        })->count();
        $blog_published = $blog_all->filter(function ($item) {
            return $item->status == 1;
        })->count();

        if ($this->category_id != 'all')
            $blogs = $blogs->where('category_id', $this->category_id);

        if ($this->tag_id != 'all')
            $blogs = $blogs->join('tag_details', 'blogs.id', '=', 'tag_details.blog_id')
                ->where('tag_details.tag_id', $this->tag_id);

        if ($this->status != 'all')
            $blogs = $blogs->where('status', $this->status);

        $blogs = $blogs->paginate(config('app.pagination_limit', 12));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.blog.index', [
            'blogs' => $blogs,
            'blog_total' => $blog_total,
            'blog_drafted' => $blog_drafted,
            'blog_published' => $blog_published
        ]);
    }

    public function filter_by_category($category_id)
    {
        $this->category_id = $category_id;
    }

    public function filter_by_tag($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function set_status($status)
    {
        $this->status = $status;
    }

    public function refresh_all()
    {
        $this->status = 'all';
        $this->category_id = 'all';
        $this->tag_id = 'all';
    }
}
