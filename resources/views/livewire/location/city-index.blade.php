<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Şehirler') }}
        </h2>
    </x-slot>

    {{-- Modalları en üste taşıyoruz --}}
    <div>

        @livewire('location.city-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('location.city-table')
                @livewire('location.city-create', key('create'))
                @livewire('location.city-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
