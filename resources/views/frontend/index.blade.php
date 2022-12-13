@extends('frontend.layouts.main')

@section('container')
    @include('frontend.sections.hero')

    @include('frontend.sections.about')
    @include('frontend.sections.companies')
    @include('frontend.sections.experiences')
    @include('frontend.sections.organizations')
    @include('frontend.sections.socials')
    @include('frontend.sections.blogs')
    @include('frontend.sections.contact')
@endsection
