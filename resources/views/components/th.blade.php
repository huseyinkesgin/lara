@props(['disabled' => false])

<th {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider']) !!}>
    {{ $slot }}
</th>


