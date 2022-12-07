@extends('backend.layouts.app')

@section('title', $blog->title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Blogs') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.blog') }}">{{ __('Blogs') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $blog->title }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ $blog->title }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-3">
                                <img src="{{ $blog->image_path }}" alt="{{ $blog->title }} Image">
                                <div class="text-center my-3">
                                    <form class="d-inline" action="{{ route('dashboard.blog.delete', $blog->slug) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button id="delete-blog" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('dashboard.blog.edit', $blog->slug) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="content">
                                    <div class="title">{{ $blog->title }}</div>
                                    <div class="subtitle">
                                        <div class="category">
                                            <i class="fas fa-shapes"></i>
                                            {{ $blog->category->name }}
                                        </div>
                                        |
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $blog->created_at->diffForHumans() }}
                                        </div>
                                        |
                                        <div class="time">
                                            @if ($blog->published_at)
                                                {{ __('Published at') }}
                                                {{ Carbon::parse($blog->published_at)->diffForHumans() }}
                                            @else
                                                {{ __('Not yet published.') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tags">
                                        @foreach ($blog->tags as $tag)
                                            <div class="tag-item" style="background: {{ $tag->color }}">
                                                {{ $tag->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="body">
                                        {!! $blog->body !!}
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#delete-blog').on('click', (e) => {
            e.preventDefault()

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: `{{ __('Are you sure?') }}`,
                text: `{{ __('You wont be able to revert this!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `{{ __('Yes, delete it!') }}`,
                cancelButtonText: `{{ __('No, cancel!') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        `{{ __('Wait!') }}`,
                        `{{ __('The process is in progress.') }}`,
                        'success'
                    )
                    e.target.closest('form').submit()
                }
            })
        })
    </script>
@endpush
