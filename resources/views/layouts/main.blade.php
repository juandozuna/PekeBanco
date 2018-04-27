<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pekepolis | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/app.css">
    @yield('styles')
</head>
<body class="bg-info">
    @include('headers.mainheader')

    <div class="container" id="app">
        @yield('content')
    </div>

    @yield('scripts')
    <script src="js/app.js"></script>
</body>
</html>