@props([
    'href',
    'warn' => false,
])

<div @class(['card', 'card-warning' => $warn])>
    <div class="card-content">
        {{ $slot }}
    </div>
    <a class="btn" href="{{ $href }}">View Details</a>
</div>