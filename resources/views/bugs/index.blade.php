<x-layout>
    <h1>Existing Bugs</h1>
    <ul>
        @foreach ($bug_array as $bug)
            <li>
                <x-card href="/bugs/{{ $bug['id'] }}" :warn="$bug['days_old'] >= 30">
                    <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                </x-card>
            </li>
        @endforeach
    </ul>
</x-layout>