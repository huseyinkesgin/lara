@props(['legend' => null])
<fieldset class="mb-4 border border-orange-800 rounded-md p-4">
    <legend class="text-orange-800 text-semibold px-3">{{ $legend }}</legend>
    {{ $slot }}
</fieldset>
