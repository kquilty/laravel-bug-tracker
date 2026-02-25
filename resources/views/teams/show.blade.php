<x-layout>
    <h1 style="font-size: 20px; margin-bottom: 1rem;">Team Details</h1>
    
    <div>
        <p><b>Name:</b> {{ $team->name }}</p>
        <p><b>Created:</b> {{ $team->created_at->diffForHumans() }}</p>
    </div>

</x-layout>