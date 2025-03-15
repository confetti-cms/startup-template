@php($page = newRoot(new \model\contact))

@extends('website.layouts.main')
@section('head_title', 'Contact')
@section('content')
    {{-- Generated with prompt: Generate a contact page with 4 blocks with location, phone, email and social media links. Link to Google Maps, phone number, email address and LinkedIn profile. --}}
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $page->text('title')->max(50)->default('Contact us') }}</h2>
                <p class="mt-2 text-lg/8 text-gray-600">{{ $page->text('subtitle')->max(200)->default('We are here to help you. Contact us for any inquiries.') }}</p>
            </div>

            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pt-4 lg:pr-8">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-indigo-600">{{ $page->text('location_title')->default('Location') }}</h2>
                        <p class="mt-2 font-semibold tracking-tight text-pretty text-gray-900">
                            <a href="https://www.google.com/maps?q={{ urlencode($page->location) }}" target="_blank">{{ $page->text('location')->default('1234 Elm St. New York, NY 10001') }}</a>
                        </p>
                    </div>
                </div>
                <div class="lg:pt-4 lg:pr-8">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-indigo-600">{{ $page->text('phone_title')->default('Phone') }}</h2>
                        <p class="mt-2 font-semibold tracking-tight text-pretty text-gray-900">
                            <a href="tel:{{ $page->phone }}">{{ $page->text('phone')->default('(123) 456-7890') }}</a>
                        </p>
                    </div>
                </div>
                <div class="lg:pt-4 lg:pr-8">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-indigo-600">{{ $page->text('email_title')->default('Email') }}</h2>
                        <p class="mt-2 font-semibold tracking-tight text-pretty text-gray-900">
                            <a href="mailto:{{ $page->email }}">{{ $page->text('email')->default('you@example.com') }}</a>
                        </p>
                    </div>
                </div>
                <div class="lg:pt-4 lg:pr-8">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base/7 font-semibold text-indigo-600">{{ $page->text('social_media_title')->default('LinkedIn') }}</h2>
                        <p class="mt-2 font-semibold tracking-tight text-pretty text-gray-900">
                            <a href="{{ $page->social_media }}" target="_blank">{{ $page->text('social_media')->default('https://www.linkedin.com/404/') }}</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        @if($page->contact_form->get())
            <div class="w-full mt-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-4">
                    <h3 class="text-2xl font-semibold tracking-tight text-pretty text-gray-900 text-center">{{ $page->contact_form->getTitle() }}</h3>
                </div>
                {!! $page->tally('contact_form')->withPadding()->embed() !!}
            </div>
        @endif
    </div>

@endsection


