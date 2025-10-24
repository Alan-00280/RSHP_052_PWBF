<x-template title="User Data">

    {{-- @dd($users) --}}

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 bg-white rounded-xl shadow-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">ID User</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    @if (count($user->RoleUser) > 0)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 text-gray-700">{{ $user->iduser }}</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $user->nama }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                @foreach ($user->RoleUser as $role)
                                    <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-sm font-medium 
                                        {{ $role->status === 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $role->Role->nama_role }}
                                        @if ($role->status === 1)
                                            <span class="text-xs font-semibold">(Aktif)</span>
                                        @endif
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-3 text-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition">Edit</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


</x-template>
