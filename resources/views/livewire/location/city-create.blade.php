<div class="relative">


    <x-dialog-modal wire:model.live="open" maxWidth="sm">
        <x-slot name="title">
            Yeni Müşteri Oluştur
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="save">
                <x-input-text wire:model.live="code" label="Kod" error="code" />
                <x-input-text wire:model.live="name" label="İl Adı" error="name" />
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
