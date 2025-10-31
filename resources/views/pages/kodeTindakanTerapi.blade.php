<x-template title="Kode Tindakan Terapi">

    {{-- @dd($therapies) --}}

    <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Tindakan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kode Tindakan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori Klinis</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach ($therapies as $therapy)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->idkode_tindakan_terapi }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->kode }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->deskripsi_tindakan_terapi }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->Kategori->nama_kategori }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->KategoriKlinis->nama_kategori_klinis }}</td>
                        <td class="px-4 py-2 flex justify-center gap-2">
                            <a href="" 
                            class="px-3 py-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md font-medium">
                            Update
                            </a>
                            <a href=""
                            class="px-3 py-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md font-medium">
                            Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-template>