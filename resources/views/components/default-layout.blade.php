<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ParkSide Tuition</title>

    @vite('/resources/css/app.css', '/resources/js/app.js')


</head>
<body class="antialiased bg-body text-body font-body">
<div class="">

    {{$slot}}
</div>
</body>
</html>
