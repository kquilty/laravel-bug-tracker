<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker</title>

    @vite('resources/css/app.css')

</head>
<body>
    <header>
        <div class="header-content">
            <h1>Bug Tracker v1.0.0</h1>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/bugs">View Bugs</a></li>
                    <li><a href="/bugs/report">Report Bug</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        {{ $slot }}
    </main>

</body>
</html>