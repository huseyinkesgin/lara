@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-3 py-1">
        <div class="flex items-center justify-center p-3">
<i class="fa-solid fa-triangle-exclamation text-red-600 " style="font-size: 4rem"></i>
        </div>
        <div class="mt-1 text-sm text-gray-600 text-center">
            {{ $content }}
             <span>Bu işlem geri alınamaz, dikkatli olunuz</span>
        </div>
    </div>

    <div class="flex flex-row justify-end px-3 py-2 bg-gray-100 text-end">
         <div class="d-flex justify-content-end">
                <button type="button" class="bg-slate-300 text-sm px-2 py-1" wire:click="$set('open', false)">
                    İptal
                </button>
                <button type="submit" class="bg-orange-700 text-white text-sm px-2 py-1" wire:click="delete" wire:loading.attr="disabled">
                    <span wire:loading.remove>Kaldır</span>
                    <span wire:loading>Kaldırılıyor...</span>
                </button>
            </div>
</x-modal>
