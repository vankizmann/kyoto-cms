<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kyoto Installer</title>

    {{ app('kyoto.assets')->style('google-font', '//fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap') }}

    {{ app('kyoto.assets')->style('installer-style', 'kyoto/installer::css/index.css') }}
    {{ app('kyoto.assets')->script('installer-script', 'kyoto/installer::js/index.js') }}


    {!! app('kyoto.assets')->output() !!}
</head>
<body style="background-image: url('{{ asset('kyoto/installer::img/space-background.jpg') }}');">
    <div class="container">
        <div class="installer" id="app">
            <div class="installer-logo">
                <img width="160" src="{{ asset('kyoto/installer::img/kyoto-white.svg') }}" alt="{{ env('APP_NAME') }}">
            </div>
            <n-tabs>
                <n-tabs-item name="default" label="Laravel">
                    123
                </n-tabs-item>
                <n-tabs-item name="database" label="Database">
                    321
                </n-tabs-item>
                <n-tabs-item name="website" label="Website">
                    asd
                </n-tabs-item>
            </n-tabs>
        </div>
    </div>
</body>
</html>
