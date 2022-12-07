@extends('frontend.layouts.main')

@section('container')
    @include('frontend.sections.hero')

    @include('frontend.sections.about')
    @include('frontend.sections.projects')
    @include('frontend.sections.experience')
    @include('frontend.sections.contact')
@endsection
