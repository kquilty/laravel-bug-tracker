<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Bugtracker</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.head-google-icons')


</head>
<body class="site-shell">
    <header>
        <div class="header-content">
            <div class="brand">
                <span class="brand-mark" aria-hidden="true"></span>
                <h1>Laravel Bugtracker</h1>
            </div>
            <nav>
                <ul>
                    @php
                        $isHome = request()->path() === '/';
                        $isBugs = request()->routeIs('bugs.*');
                        $isWorkers = request()->routeIs('workers.*');
                        $isTeams = request()->routeIs('teams.*');
                    @endphp

                    <li><a href="/" @class(['is-active' => $isHome]) @if($isHome) aria-current="page" @endif>Home</a></li>

                    <li><a href="{{ route('bugs.index') }}" @class(['is-active' => $isBugs]) @if($isBugs) aria-current="page" @endif>Bugs</a></li>
                    {{-- <li><a href="{{ route('bugs.report') }}">Report Bug</a></li> --}}

                    <li><a href="{{ route('workers.index') }}" @class(['is-active' => $isWorkers]) @if($isWorkers) aria-current="page" @endif>Workers</a></li>
                    {{-- <li><a href="{{ route('workers.create') }}">Add Worker</a></li> --}}

                    <li><a href="{{ route('teams.index') }}" @class(['is-active' => $isTeams]) @if($isTeams) aria-current="page" @endif>Teams</a></li>
                    {{-- <li><a href="{{ route('teams.create') }}">Add Team</a></li> --}}

                </ul>
            </nav>
        </div>
    </header>

    <main>
        <x-success-message />
        {{ $slot }}
    </main>

    <footer class="site-footer" style="text-align:center; margin-top:2.5rem; color:#64748b; font-size:0.98rem; padding-bottom:2.5rem;">
        <span>&copy; {{ date('Y') }} A Laravel sandbox created by 
            <a href="https://kylequilty.com/apps" target="_blank" rel="noopener" style="color:#2563eb; text-decoration:underline; font-weight:500;">Kyle Quilty</a>
        </span>
    </footer>

</body>
</html>