<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" href="{{ asset('site/images/icons/biodegradable.svg') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="{{ asset('/js/intlTelInput.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/intlTelInput.css') }}">
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @routes
    </head>
    <body class="min-h-screen">
        @inertia
    </body>
</html>
