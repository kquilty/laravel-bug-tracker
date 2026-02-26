@if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
        <x-google-icon name="check_circle" class="icon-inline-fix" />
        {{ session('success') }}
    </div>  
@endif