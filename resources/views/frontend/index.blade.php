@extends('frontend.layouts.main')

@section('container')
    @include('frontend.sections.hero')

    @include('frontend.sections.about')
    @include('frontend.sections.projects')
    @include('frontend.sections.experiences')
    @include('frontend.sections.blogs')
    @include('frontend.sections.contact')
@endsection
