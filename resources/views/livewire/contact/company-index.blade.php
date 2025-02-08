<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Firma') }}
        </h2>
    </x-slot>

    {{-- Modalları en üste taşıyoruz --}}
    <div>

        @livewire('contact.company-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('contact.company-table')
                @livewire('contact.company-create', key('create'))
                @livewire('contact.company-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
