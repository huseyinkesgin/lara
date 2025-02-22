<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahalleler') }}
        </h2>
    </x-slot>

    <div>

        @livewire('location.neighborhood-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8 bg-amber-50">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('location.neighborhood-table')
                @livewire('location.neighborhood-create', key('create'))
                @livewire('location.neighborhood-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
