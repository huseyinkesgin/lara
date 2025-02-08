@props(['disabled' => false, 'label' => null, 'error' => null, 'name' => null,  ])

<div class="mb-2 grid grid-cols-4 items-center">
    <label class="col-span-1 text-xs font-medium text-orange-800" for="{{ $name }}">{{ $label }}</label>
    <select {{ $disabled ? 'disabled' : '' }}   {!! $attributes->merge(
        ['class' => 'col-span-3 block w-full text-sm h-6 leading-none text-xs py-0 border border-orange-800 bg-amber-50']) !!}>
         <option  selected  value="">Seçiniz</option>
        {{ $slot }}
    </select>
    @error($error)
        <span class="col-start-2 col-span-3 text-red-600 text-xs mt-1">{{ $message }}</span>
    @enderror
</div>
