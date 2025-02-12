<div class="relative" wire:key="city-table-{{ $page ?? '1' }}">
    <div class="flex justify-between">
        <div class="bg-white p-2 border-b flex items-center gap-2">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
            wire:click="$dispatch('openCreateModal')">
            <i class="fa-regular fa-plus"></i>
        </button>
        <button
        wire:click="editSelected"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded {{ !$selectedRowId ? 'opacity-50 cursor-not-allowed' : '' }}">
        <i class="fa-regular fa-edit"></i>
        </button>
        <button
            wire:click="deleteSelected"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded {{ !$selectedRowId ? 'opacity-50 cursor-not-allowed' : '' }}">
            <i class="fa-regular fa-trash-can"></i>
        </button>
    </div>
    <div>
        <input type="text"
            wire:model.live.debounce.300ms="search"
            class="border border-gray-300 m-2 h-8 rounded "
            placeholder="Ara...">
    </div>
    </div>


        <x-table>
            <thead class="bg-gray-50">
                <tr>
                    <x-th>Kod</x-th>
                    <x-th>Arsa</x-th>
                    <x-th>Ada</x-th>
                    <x-th>Parsel</x-th>
                    <x-th>İl</x-th>
                    <x-th>İlçe</x-th>
                    <x-th>Mahalle</x-th>
                    <x-th>İmar</x-th>
                    <x-th>Tarih</x-th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $item)
                    <tr class="hover:bg-gray-50 cursor-pointer relative {{ $selectedRowId == $item->id ? 'bg-blue-50' : '' }}"
                        wire:key="{{ $item->id }}"
                        wire:click.stop="selectRow({{ $item->id }})"
                        wire:dblclick.stop="$dispatch('openEditModal', { id: {{ $item->id }} })"
                        tabindex="0">
                        <x-td>{{ $item->code }}</x-td>
                        <x-td>{{ $item->area }}</x-td>
                        <x-td>{{ $item->land }}</x-td>
                        <x-td>{{ $item->parcel }}</x-td>
                        <x-td>{{ $item->city->name }}</x-td>
                        <x-td>{{ $item->district->name }}</x-td>
                        <x-td>{{ $item->neighbourhood->name }}</x-td>
                        <x-td>{{ $item->zooning_status }}</x-td>
                        <x-td>{{ $item->date }}</x-td>
                     </tr>
                @endforeach
            </tbody>
        </x-table>

    <div class="p-2">
        {{ $data->links() }}
    </div>
</div>
