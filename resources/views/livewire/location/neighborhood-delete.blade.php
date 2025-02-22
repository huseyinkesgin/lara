<div>
    <x-confirmation-modal wire:model.live="open">
        <x-slot name="title">
            Mahalle Sil
        </x-slot>

        <x-slot name="content">
            Bu mahalleyi silmek istediğinizden emin misiniz?
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                İptal
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete">
                Sil
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
