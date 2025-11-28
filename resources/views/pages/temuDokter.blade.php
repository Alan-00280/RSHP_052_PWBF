@extends('layouts.skydash.index')

@section('title', 'Jenis Hewan')

@section('content')

    {{-- @dd($pets) --}}

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ '#' }}" role="button">
                <span class="mdi mdi-plus"></span>
                Buat Temu Dokter
            </a>
        </div>
        {{-- <x-logger :object="$temu_dokter_details" /> --}}
        {{-- {
        "idreservasi_dokter": 218,
        "no_urut": 1,
        "waktu_daftar": "2025-10-04 18:52:12",
        "status": "D",
        "idpet": 9,
        "iddokter": 48,
        "pet": {
            "idpet": 9,
            "nama": "Kuuro",
            "tanggal_lahir": "2025-07-09",
            "warna_tanda": "Cokelat Pink",
            "jenis_kelamin": "J",
            "idpemilik": 3,
            "idras_hewan": 35,
            "ras_hewan": {
                "idras_hewan": 13,
                "nama_ras": "Siamese",
                "idjenis_hewan": 2,
                "jenis_hewan": {
                    "idjenis_hewan": 2,
                    "nama_jenis_hewan": "Kucing (Felis catus)"
                }
            },
        },
        "pemilik": {
        "idpemilik": 3,
        "no_wa": "083112401241",
        "alamat": "Jl. Jayabaya No. 78, Kecamatan Sukodadi, Kabupaten Lumajang",
        "iduser": 44,
        "user": {
        "iduser": 44,
        "nama": "Gendhis Fitriani Juny",
        "email": "pemilikDua@mail.com",
        "remember_token": null
        }
        }
        },
        "resepsionis": {
        "idrole_user": 48,
        "iduser": 36,
        "idrole": 4,
        "status": 1,
        "user": {
        "iduser": 36,
        "nama": "resp. Rani Tinawiranti",
        "email": "resepsionis@mail.com",
        "remember_token": null
        }
        }
        } --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Temu Dokter</h4>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">#ID Temu</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Pemilik</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Hewan - Jenis</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Waktu Daftar</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">No Urut</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Resepsionis</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($temu_dokter_details as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        
                                        {{-- ID Reservasi --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->idreservasi_dokter }}
                                        </td>

                                        {{-- Pemilik --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->pet->pemilik->user->nama }}
                                        </td>

                                        {{-- Nama Hewan --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            <span style="display: block;width: 200px; overflow-wrap: break-word; white-space: normal;">
                                            {{ $item->pet->nama }} - {{ $item->pet->RasHewan->JenisHewan->nama_jenis_hewan }} - {{ $item->pet->RasHewan->nama_ras }}
                                            </span>
                                        </td>

                                        {{-- Waktu Daftar --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->waktu_daftar }}
                                        </td>

                                        {{-- No Urut --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->no_urut }}
                                        </td>

                                        {{-- Dokter --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->resepsionis->user->nama ?? '—' }}
                                        </td>

                                        {{-- Status Select --}}
                                        <td class="px-4 py-2 text-gray-800" style="min-width: 150px">
                                            <select class="form-select form-select-sm text-black" name="status"
                                                data-id="{{ $item->idreservasi_dokter }}" disabled>
                                                <option value="W" {{ $item->status == 'W' ? 'selected' : '' }}>Waiting</option>
                                                <option value="R" {{ $item->status == 'R' ? 'selected' : '' }}>Terekam</option>
                                                <option value="D" {{ $item->status == 'D' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </td>

                                        {{-- Action Buttons --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex gap-2">
                                                <a href="{{ '#' }}"
                                                    class="btn btn-sm btn-warning"><span class="mdi mdi-pencil"></span> Edit</a>

                                                <form action="{{ '#' }}"
                                                    method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><span class="mdi mdi-delete-outline"></span> Delete</button>
                                                </form>
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