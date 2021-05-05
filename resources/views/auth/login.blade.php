<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <title>Coreon Gate</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="loginWrapper">
        <img src="{{ asset('img/logo.png') }}" alt="coreon gate" title="Coreon Gate" class="logo">
        <div class="loginCard">
            <div class="header">
                <p>Employee Login</p>
            </div>
            <form action="{{ route('login') }}" class="content" method="POST">
                @csrf

                @if(session('error'))
                    <div class="errorLogin">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <x-input type="text" name="username" label="Username" />
                <x-input type="password" name="password" label="Password" />
                <div class="button-group">
                    <x-button-link href="#" type="danger">Back</x-button-link>
                    <x-button type="submit">Login</x-button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>