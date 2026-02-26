<x-layout>
    <form method="POST" action="{{ route('teams.store') }}" class="form">
        @csrf

        <h1>Create a New Team</h1>

        <div class="form-group">
            <label for="name">Team Name</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}" />
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
        </div>

        @if($errors->any())
            <div class="form-errors-list">
                @foreach ($errors->all() as $error)
                    <div><x-google-icon name="error" class="icon-inline-fix" />{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn inline-flex items-center gap-1">
                <x-google-icon name="group_add" class="icon-inline-fix p-0 m-0" />
                Create Team
            </button>
        </div>
    </form>
</x-layout>