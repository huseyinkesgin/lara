<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            Yeni Müşteri Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <x-input-text wire:model.live="code" label="Kod" />
                <x-input-text wire:model.live="name" label="İl Adı" />
                <x-select wire:model.live='is_active' label="Durum" error="is_active" >
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </x-select>
                <x-textarea wire:model.live="description" label="Açıklama" />
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
