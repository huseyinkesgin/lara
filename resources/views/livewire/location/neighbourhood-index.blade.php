<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahalleler') }}
        </h2>
    </x-slot>

    <div>

        @livewire('location.neighbourhood-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('location.neighbourhood-table')
                @livewire('location.neighbourhood-create', key('create'))
                @livewire('location.neighbourhood-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
