<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="2xl">
        <x-slot name="title">
            Müşteri Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Sol Üst: Temel Bilgiler -->
                    <x-fieldset legend="Temel Bilgiler">
                        <!-- Kod -->
                        <x-input-text wire:model.live="code" label="Kod" error="code" />
                        <!-- Müşteri Tipi -->
                        <x-select wire:model.live="customer_type" label="Müşteri Tipi" error="customer_type">
                            <option value="Bireysel">Bireysel</option>
                            <option value="Kurumsal">Kurumsal</option>
                        </x-select>
                        <!-- Firma -->
                        @if($customer_type == "Kurumsal")
                        <x-select wire:model.live="company_id" label="Firma" error="company_id">
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </x-select>
                        @endif
                        <!-- Müşteri Grubu -->
                        <x-select wire:model.live="customer_group" label="Müşteri Grubu" error="customer_group">
                            <option value="Satıcı">Satıcı</option>
                            <option value="Alıcı">Alıcı</option>
                            <option value="Emlakçı">Emlakçı</option>
                            <option value="Partner">Partner</option>
                            <option value="Diğer">Diğer</option>
                        </x-select>
                        <!-- Müşteri Adı -->
                        <x-input-text wire:model.live="name" label="Müşteri Adı" error="name" />
                        <!-- T.C. No -->
                        <x-input-text wire:model.live="tc_no" label="T.C. No" error="tc_no" />
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
                            <x-select wire:model.live="neighborhood_id" label="Mahalle" error="neighborhood_id" >
                                @foreach ($neighborhoods as $neighborhood)
                                <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
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
