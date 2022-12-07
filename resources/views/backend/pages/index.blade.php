@extends('backend.layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend-assets/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            {{-- COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total User') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $user_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Blog Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $blog_draft_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Blog Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $blog_publish_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Projects') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $project_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Experience') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $experience_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Tags') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $tag_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Visitors') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $visitor_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Histories') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $history_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Categories') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $category_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Activities</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('backend-assets/img/avatar/avatar-1.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="text-primary float-right">Now</div>
                                        <div class="media-title">Farhan A Mujib</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla.
                                            Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('backend-assets/img/avatar/avatar-2.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">12m</div>
                                        <div class="media-title">Ujang Maman</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla.
                                            Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('backend-assets/img/avatar/avatar-3.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">17m</div>
                                        <div class="media-title">Rizal Fakhri</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla.
                                            Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('backend-assets/img/avatar/avatar-4.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right">21m</div>
                                        <div class="media-title">Alfa Zulkarnain</div>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla.
                                            Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                            </ul>
                            <div class="pt-1 pb-1 text-center">
                                <a href="#" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Authors</h4>
                        </div>
                        <div class="card-body">
                            <div class="row pb-2">
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image" src="{{ asset('backend-assets/img/avatar/avatar-5.png') }}"
                                            class="img-fluid" data-toggle="tooltip" title="Alfa Zulkarnain">
                                        <div class="avatar-badge" title="Editor" data-toggle="tooltip"><i
                                                class="fas fa-wrench"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image" src="{{ asset('backend-assets/img/avatar/avatar-4.png') }}"
                                            class="img-fluid" data-toggle="tooltip" title="Egi Ferdian">
                                        <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i
                                                class="fas fa-cog"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image" src="{{ asset('backend-assets/img/avatar/avatar-1.png') }}"
                                            class="img-fluid" data-toggle="tooltip" title="Jaka Ramadhan">
                                        <div class="avatar-badge" title="Author" data-toggle="tooltip"><i
                                                class="fas fa-pencil-alt"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image" src="{{ asset('backend-assets/img/avatar/avatar-2.png') }}"
                                            class="img-fluid" data-toggle="tooltip" title="Ryan">
                                        <div class="avatar-badge" title="Admin" data-toggle="tooltip"><i
                                                class="fas fa-cog"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Latest Posts') }}</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary">{{ __('View All') }}</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Excerpt') }}</th>
                                            <th>{{ __('Author') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Introduction Laravel 5
                                                <div class="table-links">
                                                    in
                                                    <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                </div>
                                            </td>
                                            <td>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad reiciendis eius
                                                quis aliquam necessitatibus amet quo, voluptatum non incidunt. Officiis!
                                            </td>
                                            <td>
                                                <a href="#" class="font-weight-600"><img
                                                        src="{{ asset('backend-assets/img/avatar/avatar-1.png') }}"
                                                        alt="avatar" width="30" class="rounded-circle mr-1"> Bagus
                                                    Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                    title="{{ __('View') }}"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('backend-assets/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('backend-assets/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend-assets/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('backend-assets/js/page/index-0.js') }}"></script>
@endpush
