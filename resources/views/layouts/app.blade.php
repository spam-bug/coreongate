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

        <div class="wrapper app">
            <aside class="sidebar">
                <div class="logoWrapper">
                    <img src="{{ asset('img/coreongate-w.png') }}" alt="">
                </div>
                <nav class="sidebarMenu">
                    <a href="{{ route('dashboard') }}" class="sidebarLinks {{ (request()->is('dashboard')) ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('employee.clients') }}" class="sidebarLinks {{ (request()->is('clients')) ? 'active' : '' }}">Clients</a>
                    <a href="{{ route('client.top_up') }}" class="sidebarLinks {{ (request()->is('top_up')) ? 'active' : '' }}">Top up</a>

                    <div class="hr"></div>
                    
                    @role('Admin')
                        <a href="{{ route('settings') }}" class="sidebarLinks {{ (request()->is('settings*')) ? 'active' : ''}}">Settings</a>
                    @endrole
                    <form action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <a class="sidebarLinks" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                Log out</a>
                    </form>
                </nav>
            </aside>

            <section class="body">
                <x-flash-message />
                <header>{{ $header }}</header>
                <main>{{ $slot }}</main>
            </section>
        </div>

         <!-- Scripts -->
         @livewireScripts
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
