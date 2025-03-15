@php
    $alias = str_replace('/blogs/', '', request()->uri());
    $blog = \model\blog_overview\blog_list::query()->whereSlugIs($alias)->first();
@endphp

@extends('website.layouts.main')

@section('head_title', $blog->title ?? 'Blog not found')

@if(!$blog)
    @section('content')
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Blog not found</h2>
                    <p class="mt-2 text-lg/8 text-gray-600">The blog you are looking for does not exist.</p>
                </div>
            </div>
        </div>
    @endsection
@else
    @section('content')
        <main class="max-w-3xl mx-auto">
            <article class="relative pt-12">
                <a href="/blogs" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">Back to overview</a>
                <div class="rounded-lg p-4 text-xl flex justify-center m-8">
                    <h1>{{ $blog->title }}</h1>
                </div>
                <div class="font-body">
                    <div class="mx-4 w-full">
                        {!! $blog->image('image')->widthPx(800)->getPicture(class: 'relative w-full sm:w-220 p-3 rounded-lg') !!}
                        @include('website.includes.blocks.index', ['model' => $blog->content('content')])
                    </div>
                </div>
            </article>
        </main>
    @endsection
@endif
