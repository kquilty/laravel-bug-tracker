<x-layout>
    <div style="display: flex; justify-content: center; gap: 2rem; align-items: baseline; margin-bottom: 1rem;">
        <h1 style="font-size: 20px; margin-bottom: 1rem;">Total Workers: <b>{{ $worker_array->total() }}</b></h1>
        <a class="btn" href='{{ route('workers.create') }}'">Add New Worker</a>
    </div>
    <ul class="workerlist-index">
        @foreach ($worker_array as $worker)
            <li>
                <x-card href="{{ route('workers.show', $worker['id']) }}">
                    <div>
                        <p>{{ $worker['name'].' ('.$worker['position'].')' }}</p>
                        <p class="text-sm text-gray-500">Joined {{ $worker['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $worker_array->links() }}
    <br />

</x-layout>