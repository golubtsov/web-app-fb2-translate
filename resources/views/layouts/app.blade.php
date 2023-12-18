<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        @vite(['resources/css/app.css',  'resources/js/app.js'])
    </head>
    <body>
        <div class="w-full">
            <div class="max-w-7xl m-auto text-gray-700 max-lg:px-8 max-md:py-3">
                @yield('content')
            </div>
        </div>
    </body>
</html>
