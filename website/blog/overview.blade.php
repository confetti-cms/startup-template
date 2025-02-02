@php
    $perPage = 10;
    $page = request()->parameter('page') ?: 1;
    $offset = ($page - 1) * $perPage;
    $blogPage = newRoot(new \model\blog_overview)->label('Blog');
    $blogs = $blogPage->list('blog')->columns(['title'])->limit($perPage)->offset($offset)->get();
@endphp

@extends('website.layouts.main')

@section('head_title', 'Blogs')

@section('content')
    <!-- Visit https://tailwindui.com/components/marketing/sections/blog-sections to explore a variety of blog sections -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $blogPage->text('title')->max(50)->default('Hot off the press:') }}</h2>
                <p class="mt-2 text-lg/8 text-gray-600">{{ $blogPage->text('short_description')->max(200)->default('Learn how to grow your business with our expert advice.') }}</p>
            </div>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($blogs as $blog)
                    <article class="flex max-w-xl flex-col items-start justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="2020-03-16" class="text-gray-500">{{ $blog->text('date')->default('March 16, 2020') }}</time>
                            <a href="/blogs/{{ $blog->category }}" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $blog->select('category')->options(['Business', 'Technology', 'Design', 'Culture'])->default('Business') }}</a>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
                                <a href="/blogs/{{ $blog->text('slug') }}" class="relative">
                                    <span class="absolute inset-0"></span>
                                    {{ $blog->text('title')->max(50) }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{ $blog->text('short_description')->max(200) }}</p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4">
                            <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full bg-gray-50">
                            <div class="text-sm/6">
                                <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $blog->text('author')->max(50) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8 flex justify-center">
                @if($page > 1)
                    <a href="{{ request()->uri() }}?page={{ $page-1 }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">Previous</a>
                @endif
                @if(count($blogs) === $perPage && $blogPage->blogs()->offset($offset + 1)->first() !== null)
                    <a href="{{ request()->uri() }}?page={{ $page+1 }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Next</a>
                @endif
            </div>
        </div>
    </div>
@endsection