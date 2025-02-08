@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-3 py-1 bg-orange-50">
        <div class="flex justify-between text-lg font-medium text-orange-900">
            {{ $title }}
             <button x-on:click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-3 py-2 bg-gray-100 text-end bg-orange-100">
         <div class="d-flex justify-content-end">
                <button type="button" class="bg-slate-300 text-sm px-2 py-1" wire:click="$set('open', false)">
                    İptal
                </button>
                <button type="submit" class="bg-orange-700 text-white text-sm px-2 py-1" wire:click="save" wire:loading.attr="disabled">
                    <span wire:loading.remove>Kaydet</span>
                    <span wire:loading>Kaydediliyor...</span>
                </button>
            </div>
</x-modal>
