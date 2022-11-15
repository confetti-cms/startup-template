@section('footer')
    @php($footer = section('footer'))
    <footer>
        <div class="container">
            @foreach($footer->multiple('columns')->min(2)->max(3)->sortable() as $column)
                <div class="item">
                    <h3>{{ $column->text('title') }}</h3>
                    <ul>
                        @foreach($column->multiple('rows')->min(1)->max(5)->sortable() as $item)
                            @php($link = $item->select('link_to')->fromSection('page'))
                            <li><a href="{{ $item->slug }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </footer>
@endsection
