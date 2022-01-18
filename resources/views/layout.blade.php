<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!--<link rel="preload" href="//cdn.cuberto.com/cb/fonts/averta/AvertaCY-Light.woff2" as="font" crossorigin="">
    <link rel="preload" href="//cdn.cuberto.com/cb/fonts/averta/AvertaCY-Regular.woff2" as="font" crossorigin="">
    <link rel="preload" href="//cdn.cuberto.com/cb/fonts/averta/AvertaCY-Semibold.woff2" as="font" crossorigin="">-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://unpkg.com/phosphor-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');

        body {
            font-family: 'Roboto Mono', monospace !important;
        }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container" style="margin-top: 2em; margin-bottom: 2em;">
        @yield('content')
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
