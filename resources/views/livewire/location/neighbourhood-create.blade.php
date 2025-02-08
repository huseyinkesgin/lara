<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            Yeni Müşteri Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <!-- Kod -->
                <x-input-text wire:model.live="code" label="Kod" error="code" />
                <!-- Şehir -->
                <x-select wire:model.live="city_id" label="Şehir" >
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </x-select>
                <!-- İlçe -->
                <x-select wire:model.live="district_id" label="İlçe" >
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </x-select>

                <!-- Mahalle Adı -->
                <x-input-text wire:model.live="name" label="Mahalle Adı" error="name" />

                <!-- Açıklama -->
                <x-textarea wire:model.live="description" label="Açıklama" error="description" />
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
