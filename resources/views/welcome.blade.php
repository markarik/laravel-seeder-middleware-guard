<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/mine.css')}}">


    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <header class="header">
                    <div class="logo-box">
                        <img src="{{asset('img/logo.svg')}}" alt="logo" class="logo">
                    </div>
                    <div class="text-box">
                        <h1 class="heading-primary">
                            <span class="heading-primary-main">MYWORK</span>
                            <span class="heading-primary-sub">Work With No Limits</span>
                        </h1>

                        <a href="#" class="btn btn-white">Discover Me</a>
                    </div>
                </header>
            </div>
        </div>
    </body>
</html>
