@php
    $page = section('page');

    // Generate a list with 3 columns for the pages overview
    $page->list('active', 'title', 'slug');

    // Define de fields for every page
    $title = $page->text('title')->min(2)->max(300)->required();
    $page->text('slug')->urlFriendly()->unique()->default($title);
    $page->checkbox('active');
    $page->select('template')->fromDirectory('views.templates');

    // Get the current page
    $currentPage = $page->where('slug' , request()->slug())->first();
@endphp
@if($currentPage && $currentPage->active)
    {{-- Set the browser tab title. See page.blade.php. --}}
    @section('page_title')
        {{ $currentPage->title }}
    @endsection
    {{-- Include the chosen view and allow extra fields. --}}
    @include($currentPage->template, ['page', $currentPage])
@else
    @include('errors.404')
@endif
