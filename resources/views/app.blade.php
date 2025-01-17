<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <title>Enquetes</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="/" class="title">ENQUETES</a>
            <a href="{{ route('poll.create') }}">CRIAR ENQUETE</a>
        </nav>
    </header>
    <main class="main-content">
        @yield('content')
    </main>
</body>
<script src="{{ asset('js/scripts.js') }}"></script>
</html>
