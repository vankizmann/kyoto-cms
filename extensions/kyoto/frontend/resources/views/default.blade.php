<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ app('kyoto')->getRoot('title') }} / {{ app('kyoto')->getMenu('title') }}</title>

    {{ app('kyoto.assets')->style('google-font', '//fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap') }}

    {!! app('kyoto.assets')->script('script', 'kyoto/frontend::js/index.js') !!}
    {!! app('kyoto.assets')->style('style', 'kyoto/frontend::css/index.css') !!}

    {!! app('kyoto.assets')->output() !!}
</head>
<body>

    <div id="app">
        @yield('content')
    </div>

</body>
</html>
