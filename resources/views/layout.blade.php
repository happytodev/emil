<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="./css/main.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="text-3xl">Emil Static Website Alpha</h1>
    </header>

    @yield('content')

    <footer>
        &copy; 2024 Happytodev
    </footer>
</body>
</html>