@php
    $page = section('page')->list('active', 'title', 'url');
    $page->text('uri')->unique()->required();

    $currentPage = $page
    ->where('uri' , request()->uri())
    ->first();
@endphp
@if($currentPage->checkbox('active'))
    @section('page_title'){{ $currentPage->text('title')->min(2)->max(300)->required() }}@endsection

    @php($view = $currentPage->select('template')->fromDirectory('views.templates'))
    @include($view, ['page', $currentPage])
@else
    @include('errors.404')
@endif
