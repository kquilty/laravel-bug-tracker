<x-layout>
    <form method="POST" action="{{ route('bugs.store') }}" class="form">

        {{-- Prevent Cross-Site Request Forgery --}}
        @csrf

        <h1>Report a New Bug</h1>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}" />
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="in progress" {{ old('status') === 'in progress' ? 'selected' : '' }}>In Progress</option>
            </select>
        </div>

        @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                
                @foreach ($errors->all() as $error)
                    <div><x-google-icon name="error" class="!text-[18px]" />{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn inline-flex items-center gap-1">
                <x-google-icon name="bug_report" class="icon-inline-fix" />
                Submit Bug
            </button>
        </div>
    </form>
</x-layout>