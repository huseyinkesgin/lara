<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Arsalar') }}
        </h2>
    </x-slot>

    <div>

        @livewire('portfolio.land-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('portfolio.land-table')
                @livewire('portfolio.land-create', key('create'))
                @livewire('portfolio.land-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
