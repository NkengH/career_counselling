@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-3 text-sm font-medium rounded-xl text-primary-600 bg-primary-50 transition-all duration-200 shadow-sm'
        : 'flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>