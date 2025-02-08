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

    <div class="bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kod</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Firma Adı</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vergi Ofisi</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vergi Numarası</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Telefon</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email</th>

                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Durum</th>
                    <th scope="col"
                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        O.Tarihi</th>
                    <th scope="col"
                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        G.Tarihi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $item)
                    <tr class="hover:bg-gray-50 cursor-pointer relative {{ $selectedRowId == $item->id ? 'bg-blue-50' : '' }}"
                        wire:key="{{ $item->id }}"
                        wire:click.stop="selectRow({{ $item->id }})"
                        wire:dblclick.stop="$dispatch('openEditModal', { id: {{ $item->id }} })"
                        tabindex="0">
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $item->code }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->tax_office }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->tax_number }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->phone }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->email }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->formatted_created_at }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $item->formatted_updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-2">
        {{ $data->links() }}
    </div>
</div>
