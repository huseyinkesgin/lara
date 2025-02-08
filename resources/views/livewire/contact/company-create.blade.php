<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="2xl">
        <x-slot name="title">
            Yeni Firma Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Sol Üst: Temel Bilgiler -->
                    <x-fieldset legend="Temel Bilgiler">
                        <!-- Firma Kodu -->
                        <x-input-text wire:model.live="code" label="Firma Kodu" error="code" />
                        <!-- Firma Adı -->
                        <x-input-text wire:model.live="name" label="Firma Adı" error="name" />
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

                    <!-- Sağ Üst: Vergi Bilgileri -->
                    <x-fieldset legend="Vergi Bilgileri">
                        <!-- FAtura Adı -->
                        <x-input-text wire:model.live="tax_name" label="Fatura Adı" error="tax_name"
                            placeholder="Örnek Firma Sanayi İnşaat Ticaret Limited Şti" />
                        <!-- Vergi Ofisi -->
                        <x-input-text wire:model.live="tax_office" label="Vergi Ofisi" error="tax_office"
                            placeholder="Göztepe Vergi Dairesi" />
                        <!-- Vergi Numarası -->
                        <x-input-text wire:model.live="tax_number" label="Vergi No" error="tax_number"
                            placeholder="___ __ __ __" mask="999 99 99 999" />
                        <!-- Mersis No -->
                        <x-input-text wire:model.live="mersis_no" label="Mersis No" error="mersis_no"
                            placeholder="1234567890123456" mask="9999999999999999" />

                        <!-- Kep Adresi -->
                        <x-input-text wire:model.live="kep_address" label="Kep Adresi" error="kep_address" />
                    </x-fieldset>



                    <!-- Sağ Alt: Adres Bilgileri -->
                    <x-fieldset legend="Adres Bilgileri">
                            <!-- Şehir -->
                            <x-select wire:model.live="city_id" options="$cities" label="Şehir" error="city_id" >
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
