<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <title>Enquetes</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="/" class="title">ENQUETES</a>
        </nav>
    </header>
    @if (session()->has('msg'))
            <span class="session-message">{{ session()->get('msg') }}</span>
     @endif
    <main class="main-content">
        @yield('content')
    </main>
</body>
@yield('scripts')
</html>
