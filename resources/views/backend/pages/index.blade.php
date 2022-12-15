@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
            </div>
            {{-- GENERAL COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('User Total') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $user_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shapes"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Category Total') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $category_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Tag Total') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $tag_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Sector Total') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $sector_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Partner Total') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $partner_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- BLOG COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Blogs') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $blog_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Blog Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $blog_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Blog Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $blog_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- COMPANY COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-building-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Companies') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $company_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-building-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Company Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $company_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-building-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Company Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $company_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- PROJECT COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-briefcase"></i>
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
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Project Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $project_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Project Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $project_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- EXPERIENCE COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-person-walking-luggage"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Experiences') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $experience_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-person-walking-luggage"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Experience Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $experience_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-person-walking-luggage"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Experience Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $experience_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ORGANIZATION COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users-rays"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Organizations') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $organization_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-users-rays"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Organization Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $organization_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-users-rays"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Organization Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $organization_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SOCIAL COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-people-carry-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Socials') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $social_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-people-carry-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Social Drafted') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $social_drafted_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-people-carry-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Social Published') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $social_published_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTACT COUNTER --}}
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Contacts') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $contact_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Contact Read') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $contact_read_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Contact Replied') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $contact_replied_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
