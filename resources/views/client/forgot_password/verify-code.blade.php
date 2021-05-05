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

            <div id="forgotPassword">
                <div class="header">Forgot Password</div>
                <form action="{{ route('forgot_password.verify_code_process', ['id' => $clientId]) }}" method="POST" class="forgotPasswordForm">
                    @csrf
                    <div id="input">
                        <x-input type="text" name="code" label="Enter the code you receive" />
                        <x-button type="submit">Verify</x-button>
                    </div> 
                    {{-- @livewire('code-timer', $forgotPassword->id) --}}
                    <livewire:code-timer :client="$clientId" :code="$forgotPassword" />
                </form>
            </div>

            <img src="{{ asset('img/wave.svg') }}" alt="" class="wave">
        </div>


        

        
        <!-- Scripts -->
        @livewireScripts
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
