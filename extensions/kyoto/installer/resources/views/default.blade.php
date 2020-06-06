<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installer</title>

    <link rel="shortcut icon" href="{{ asset('kyoto/installer::fav/favicon.ico') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('kyoto/installer::fav/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('kyoto/installer::fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('kyoto/installer::fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('kyoto/installer::fav/site.webmanifest"') }}">
    <link rel="mask-icon" href="{{ asset('kyoto/installer::fav/safari-pinned-tab.svg') }}" color="#4b5bd8">
    <meta name="msapplication-TileColor" content="#4b5bd8">
    <meta name="theme-color" content="#ffffff">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ app('kyoto.assets')->style('google-font', '//fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap') }}

    {{ app('kyoto.assets')->style('installer-style', 'kyoto/installer::css/index.css') }}
    {{ app('kyoto.assets')->script('installer-script', 'kyoto/installer::js/index.js') }}


    {!! app('kyoto.assets')->output() !!}
</head>
<body>
    <div id="app">
        <div class="kyo-installer grid grid--row grid--wrap">
            <div class="kyo-installer__background col--1-1 col--2-5@md">
                <img width="130" src="{{ asset('kyoto/installer::img/kyoto-black.svg') }}" alt="{{ env('APP_NAME') }}">
            </div>
            <div class="kyo-installer__formular col--1-1 col--3-5@md">
                <kyo-installer></kyo-installer>
            </div>
        </div>
    </div>
</body>
</html>
