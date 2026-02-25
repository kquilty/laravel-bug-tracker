@props([
    'href',
    'warn' => false,
])

<a href="{{ $href }}" @class(['card', 'card-warning' => $warn])>
    <div class="card-content">
        {{ $slot }}
    </div>
</a>