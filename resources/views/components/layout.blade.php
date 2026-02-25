<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="site-shell">
    <header>
        <div class="header-content">
            <div class="brand">
                <span class="brand-mark" aria-hidden="true"></span>
                <h1>Bug Tracker</h1>
            </div>
            <nav>
                <ul>

                    <li><a href="/">Home</a></li>

                    <li><a href="{{ route('bugs.index') }}">Bugs</a></li>
                    {{-- <li><a href="{{ route('bugs.report') }}">Report Bug</a></li> --}}

                    <li><a href="{{ route('workers.index') }}">Workers</a></li>
                    {{-- <li><a href="{{ route('workers.create') }}">Add Worker</a></li> --}}

                    <li><a href="{{ route('teams.index') }}">Teams</a></li>
                    {{-- <li><a href="{{ route('teams.create') }}">Add Team</a></li> --}}

                </ul>
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

</body>
</html>