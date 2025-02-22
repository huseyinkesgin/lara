<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
           İlçe Düzenle
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
                <!-- Durum -->
                <x-select wire:model.live="is_active" label="Durum" error="is_active">
                    @foreach (App\Enums\isActive::options() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-select>
                <x-textarea wire:model.live="description" label="Açıklama" error="description" />
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
