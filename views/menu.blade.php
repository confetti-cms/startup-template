@section('top_menu')
    @php($menu = section('menu'))
    <div class="menu">
        <ul>
            @foreach($column->multiple('items')->min(1)->max(5)->sortable() as $item)
                @php($link = $item->select('link_to')->fromSection('page'))
                <li><a href="{{ $item->get('slug') }}">{{ $item->get('title') }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
