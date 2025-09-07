<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@500;700&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    
    <header class="header">
        <div class="header__inner">
            <a href="/products" class="header__logo">mogitate</a>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>