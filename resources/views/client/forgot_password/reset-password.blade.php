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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        
        
    </head>
    <body>
        <div class="wrapper client">

            <x-flash-message />

            
            <div id="forgotPassword">
                <div class="header">Forgot Password</div>
                <form action="{{ route('forgot_password.reset_password_process', ['id' => $client->id]) }}" method="POST" class="content">
                    @csrf
                    @method('PATCH')


                    <div id="resetPassword">
                        <x-input type="password" name="password" label="New Password"/>
                        <x-input type="password" name="password" label="Confirm New Password"/>

                        <x-button type="submit">SUBMIT</x-button>
                    </div>
                </form>
            </div>
            

            <img src="{{ asset('img/wave.svg') }}" alt="" class="wave">
        </div>


        

        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
