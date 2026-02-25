<x-layout>
    <h1 style="font-size: 20px; margin-bottom: 1rem;">Worker Details</h1>
    
    <div>
        <p><b>Name:</b> {{ $worker->name }}</p>
        <p><b>Position:</b> {{ $worker->position }}</p>
        <p><b>Joined:</b> {{ $worker->created_at->diffForHumans() }}</p>
    </div>

</x-layout>