@php(newRoot(new \model\homepage))

@extends('website.layouts.main')

@section('head_title', 'Homepage')

@section('content')
    @include('website.homepage.hero')
    @include('website.homepage.cta')
    @include('website.homepage.feature')
    @include('website.homepage.newsletter')
@endsection
