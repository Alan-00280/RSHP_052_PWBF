<x-template title="Pet">

    {{-- @dd($pets) --}}

    <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Pet</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Pemilik</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Pet</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Lahir</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Warna Tanda</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach ($pets as $pet)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-gray-800">{{ $pet->idpet }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $pet->Pemilik->User->nama }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $pet->nama }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $pet->tanggal_lahir }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $pet->warna_tanda ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if ($pet->jenis_kelamin === 'J')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                    Jantan
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 bg-pink-100 rounded-full">
                                    Betina
                                </span>
                            @endif
                        </td>
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
