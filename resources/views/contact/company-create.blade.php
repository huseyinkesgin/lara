<!-- Vergi Numarası -->
<div class="mb-2 grid grid-cols-4 items-center">
    <label class="col-span-1 text-xs font-medium" for="tax_number">Vergi Numarası</label>
    <input type="text" 
           x-data
           x-mask="999 99 99 999"
           wire:model.live="tax_number" 
           class="col-span-3 block w-full text-sm h-7" 
           id="tax_number">
</div>

<!-- Telefon -->
<div class="mb-2 grid grid-cols-4 items-center">
    <label class="col-span-1 text-xs font-medium" for="phone">Telefon</label>
    <input type="text" 
           x-data
           x-mask="(999) 999 99 99"
           wire:model.live="phone" 
           class="col-span-3 block w-full text-sm h-7" 
           id="phone">
</div>
