<x-template title="Role">

    {{-- @dd($roles) --}}

    <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Role</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Role</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach ($roles as $role)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-gray-800">{{ $role->idrole }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $role->nama_role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-template>
