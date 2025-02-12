<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Müşteri') }}
        </h2>
    </x-slot>

    {{-- Modalları en üste taşıyoruz --}}
    <div>

        @livewire('contact.customer-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('contact.customer-table')
                @livewire('contact.customer-create', key('create'))
                @livewire('contact.customer-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
