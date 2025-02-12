<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('İlçeler') }}
        </h2>
    </x-slot>

    <div>

        @livewire('location.district-edit', key('edit'))

    </div>

    <div class="py-2">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('location.district-table')
                @livewire('location.district-create', key('create'))
                @livewire('location.district-delete', key('delete'))
            </div>
        </div>
    </div>
</div>
