<x-template title="Jenis Hewan">
    {{-- @dd($jenisHewans) --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                    <th class="px-6 py-3 text-left">ID Jenis Hewan</th>
                    <th class="px-6 py-3 text-left">Nama Jenis Hewan</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisHewans as $jenisHewan)
                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 font-medium">{{ $jenisHewan->idjenis_hewan }}</td>
                        <td class="px-6 py-4">{{ $jenisHewan->nama_jenis_hewan }}</td>
                        <td class="px-6 py-4 space-x-3">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Update</a>
                            <a href="#" class="text-red-600 hover:text-red-800 font-medium">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</x-template>
