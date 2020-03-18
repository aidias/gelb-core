<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GelbCore') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div id="app">
        <main class="container bg-white shadow-lg mx-auto my-12 md:rounded-lg py-10 px-20">
            <nav class="relative flex items-center justify-between">
                <a href="" title="" class="flex font-bold text-lg text-yellow-500 hover:text-yellow-700 transition duration-500">{{ config('app.name', 'Gelb') }}</a>

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="24" viewBox="0 0 192 230">
                    <defs><clipPath id="b"><rect width="192" height="230"/></clipPath></defs>
                    <g id="a" clip-path="url(#b)"><rect width="192" height="230" fill="transparent"/>
                    <g transform="translate(-12 -82)">
                        <text transform="translate(0 303)" fill="#434438" font-size="300" font-family="NunitoSans-Bold, Nunito Sans" font-weight="700"><tspan x="0" y="0">G</tspan></text>
                        <path d="M2691.695-2602.364l-96.88,206.3H2577.4l104.047-219.986Z" transform="translate(-2495 2716)" fill="#fff"/>
                    </g></g>
                </svg>

                <a href="" title="" class="flex font-bold text-lg text-gray-500 hover:text-gray-700 transition duration-500">Theme</a>
            </nav>

            @yield('content')

            <footer class="mt-8 w-4/12 mx-auto text-center text-gray-400 text-sm">
                <span>Made with love by Rafael Casachi.</span>
            </footer>
        </main>
    </div>
</body>
</html>
