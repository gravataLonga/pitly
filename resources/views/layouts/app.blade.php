<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Pitly</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-pitly">
        <div class="container mx-auto">
            <div class="flex py-8">
                <div class="w-1/3">
                    
                </div>
                <div class="w-1/3">
                    <img src="{{ asset('images/pitly.png') }}" alt="Pitly" class="p-4">
                </div>
                <div class="w-1/3">
                    <div class="flex justify-end">
                        <a class="bg-white text-center text-black px-4 py-2 rounded-l no-underline font-sans border-l border-t border-b hover:bg-grey-lightest" href="{{ route('login') }}">Login</a>
                        <a class="bg-white text-center text-black px-4 py-2 rounded-r no-underline font-sans border hover:bg-grey-lightest" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="shorten-app">
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
