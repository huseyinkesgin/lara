<div class="relative">

    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            İlçeyi Düzenle
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <x-input-text wire:model.live="code" label="Kod" error="code" />
                <x-select wire:model.live="city_id" label="Şehir" error="city_id" >
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </x-select>
                <x-input-text wire:model.live="name" label="İlçe Adı" error="name" />
                <x-textarea wire:model.live="description" label="Açıklama" error="description" />
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
