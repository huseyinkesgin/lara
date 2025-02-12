@props(['disabled' => false])

<td {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-2 whitespace-nowrap text-sm text-gray-900']) !!}>
    {{ $slot }}
</td>


