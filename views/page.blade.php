<!DOCTYPE html>
<html lang="en-US">
<head>
    @vite('resources/js/app.js')
    <title>@yield('page_title')</title>
</head>
<body class="home">
<main>
    @yield('top_menu')
    @yield('content')
    @yield('footer')
</body>

</html>
