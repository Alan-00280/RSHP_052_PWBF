@extends('layouts.skydash.index')

@section('title', 'Rekam Medis')

@section('style')
    <style>
        .card-hover {
            transition: all 0.2s ease;
        }

        .card-link-hover:hover .card-hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
        }
    </style>
@endsection

@section('content')

    
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            @if (\in_array($role_id, [1, 3]))
            <a name="" 
                id="" 
                class="btn btn-success mb-3 text-light" 
                href="{{ '#' }}" 
                role="button" 
                data-bs-toggle="modal"
                data-bs-target="#createModal">
                <span class="mdi mdi-plus"></span>
                Tambah Rekam Medis
            </a>
            @endif
        </div>
       
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
                                    @if (\in_array($role_id, [1, 3]))
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Dokter Pemeriksa</th>
                                    @endif
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
                                            <form action="{{ route('update-status-temu', ['id' => $item->TemuDokter->idreservasi_dokter]) }}" method="POST" id="change-status-{{ $item->TemuDokter->idreservasi_dokter }}">
                                                @csrf
                                                <select class="form-select form-select-sm text-black select-status" name="status" data-id="{{ $item->TemuDokter->idreservasi_dokter }}">
                                                    <option value="W" {{ $item->TemuDokter->status == 'W' ? 'selected' : '' }} disabled>Waiting</option>
                                                    <option value="R" {{ $item->TemuDokter->status == 'R' ? 'selected' : '' }}>Terekam</option>
                                                    <option value="D" {{ $item->TemuDokter->status == 'D' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </form>
                                        </td>

                                        {{-- Tanggal Dibuat --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->created_at }}
                                        </td>

                                        {{-- Pasien --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->TemuDokter->Pet->Pemilik->User->nama }} - {{ $item->TemuDokter->Pet->nama }}
                                        </td>

                                        @if (\in_array($role_id, [1, 3]))
                                        {{-- Dokter Pemeriksa --}}
                                        <td class="px-4 py-2 text-gray-800">
                                            {{ $item->DokterPemeriksa->user->nama ?? '-' }}
                                        </td>
                                        @endif

                                        {{-- Action --}}
                                        <td class="px-4 py-2 text-center">
                                            <a href="{{ route('detil-rkm-medis', ['id' => $item->idrekam_medis]) }}"
                                                class="btn btn-info btn-sm text-white">
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

@endsection
@section('modal')
{{-- Modal Createing --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: none; margin-left: 200px; margin-right: 200px;">
            <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Rekam Medis</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> 
                            <label for="input-id-temu" class="form-label">Temu Dokter</label>
                            <form action="" id="modal-create-form">
                            <input type="text" class="form-control" id="input-id-temu" aria-describedby="idTemuDokter" name="id_temu_dokter" required>
                            </form> 
                            <div id="idTemuDokter" class="form-text">Cari ID Temu Dokter dahulu di sini</div>
                        </div>
                        <div class="mb-3"> 
                            <div class="d-flex flex-column" id="temu-dokter">
                                <em>No Data . . .</em>
                                                             
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning"
                            data-bs-dismiss="modal" id="close-modal">Cancel</button> 
                    </div>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    <script>
        const changeStatusTemu = async (e) => {
            const formStatus = document.getElementById(`change-status-${e.currentTarget.dataset.id}`)
            try {
                formStatus.submit()
            } catch (error) {
                console.log(JSON.stringify(error));
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Delete modal prep
            const deleteButton = document.querySelectorAll('.btn-delete')
            const formDelete = document.getElementById('form-delete')
            const kategoriNama= document.getElementById('kategoriNama')
            
            deleteButton.forEach(btn => {
                btn.addEventListener('click', (e)=> {
                const id = e.currentTarget.dataset.id
                const nama = e.currentTarget.dataset.nama

                formDelete.action = `/delete-kategori/${id}`;
                kategoriNama.innerText = nama;
                })
            });
            
            //select status
            const selectStatus = document.querySelectorAll('.select-status')
            selectStatus.forEach(i=>(
                i.addEventListener('change', (e) => changeStatusTemu(e))
            ))
        })
        
        const temuDokterResult = document.getElementById('temu-dokter')

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
                temuDokterResult.innerHTML = `<em>No Data. . .</em>`
        })
        
        // get temu dokter by id
        const getTemuDokter = async (e) => {
            const id = e.target.value
            temuDokterResult.innerHTML = `<em>Loading . . .</em>`

            if (id == '') {
                return  temuDokterResult.innerHTML = `<em>No Data. . .</em>`
            }

            try {
                const fetchTemuDokter = await fetch(`/get-temu/${id}`); 
                const temuDokters = await fetchTemuDokter.json();

                if (temuDokters.length <= 0) {
                    return  temuDokterResult.innerHTML = `<em>No Data. . .</em>`
                }

                // temuDokterResult.innerHTML = `${JSON.stringify(temuDokters)}`
                temuDokterResult.innerHTML = ``

                
                // {
                //     "idreservasi_dokter":219,
                //     "status":"W",
                //     "no_urut":2,
                //     "waktu_daftar":"2025-10-04 18:52:40",
                //     "pet":"Agus",
                //     "resepsionis":"resp. Rani Tinawiranti",
                //     "pemilik":"Budiman"
                // }
                temuDokters.forEach(temuDokter => {
                    temuDokterResult.innerHTML += `
                        <div class="mb-3">
                            <a href="/perawat/create-rekam/${temuDokter.idreservasi_dokter}" class="text-decoration-none text-dark card-link-hover">
                                <div class="card shadow-sm card-hover p-3">

                                    <h5 class="fw-bold mb-3 text-primary">
                                        ID Reservasi Dokter #${temuDokter.idreservasi_dokter}
                                    </h5>

                                    <div class="row row-cols-2 gy-2">

                                        <div>
                                            <strong>No Urut:</strong>
                                            <div class="text-muted">${temuDokter.no_urut}</div>
                                        </div>

                                        <div>
                                            <strong>Waktu Daftar:</strong>
                                            <div class="text-muted">${temuDokter.waktu_daftar}</div>
                                        </div>

                                        <div>
                                            <strong>Pet:</strong>
                                            <div class="text-muted">${temuDokter.pet}</div>
                                        </div>


                                        <div>
                                            <strong>Pemilik:</strong>
                                            <div class="text-muted">${temuDokter.pemilik}</div>
                                        </div>

                                        <div>
                                            <strong>Resepsionis:</strong>
                                            <div class="text-muted">${temuDokter.resepsionis}</div>
                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>
                    `
                });
            } catch (error) {
                temuDokterResult.innerHTML += `<em>${JSON.stringify(error)}</em>`
            }
        }
        const inputIdTemu = document.getElementById('input-id-temu')
        inputIdTemu.addEventListener('input', (e) => {getTemuDokter(e)})

    </script>
@endsection
