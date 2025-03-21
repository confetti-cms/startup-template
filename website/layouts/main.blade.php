<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('head_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/website__tailwind/tailwind.output.css"/>
    <link rel="stylesheet" href="/website/assets/css/fonts.css"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/website/assets/favicon/favicon-32x32.png">
    @stack('style_*')
</head>
<body class="text-lg overflow-x-hidden">
{{--@guest()--}}
{{--    @include('website.under_construction')--}}
{{--@else()--}}

@include('website.header')

@yield('content')

@php($target = newRoot(new \model\footer)->selectFile('template')->match(['/website/includes/footers/*.blade.php'])->required()->default('/website/includes/footers/footer_small.blade.php'))
@include($target->getView(), ['model' => $target])

{{--    @endguest--}}

@include('website.includes.dev_tools')
@stack('end_of_body_*')

</body>
</html>
