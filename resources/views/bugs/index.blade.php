<x-layout>
    <h1 style="font-size: 20px; margin-bottom: 1rem;">Open Bugs: <b>{{ count($bug_array) }}</b></h1>
    <ul class="buglist-index">
        @foreach ($bug_array as $bug)
            <li>
                <x-card href="/bugs/{{ $bug['id'] }}" :warn="$bug['days_old'] >= 30">
                    <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                </x-card>
            </li>
        @endforeach
    </ul>
</x-layout>