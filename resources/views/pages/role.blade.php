@extends('layouts.skydash.index')

@section('title', 'Manage Role User')

@section('content')
    {{-- @dd($user_role) --}}
    <div class="overflow-x-auto">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data User</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">#ID User</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama User</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Roles</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($user_role as $user)
                                    @if (count($user->RoleUser) > 0)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-3 text-gray-700">
                                                {{ $user->iduser }}
                                            </td>
                                            <td class="px-6 py-3 text-gray-700">
                                                {{ $user->nama }}
                                            </td>
                                            <td class="px-6 py-3 text-gray-700">
                                                @foreach ($user->RoleUser as $roleOfUser )
                                                    <span>
                                                    {{ $roleOfUser->Role->nama_role }}
                                                    @if ($roleOfUser->status == '1')
                                                    <span> (Aktif) </span>
                                                    @endif
                                                    </span> <hr class="p-0 my-2"/>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-3 text-gray-700">
                                                <a href="#" class="btn btn-primary px-3 py-2"><span
                                                        class="mdi mdi-square-edit-outline"></span> Edit</a>    
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection