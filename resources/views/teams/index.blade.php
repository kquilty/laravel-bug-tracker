<x-layout>
    <div style="display: flex; justify-content: center; gap: 2rem; align-items: baseline; margin-bottom: 1rem;">
        <h1 style="font-size: 20px; margin-bottom: 1rem;">Total Teams: <b>{{ $team_array->total() }}</b></h1>
        <a class="btn" href='{{ route('teams.create') }}'">Add New Team</a>
    </div>
    <ul class="teamlist-index">
        @foreach ($team_array as $team)
            <li>
                <x-card href="{{ route('teams.show', $team['id']) }}">
                    <div>
                        <p>{{ $team['name'] }}</p>
                        <p class="text-sm text-gray-500">Created {{ $team['created_at']->diffForHumans() }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>
    <br />
    {{ $team_array->links() }}
    <br />

</x-layout>