@section('top_menu')
    @php($menu = section('menu'))
    <div class="menu">
        @foreach($menu->multiple('items')->min(2)->max(10)->sortable() as $column)
            <ul>
                @foreach($column->multiple('rows')->min(1)->max(5)->sortable() as $item)
                    @php($link = $item->select('link_to')->fromSection('page'))
                    <li><a href="{{ $item->get('uri') }}">{{ $item->get('title') }}</a></li>
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
