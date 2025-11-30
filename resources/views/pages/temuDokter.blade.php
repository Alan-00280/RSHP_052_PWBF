@extends('layouts.skydash.index')

@section('title', 'Jenis Hewan')

@section('content')

    {{-- @dd($pets) --}}

    <x-successAlert :message="session('success')" />

    @if(session('error')){
        <x-error-alert :errors="session('error')" type="global" />
    }
    @endif

    <x-error-alert :errors="$errors" />

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ '#' }}" role="button" data-bs-toggle="modal"
                data-bs-target="#createModal">
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
                                                @if ($item->status == 'W')
                                                <button 
                                                    data-id="{{ $item->idreservasi_dokter }}"
                                                    class="btn btn-danger text-white btn-delete p-2"
                                                    role="button" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirm-delete-model"
                                                ><span class="mdi mdi-delete-outline"></span> Delete
                                                </button>
                                                @endif
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

@section('modal')
    {{-- Modal Createing --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('create-temu-dokter') }}" method="POST" id="modal-create-form"> 
                    @csrf 
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Temu Dokter</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="input-jenis" class="form-label">Resepsionis</label>
                            {{-- Ini Buat Resepsionis, diambil data nya --}}
                            {{-- <x-logger :object="$login_user_role" /> --}}

                            {{-- <x-logger :object="$resepsionises" /> --}}
                            {{-- $login_user_role->RoleUser[0]->idrole == '1' ? 'true' : 'false' --}}
                            <select class="form-select text-black" id="input-resepsionis" name="idResepsionis" aria-label="Default select example" required>
                                <option class="text-black" value="" selected="{{ $login_user_role->RoleUser[0]->idrole == '1' ? 'true' : 'false' }}">-- Pilih Resepsionis --</option>
                                @if($resepsionises)
                                    @foreach ($resepsionises as $resepsionis)
                                        <option class="text-black" value="{{ $resepsionis->RoleUser[0]->idrole_user }}">{{ $resepsionis->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3"> <label for="input-pemilik" class="form-label">Pemilik</label> 
                            <select class="form-select text-black" id="input-pemilik" name="idPemilik" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Pemilik --</option>
                                @if($pemiliks)
                                    @foreach ($pemiliks as $pemilik)
                                        <option class="text-black" value="{{ $pemilik->idpemilik }}">{{ $pemilik->User->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3"> 
                            <label for="input-pet" class="form-label">Pet</label> 
                            <select class="form-select text-black" id="input-pet" name="idPet" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Pemilik Dahulu --</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal" id="close-modal">Close</button> 
                        <button type="submit"
                            class="btn btn-primary">Simpan</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Confirm Delete  --}}
    <div class="modal fade" id="confirm-delete-model" tabindex="-1" aria-labelledby="confirm-delete-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirm-delete-model">Hapus kategori</h1> <button type="button"
                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Yakin menghapus temu dokter #<strong id="idTemuDokter"></strong>? 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal" id="close-modal">Batal</button>
                    <form action="" method="post" id="form-delete">
                        @csrf
                        @method('DELETE')    
                        <button type="submit"
                        class="btn btn-danger text-white">Hapus</button> 
                    </form> 
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', (e) => {
            const deleteButton = document.querySelectorAll('.btn-delete')
            const formDelete = document.getElementById('form-delete')
            const idTemuDokter= document.getElementById('idTemuDokter')
            
            deleteButton.forEach(btn => {
                btn.addEventListener('click', (e)=> {
                const id = e.currentTarget.dataset.id

                formDelete.action = `/delete-temu-dok/${id}`;
                idTemuDokter.innerText = id;
                })
            });
            
        })

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
        })

        const selectPemilik = document.getElementById('input-pemilik')
        const selectPet = document.getElementById('input-pet')
        const loadSelectPet = async (e) => {
            selectPet.innerHTML = `<option class="text-black" value="" selected>Loading . . .</option>`
            if (e.target.value) {
                const idpemilik = e.target.value
                const FetchPets = await fetch(`/get-pet/${idpemilik}`)
                const pets = await FetchPets.json()

                // console.log(pets)

                if (pets.length > 0) {
                selectPet.innerHTML = `<option class="text-black" value="${pets[0].idpet}" selected>${pets[0].nama} - ${pets[0].ras_hewan.nama_ras}</option>`
                pets.forEach((pet, idx) => {
                    if (idx >= 1) {
                    selectPet.innerHTML += `<option class="text-black" value="${pet.idpet}">${pet.nama} - ${pet.ras_hewan.nama_ras}</option>`
                    }
                });
                } else {
                selectPet.innerHTML = `<option class="text-black" value="" selected>-- No Data --</option>`
                }
            } else {
                selectPet.innerHTML = `<option class="text-black" value="" selected>-- Pilih Pemilik Dahulu --</option>`
            }
        }
        selectPemilik.addEventListener('change', (e) => loadSelectPet(e))
        


    </script>
@endsection