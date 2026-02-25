<x-layout>
    <h1 style="font-size: 20px; margin-bottom: 1rem;">Open Bugs: <b>{{ $bug_array->total() }}</b></h1>
    <ul class="buglist-index">
        @foreach ($bug_array as $bug)
            <li>
                <x-card href="{{ route('bugs.show', $bug['id']) }}" :warn="$bug['days_old'] >= 30">
                    <div>
                        <p>{{ $bug['title'].' ('.$bug['status'].')' }}</p>
                        <p class="text-sm text-gray-500">Reported {{ $bug['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $bug_array->links() }}
    <br />

</x-layout>