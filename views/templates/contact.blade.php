@extends('page')
@php /** @var \Section $page */@endphp

@section('content')
    @php($contact = $page->section('contact'))
    <section>
        <h4>{{ $contact->text('name')->max(100) }}</h4>
        <p>
            {{ $contact->email('email') }}<br>
            {{ $contact->telephone('phone') }}
        </p>
    </section>
@endsection
