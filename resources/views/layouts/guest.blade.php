<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        
        
    </head>
    <body>
        <div class="wrapper client">

            <x-flash-message />

            <div class="card">
                <div class="clientForm">
                    <header>
                        <img src="{{ asset('img/coreongate.png') }}" alt="Coreon Gate Logo" class="logo">
                    </header>
                    <nav>
                        <a href="{{ route('client.show_check_in_form') }}" class="links {{ (request()->is('check_in')) ? 'active' : '' }}">Check in</a>
                        <a href="{{ route('client.show_check_out_form') }}" class="links {{ (request()->is('check_out')) ? 'active' : '' }}">Check out</a>
                        <a href="#" class="links {{ (request()->is('sign_up')) ? 'active' : '' }}" id="signUp">Sign up</a>
                    </nav>
                    <main>
                        {{ $slot }}
                    </main>
                </div>
                <div class="adsWrapper" id="adsWrapper">
                    
                    @if($ads->count() > 0)
                        @foreach($ads as $ad)
                            <input type="radio" id="radio{{ $loop->index + 1 }}" class="radio" name="radio">
                            <img src="{{ Storage::url($ad->name) }}" alt="" class="ads" id="{{ ($loop->first) ? 'first' : '' }}">
                        @endforeach

                    @else 
                        <input type="radio" id="radio1" class="radio" name="radio">
                        <input type="radio" id="radio2" class="radio" name="radio">
                        <input type="radio" id="radio3" class="radio" name="radio">
                        <input type="radio" id="radio4" class="radio" name="radio">
                        <input type="radio" id="radio5" class="radio" name="radio">

                        <img src="https://images.unsplash.com/photo-1490457843367-34b21b6ccd85?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=769&q=80" alt="" class="ads" id="first">
                        <img src="https://images.unsplash.com/photo-1561043433-9265f73e685f?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="" class="ads">
                        <img src="https://images.unsplash.com/photo-1509482560494-4126f8225994?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="" class="ads">
                        <img src="https://images.unsplash.com/photo-1447195047884-0f014b0d9288?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="" class="ads">
                        <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=849&q=80" alt="" class="ads">   
                    @endif

                    
                </div>
            </div>

            <x-signup-form />

            <img src="{{ asset('img/wave.svg') }}" alt="" class="wave">
        </div>


        

        
        <!-- Scripts -->
        @livewireScripts
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
