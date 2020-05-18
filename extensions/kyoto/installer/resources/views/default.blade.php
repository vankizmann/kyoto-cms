<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kyoto Installer</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ app('kyoto.assets')->style('google-font', '//fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap') }}

    {{ app('kyoto.assets')->style('installer-style', 'kyoto/installer::css/index.css') }}
    {{ app('kyoto.assets')->script('installer-script', 'kyoto/installer::js/index.js') }}


    {!! app('kyoto.assets')->output() !!}
</head>
<body>
    <div id="app">
        <div class="kyo-installer grid grid--row">
            <div class="kyo-installer__background col--2-5">
                <img width="130" src="{{ asset('kyoto/installer::img/kyoto-white.svg') }}" alt="{{ env('APP_NAME') }}">
            </div>
            <div class="kyo-installer__formular col--3-5">
                <kyo-installer></kyo-installer>
            </div>
        </div>
    </div>
</body>
</html>
