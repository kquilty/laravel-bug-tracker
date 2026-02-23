<x-layout>
    <h1>Existing Bugs</h1>
    <ul>
        @foreach ($bug_array as $bug)
            <li>
                <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                <a href="/bugs/{{ $bug['id'] }}">View Details</a> 
            </li>
        @endforeach
    </ul>
</x-layout>