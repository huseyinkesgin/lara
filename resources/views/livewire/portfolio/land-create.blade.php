<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            Yeni Arsa
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">

                <x-fieldset legend="Genel Bilgiler">
                    <!-- Kod -->
                    <x-input-text wire:model.live="code" label="Kod" error="code"/>
                    <!-- Tarih -->
                    <x-input-date wire:model.live="enter_date" label="Tarih" error="enter_date" />
                    <!-- Arsa Alanı -->
                    <x-input-text wire:model.live="area" label="Alan m²" error="area" />
                    <!-- Mal Sahibi -->
                    <x-select wire:model.live="customer_id" label="Mal Sahibi" error="customer_id">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </x-select>
                </x-fieldset>

                <x-fieldset legend="Adres Bilgileri">
                    <!-- Şehir -->
                    <x-select wire:model.live="city_id" label="Şehir" error="city_id">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </x-select>
                    <!-- İlçe -->
                    <x-select wire:model.live="district_id" label="İlçe" error="district_id">
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </x-select>

                    <!-- Mahalle -->
                    <x-select wire:model.live="neighbourhood_id" label="Mahalle" error="neighbourhood_id">
                        @foreach ($neighbourhoods as $neighbourhood)
                            <option value="{{ $neighbourhood->id }}">{{ $neighbourhood->name }}</option>
                        @endforeach
                    </x-select>
                    <!-- Ada -->
                    <x-input-text wire:model.live="land" label="Ada" error="land" />
                    <!-- Parcel -->
                    <x-input-text wire:model.live="parcel" label="Parsel" error="parcel" />

                </x-fieldset>

                
                <x-fieldset lengend="Diğer Bilgiler">

                    <!-- İmar Durumu -->
                    <x-select wire:model.live="zooning_status" label="İmar Durumu" error="zooning_status">
                        <option value="Konut İmarlı">Konut İmarlı</option>
                        <option value="Ticari">Ticari</option>
                        <option value="Sanayi">Sanayi</option>
                        <option value="Ticari+Konut">Ticari+Konut</option>
                        <option value="Gelişme Konut">Gelişme Konut</option>
                        <option value="Diğer Tarım">Diğer Tarım</option>
                    </x-select>
                    <!-- Emsal -->
                    <x-input-text wire:model.live="similar" label="Emsal" error="similar" />
                    <!-- Gabari -->
                    <x-input-text wire:model.live="size" label="Gabari" error="size" />
                    <!-- Danışman -->
                    <x-select wire:model.live="personnel_id" label="Danışman" error="personnel_id">
                        @foreach ($personnels as $personnel)
                            <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                        @endforeach
                    </x-select>
                    <!-- Açıklama -->
                    <x-textarea wire:model.live="description" label="Açıklama" error="description" />
                </x-fieldset>
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
