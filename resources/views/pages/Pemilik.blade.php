@extends('layouts.skydash.index')

@section('title', 'Pemilik')

@section('content')
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" 
                id="" 
                class="btn btn-success mb-3 text-light" 
                href="{{ '#' }}" 
                role="button" 
                data-bs-toggle="modal"
                data-bs-target="#createModal">
                <span class="mdi mdi-plus"></span>
                Daftarkan Pemilik
            </a>
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
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
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
                                    <form action="{{ route('update-pemilik', ['id' => $pemilik->idpemilik]) }}"
                                        id="pemilik-data-{{ $pemilik->idpemilik }}"
                                        name="pemilik-data-{{ $pemilik->idpemilik }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-2 text-gray-800" id="id-{{ $pemilik->idpemilik }}">
                                            {{ $pemilik->idpemilik }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <input type="text" name="nama" class="form-control p-2" style="width: 200px"
                                                    oninput="changeIdStarred('{{ $pemilik->idpemilik }}')"
                                                    value="{{ $pemilik->user->nama }}" id="nama-{{ $pemilik->idpemilik }}">
                                                <span class="mdi mdi-pencil mx-2"></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <input type="text" name="email" class="form-control p-2"
                                                    style="width: 200px"
                                                    oninput="changeIdStarred('{{ $pemilik->idpemilik }}')"
                                                    value="{{ $pemilik->user->email }}"
                                                    id="email-{{ $pemilik->idpemilik }}">
                                                <span class="mdi mdi-pencil mx-2"></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <input type="text" name="no_wa" class="form-control p-2"
                                                    style="width: 200px"
                                                    oninput="changeIdStarred('{{ $pemilik->idpemilik }}')"
                                                    value="{{ $pemilik->no_wa }}" id="wa-{{ $pemilik->idpemilik }}">
                                                <span class="mdi mdi-pencil mx-2"></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800" style="min-width: 400px">
                                            <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                <textarea name="alamat" class="form-control w-100"
                                                    id="alamat-{{ $pemilik->idpemilik }}"
                                                    oninput="changeIdStarred('{{ $pemilik->idpemilik }}')"
                                                    rows="4">{{ $pemilik->alamat }}</textarea>
                                                <span class="mdi mdi-pencil mx-2"></span>
                                            </div>
                                        </td>
                                    </form>
                                    <td class="px-4 py-2 flex justify-center gap-2">
                                        <button form="pemilik-data-{{ $pemilik->idpemilik }}" type="submit"
                                            class="btn btn-primary">
                                            <span class="mdi mdi-content-save-outline"></span> Update
                                        </button>
                                        <form action="" id="delete-pemilik-{{ $pemilik->idpemilik }}"
                                            name="delete-pemilik-{{ $pemilik->idpemilik }}" method="post">
                                            <button form="pemilik-data-{{ $pemilik->idpemilik }}" type="submit"
                                                class="btn btn-danger text-white"><span
                                                    class="mdi mdi-delete-outline"></span></button>
                                        </form>
                                        <button form="pemilik-data-{{ $pemilik->idpemilik }}" type="reset"
                                            class="btn btn-primary"
                                            onclick="changeIdStarred('{{ $pemilik->idpemilik }}', true)">
                                            <span class="mdi mdi-backup-restore"></span>
                                        </button>
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
    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('create-pemilik') }}" method="POST" id="modal-create-form"> 
                    @csrf 
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Daftarkan Pemilik</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="inputNama" class="form-label">Nama*</label> 
                            <input type="text" class="form-control" id="inputNama" aria-describedby="namaHelp" name="nama" required>
                            <div id="namaHelp" class="form-text">Input nama lengkap pemilik di sini</div>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="inputWA" class="form-label">No. Whatsapp*</label> 
                            <input type="text" class="form-control" id="inputWA" aria-describedby="waHelp" name="no_wa" required>
                            <div id="waHelp" class="form-text">Input Nomor WhatsApp pemilik di sini</div>
                            @error('no_wa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="inputEmail" class="form-label">Email*</label> 
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="email" required>
                            <div id="emailHelp" class="form-text">Input Alamat Email pemilik di sini</div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="inputAlamat" class="form-label">Alamat*</label> 
                            <textarea class="form-control" id="inputAlamat" aria-describedby="alamatHelp" rows="10" name="alamat" required></textarea>
                            <div id="alamatHelp" class="form-text">Input Alamat tinggal pemilik di sini</div>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection

@section('page-script')
    <script>
        const changeIdStarred = (id, reset = false) => {
            const idNumber = document.getElementById('id-' + id);
            if (reset) {
                return idNumber.innerText = id;
            }
            idNumber.innerText = (idNumber.innerText.includes('*')) ? idNumber.innerText : idNumber.innerText + '*';
        }
        const resetInputs = (inputField, def, id) => {
            try {
                const inputFieldDOM = document.getElementById(inputField + '-' + id);
                inputFieldDOM.value = def;
            } catch (error) {
                console.log(error)
            }
        }

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
            })
    </script>
@endsection