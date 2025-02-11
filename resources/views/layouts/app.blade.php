<!doctype html>
<html lang="en">
    <head>
        <title>Donate - Atta Initiative</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" sizes="16x16" href="/img/atta-logo.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/atta-logo.png">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('/assets/sweetalert/sweetalert.css')}}">

        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        @stack('css')
    </head>
    <body>
        @auth
            @include('layouts.auth')
        @endauth

        @guest
            @include('layouts.guest')
        @endguest

        @include('includes.bottom-scripts')
    </body>
</html>
