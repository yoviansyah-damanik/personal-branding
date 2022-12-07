<?php

namespace App\Http\Livewire\Backend\Blog;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Blog;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;

    public function mount($blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        return view('livewire.backend.blog.item');
    }

    public function publish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Blog::whereId($this->blog->id)
                    ->update(['status' => 1, 'published_at' => Carbon::now()]);
            });

            DB::commit();
            $this->emit('refresh_blog_data');
            $this->alert(
                'success',
                'Successfully publish the blog.'
            );
        } catch (Exception $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }

    public function unpublish()
    {
        DB::beginTransaction();
        try {
            DB::transaction(function () {
                Blog::whereId($this->blog->id)
                    ->update(['status' => 0, 'published_at' => null]);
            });

            DB::commit();
            $this->emit('refresh_blog_data');
            $this->alert(
                'success',
                'Successfully unpublish the blog.'
            );
        } catch (Exception $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            DB::rollback();
            $this->alert(
                'danger',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }
}
