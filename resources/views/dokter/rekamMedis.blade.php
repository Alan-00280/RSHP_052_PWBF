@extends('layouts.skydash.index')

@section('title', 'Rekam Medis')

@section('content')

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ '#' }}" role="button">
                <span class="mdi mdi-plus"></span>
                Tambah Rekam Medis
            </a>
        </div>
        {{-- <x-logger :object="$rekam_medis_detail" /> --}}
        {{-- {
        "idrekam_medis": 2,
        "created_at": "2025-10-06T14:12:30.000000Z",
        "anamnesa": "Muntah Saat Berkendara",
        "temuan_klinis": "Kaki Patah",
        "diagnosa": "Jatuh dari kendaraan",
        "idreservasi_dokter": 218,
        "dokter_pemeriksa": {
        "idrole_user": 54,
        "iduser": 61,
        "idrole": 2,
        "status": 1,
        "user": {
        "iduser": 61,
        "nama": "Dr. Andi Setiawan",
        "email": "ea@email.com",
        "remember_token": null
        }
        },
        "temu_dokter": {
        "idreservasi_dokter": 218,
        "no_urut": 1,
        "waktu_daftar": "2025-10-04 18:52:12",
        "status": "D",
        "idpet": 9,
        "iddokter": 48
        }
        } --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Rekam Medis</h4>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                                        <span style="width: 95px; display: block; white-space: normal; overflow-wrap: break-word;">
                                            #ID Rekam Medis
                                        </span>
                                    </th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">#ID Temu Dokter</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Pasien (Pemilik - Pet)</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Dokter Pemeriksa</th>
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Detail</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($rekam_medis_detail as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        {{-- ID Rekam Medis --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->idrekam_medis }}
                                        </td>

                                        {{-- ID Reservasi --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->TemuDokter->idreservasi_dokter }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="px-4 py-2 text-gray-800" style="min-width: 150px">
                                            <select class="form-select form-select-sm text-black" name="status"
                                                data-id="{{ $item->TemuDokter->idreservasi_dokter }}">
                                                {{-- <option value="W" {{ $item->TemuDokter->status == 'W' ? 'selected' : '' }}>Waiting</option> --}}
                                                <option value="R" {{ $item->TemuDokter->status == 'R' ? 'selected' : '' }}>Terekam</option>
                                                <option value="D" {{ $item->TemuDokter->status == 'D' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </td>

                                        {{-- Tanggal Dibuat --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->created_at }}
                                        </td>

                                        {{-- Pasien --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->TemuDokter->Pet->Pemilik->User->nama }} - {{ $item->TemuDokter->Pet->nama }}
                                        </td>

                                        {{-- Dokter Pemeriksa --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->DokterPemeriksa->user->nama ?? '-' }}
                                        </td>

                                        {{-- Action --}}
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ route('detil-rkm-medis', ['id' => $item->idrekam_medis]) }}"
                                                class="btn btn-info btn-sm">
                                                Detail
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>



        {{-- @if (\in_array($role_id, [1, 2]))
        <p>True</p>
        @else
        <p>False</p>
        @endif --}}
@endsection