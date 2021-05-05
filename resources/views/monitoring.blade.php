<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">



    </head>
    <body >

        <div class="monitoring">
            <div class="actions">
                {{-- <livewire:active-client-counter /> --}}

                <div class="links">
                    <x-button-link href="{{ route('client.show_check_in_form') }}" type="primary">Check In</x-button-link>
                    <x-button-link href="{{ route('login') }}" type="primary">Employee Login</x-button-link>
                </div>
            </div>

            <hr>

            <livewire:active-clients />
        </div>




         <!-- Scripts -->
         @livewireScripts
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
