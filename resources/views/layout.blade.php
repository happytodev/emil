<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>Mon site statique</h1>
    </header>

    @yield('content')

    <footer>
        &copy; 2023
    </footer>
</body>
</html>