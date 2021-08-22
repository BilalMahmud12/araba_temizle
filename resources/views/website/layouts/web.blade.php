<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&amp;display=swap"/>
        <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&amp;display=swap"/>
        <link rel="icon" href="assets/images/active34_icon.png"/>
        <link rel="stylesheet" href="{{ asset('site/css/tailwind.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('site/css/app.min.css') }}"/>
        <title>  Welcome — Araba Temizle</title>
    </head>
    <body>
        @include('website.partials.header')
        @yield('content')
        @include('website.partials.home-footer')
    </body>
</html>
