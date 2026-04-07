@props(['status'])

@php
    $color = $status === 'published' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white';
@endphp

<span class="px-2 py-1 rounded {{ $color }}">
    {{ ucfirst($status) }}
</span>