@php($errorContent = section('page_not_found'))

@section('page_title')
    {{ $errorContent->text('title')->default('Page not found') }}
@endsection

<div>
    {{ $errorContent->get('title') }}<br>
    {{ $errorContent->textarea('description') }}
</div>
