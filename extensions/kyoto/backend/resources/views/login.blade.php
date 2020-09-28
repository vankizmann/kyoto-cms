<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ app('kyoto')->getRoot('title') }} / {{ app('kyoto')->getMenu('title') }}</title>

    <link rel="shortcut icon" href="{{ asset('kyoto/backend::fav/favicon.ico') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('kyoto/backend::fav/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('kyoto/backend::fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('kyoto/backend::fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('kyoto/backend::fav/site.webmanifest"') }}">
    <link rel="mask-icon" href="{{ asset('kyoto/backend::fav/safari-pinned-tab.svg') }}" color="#4b5bd8">

    <meta name="msapplication-TileColor" content="#4b5bd8">
    <meta name="theme-color" content="#ffffff">

    {!! app('kyoto.assets')->style('google-font', '//fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap') !!}

    {!! app('kyoto.assets')->script('script', 'kyoto/backend::js/index.js') !!}
    {!! app('kyoto.assets')->style('style', 'kyoto/backend::css/index.css') !!}

    {!! app('kyoto.backend')->output() !!}
</head>
<body>

<div id="app" data-root="false">
    @yield('content')
</div>

</body>
</html>
