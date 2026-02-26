<x-layout>
    <form method="POST" action="{{ route('workers.store') }}" class="form">
        @csrf

        <h1>Add a New Worker</h1>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}" />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}" />
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select name="position" id="position" required>
                <option value=""></option>
                <option value="general" {{ old('position') === 'general' ? 'selected' : '' }}>General</option>
                <option value="developer" {{ old('position') === 'developer' ? 'selected' : '' }}>Developer</option>
                <option value="manager" {{ old('position') === 'manager' ? 'selected' : '' }}>Manager</option>
            </select>
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
                <x-google-icon name="person_add" class="icon-inline-fix p-0 m-0" />
                Add Worker
            </button>
        </div>
    </form>
</x-layout>