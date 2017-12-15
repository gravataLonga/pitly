<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pitly</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-pitly">
        <div class="container mx-auto">
            <div class="flex justify-center">
                <div class="w-1/4 py-8">
                    <img src="{{ asset('images/pitly.png') }}" alt="Pitly">
                </div>
            </div>
            <!-- This can be done via Vue.js with axios -->
            <form action="{{ route('shorter.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="flex justify-center">
                    <div class="w-1/2">
                        <p class="text-center mb-8 text-grey-darkest text-base font-sans">Cria o teu primeiro URL cortado!</p>
                        <input name="url" type="text" class="w-full px-2 py-2 text-2xl text-grey-darker rounded shadow">
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <div class="w-1/4 text-center">
                        <button type="submit" class="hover:text-pitly-dark hover:bg-white rounded text-white shadow px-2 py-2 bg-pitly-dark text-base font-sans">Corta</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
