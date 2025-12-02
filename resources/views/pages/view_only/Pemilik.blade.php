@extends('layouts.skydash.index')

@section('title', 'Pemilik')

@section('content')
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                {{-- <x-logger :object="$pets" /> --}}
                <div class="card-body">
                    <h4 class="card-title" id="table-heading">Data Pemilik</h4>
                    {{-- <x-logger :object="$pemiliks" /> --}}
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">#ID Pemilik</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Email</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nomor WA</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Alamat</th>
                                </tr>
                            </thead>
                            {{-- {
                            "idpemilik": 19,
                            "no_wa": "08712331",
                            "alamat": "test",
                            "iduser": 66,
                            "user": {
                            "iduser": 66,
                            "nama": "Baru",
                            "email": "baru@mail.com",
                            "remember_token": null
                            }
                            } --}}
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($pemiliks as $pemilik)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-2 text-gray-800" id="id-{{ $pemilik->idpemilik }}">
                                            {{ $pemilik->idpemilik }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <span>{{ $pemilik->user->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <span>{{ $pemilik->user->email }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <span>{{ $pemilik->no_wa }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <span style="max-width: 250px; overflow-wrap: break-word; white-space: normal;">{{ $pemilik->alamat }}</span>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection