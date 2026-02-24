@props([
    'href',
    'warn' => false,
])

<div @class(['card', 'card-warning' => $warn]) >
    {{ $slot }}
    <a class="btn" href="{{ $href }}">View Details</a> 
</div>