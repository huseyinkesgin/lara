<div class="relative" wire:key="district-table-{{ $page ?? '1' }}">
    <div class="flex justify-between">
        <div class="bg-white p-2 border-b flex items-center gap-2">

            <x-widget3 icon="fa-map-marker-alt" title="Semt Sayısı:">
                {{ $districtCount }}
            </x-widget3>

            <x-widget4 icon="fa-home" title="Mahalle Sayısı:">
                {{ $neighborhoodCount }}
            </x-widget4>
        </div>

    </div>
    <div class="flex justify-between">
        <div class="bg-white p-2 border-b flex items-center gap-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
                wire:click="$dispatch('openCreateModal')">
                <i class="fa-regular fa-plus"></i>
            </button>
            <button wire:click="editSelected"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded {{ !$selectedRowId ? 'opacity-50 cursor-not-allowed' : '' }}">
                <i class="fa-regular fa-edit"></i>
            </button>
            <button wire:click="deleteSelected"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded {{ !$selectedRowId ? 'opacity-50 cursor-not-allowed' : '' }}">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        </div>
        <div>
            <input type="text" wire:model.live.debounce.300ms="search"
                class="border border-gray-300 m-2 h-8 rounded " placeholder="Ara...">
        </div>
    </div>

    <x-table>
        <thead class="bg-gray-50">
            <tr>
                <x-th>Kod</x-th>
                <x-th>İl Adı</x-th>
                <x-th>İlçe Adı</x-th>
                <x-th>Semt Adı</x-th>
                <x-th>Mahalle Adı</x-th>
                <x-th>Mahalle Sayısı</x-th>
                <x-th>Durum</x-th>
                <x-th>O.Tarihi</x-th>
                <x-th>G.Tarihi</x-th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($data as $item)
                <tr class="hover:bg-gray-50 cursor-pointer relative {{ $selectedRowId == $item->id ? 'bg-blue-50' : '' }}"
                    wire:key="{{ $item->id }}" wire:click.stop="selectRow({{ $item->id }})"
                    wire:dblclick.stop="$dispatch('openEditModal', { id: {{ $item->id }} })" tabindex="0">
                    <x-td>{{ $item->code }}</x-td>
                    <x-td>{{ $item->town->city->name }}</x-td>
                    <x-td>{{ $item->town->name }}</x-td>
                    <x-td>{{ $item->name }}</x-td>
                    <x-td>{{ $item->neighborhoods->count() }}</x-td>
                    <x-td>
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $item->is_active ? 'AKTİF' : 'PASİF' }}
                        </span>
                    </x-td>
                    <x-td>{{ $item->created_at }}</x-td>
                    <x-td>{{ $item->updated_at }}</x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table>

    <div class="p-2">
        {{ $data->links() }}
    </div>
</div>
