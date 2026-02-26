@if (session('success'))
    <div class="success-message">
        <x-google-icon name="check_circle" class="icon-inline-fix success-message-icon" />
        <span>{{ session('success') }}</span>
    </div>
@endif