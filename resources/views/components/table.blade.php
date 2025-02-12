@props(['disabled' => false])
<div class="bg-white rounded-lg shadow">
    <table {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) !!}>
        {{ $slot }}
    </table>
</div>
