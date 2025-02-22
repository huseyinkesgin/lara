<div class="relative">
    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            Mahalle Düzenle
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="save">
                <x-input-text wire:model.live="code" label="Kod" error="code" />
                
                <!-- İl Seçimi -->
                <x-select wire:model.live="city_id" label="İl" error="city_id">
                    <option value="">İl Seçiniz</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </x-select>

                <!-- İlçe Seçimi -->
                @if($city_id)
                    <x-select wire:model.live="town_id" label="İlçe" error="town_id">
                        <option value="">İlçe Seçiniz</option>
                        @foreach ($towns as $town)
                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                        @endforeach
                    </x-select>
                @endif

                <!-- Semt Seçimi -->
                @if($town_id)
                    <x-select wire:model.live="district_id" label="Semt" error="district_id">
                        <option value="">Semt Seçiniz</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </x-select>
                @endif

                <x-input-text wire:model.live="name" label="Mahalle Adı" error="name" />
                
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
