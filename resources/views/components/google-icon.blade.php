@props([
    'name',
    'style' => '',
    'class' => '',
    'wght' => '400',
])
<span class="material-symbols-outlined {{ $class }}" style="{{ $style }}; font-variation-settings:
        'FILL' 0,
        'wght' {{ $wght }},
        'GRAD' 0,
        'opsz' 24;">
    {{ $name }}
</span>