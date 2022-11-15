@php
    // Generate a list with 3 columns for the overview 
    $page = section('page')->list('active', 'title', 'slug');

    // Define de fields for every page
    $page->text('title')->min(2)->max(300)->required();
    $page->text('uri')->unique()->required();
    $page->checkbox('active');
    $page->select('template')->fromDirectory('views.templates');

    // Get the current page
    $currentPage = $page->where('slug' , request()->slug())->first();
@endphp
@if($currentPage && $currentPage->get('active'))
    {{-- Set the browser tab title. See page.blade.php. --}}
    @section('page_title')
        {{ $currentPage->get('title') }}
    @endsection
    {{-- Include the chosen view and allow extra fields. --}}
    @include($currentPage->get('template'), ['page', $currentPage])
@else
    @include('errors.404')
@endif
