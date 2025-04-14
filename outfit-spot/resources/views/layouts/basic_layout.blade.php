<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/global.css')}}">
        @stack('styles')
        <link rel="icon" href="@yield('favicon')" type="image/svg+xml">
        <title>@yield('title', '404')</title>

    </head>
    <body class="@yield('body_class')">
        @if (! View::hasSection('header'))
            @include('partials.header')
        @else
            @yield('header')
        @endif
        @yield('content')
        @if (! View::hasSection('footer'))
            @include('partials.footer')
        @else
            @yield('footer')
        @endif

    </body>
</html>

