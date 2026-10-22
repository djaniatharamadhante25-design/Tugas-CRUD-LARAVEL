<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yamaha Store')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="inner">
        <div class="logo">🏍️</div>
        <div>
            <h1>Yamaha Store</h1>
            <small>Manajemen data produk</small>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
