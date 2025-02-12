<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="2xl">
        <x-slot name="title">
            Personel Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Sol Üst: Temel Bilgiler -->
                    <x-fieldset legend="Temel Bilgiler">
                        <!-- Kod -->
                        <x-input-text wire:model.live="code" label="Kod" error="code" />


                        <!--     Adı -->
                        <x-input-text wire:model.live="name" label="Personel Adı" error="name" />
                        <!-- T.C. No -->
                        <x-input-tc wire:model.live="tc_no" label="T.C. No" error="tc_no" />
                    </x-fieldset>

                    <!-- Sol Alt: İletişim Bilgileri -->
                    <x-fieldset legend="İletişim Bilgileri">

                        <!-- Telefon -->
                        <x-input-text wire:model.live="phone" label="Telefon" error="phone" mask="(999) 999 99 99"
                            placeholder="(555) 555 55 55" />
                        <!-- Email -->
                        <x-input-text wire:model.live="email" label="Email" error="email"
                            placeholder="info@example.com" />
                    </x-fieldset>
                    <x-fieldset legend="Görsel">
                        <!-- Görsel -->
                        <x-input-text wire:model.live="image" label="Görsel" error="image" />
                        <!-- Durum -->
                        <x-select wire:model.live="status" label="Durum" error="status">
                            @foreach($statusOptions as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
                        </x-select>
                        <!-- Başlangıç Tarihi -->
                        <x-input-date wire:model.live="start_date" label="Başlangıç Tarihi" error="start_date" />
                        <!-- Bitiş Tarihi -->
                        <x-input-date wire:model.live="end_date" label="Bitiş Tarihi" error="end_date" />
                    </x-fieldset>



                    <!-- Sağ Alt: Adres Bilgileri -->
                    <x-fieldset legend="Adres Bilgileri">
                            <!-- Şehir -->
                           <x-select wire:model.live="city_id"  label="Şehir" error="city_id" >
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
                            <x-select wire:model.live="neighbourhood_id" label="Mahalle" error="neighbourhood_id" >
                                @foreach ($neighbourhoods as $neighbourhood)
                                <option value="{{ $neighbourhood->id }}">{{ $neighbourhood->name }}</option>
                                @endforeach
                            </x-select>


                        <!-- Adres -->
                        <x-textarea wire:model.live="address" label="Adres" error="address" />
                        <!-- Açıklama -->
                        <x-textarea wire:model.live="description" label="Açıklama" error="description" />
                    </x-fieldset>
                </div>
            </form>
        </x-slot>
    </x-dialog-modal>
</div>
