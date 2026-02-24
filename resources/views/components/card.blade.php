@props([
    'href',
    'warn' => false,
])

<div @class(['card', 'card-warning' => $warn]) >
    {{ $slot }}
    <a href="{{ $href }}">View Details</a> 
</div>