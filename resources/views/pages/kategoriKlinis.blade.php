@extends('layouts.skydash.index')

@section('title', 'Kategori Klinis')

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
                Tambah Kategori
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Klinis</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                    <th class="px-6 py-3 text-left">ID Kategori Klinis</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($kategoriClinises as $kategoriClinis)
                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors duration-150">

                        <td class="px-6 py-4 font-medium" id="id-{{ $kategoriClinis->idkategori_klinis }}">{{ $kategoriClinis->idkategori_klinis }}</td>
                        
                        {{-- route('#', ['id' => $kategoriClinis->idkategori_klinis]) --}}
                        <form 
                            action="{{ route('update-kategori-klinis', ['id' => $kategoriClinis->idkategori_klinis]) }}" 
                            id="form-update-{{ $kategoriClinis->idkategori_klinis }}" 
                            method="post"
                        >
                            @csrf
                            @method('PATCH')
                            <td class="px-6 py-4">
                                <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                    <input type="text" name="nama" class="form-control p-2" 
                                        style="width: 200px"
                                        oninput="changeIdStarred('{{ $kategoriClinis->idkategori_klinis }}')"
                                        value="{{ $kategoriClinis->nama_kategori_klinis }}" id="nama-{{ $kategoriClinis->idkategori_klinis }}"
                                        required>
                                    <span class="mdi mdi-pencil mx-2"></span>
                                </div>
                            </td>
                        </form>

                        <td class="px-6 py-4 space-x-3">
                            <button 
                                form="form-update-{{ $kategoriClinis->idkategori_klinis }}" 
                                type="submit"
                                class="btn btn-primary p-2"
                            >
                                <span class="mdi mdi-content-save-outline"></span> Update
                            </button>
                            
                            {{-- Reset --}}
                            <button form="form-update-{{ $kategoriClinis->idkategori_klinis }}"  
                                type="reset"
                                class="btn btn-primary p-2"
                                onclick="changeIdStarred('{{ $kategoriClinis->idkategori_klinis }}', true)">
                                <span class="mdi mdi-backup-restore"></span> Reset
                            </button>
                            
                            {{-- Delete buton --}}
                            <button 
                            data-id="{{ $kategoriClinis->idkategori_klinis }}"
                            data-nama="{{ $kategoriClinis->nama_kategori_klinis }}"
                            class="btn btn-danger text-white btn-delete p-2"
                            role="button" 
                            data-bs-toggle="modal"
                            data-bs-target="#confirm-delete-model"
                            ><span class="mdi mdi-delete-outline"></span>
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
                        Yakin menghapus kategori <strong id="tindakanNama"></strong>? 
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

    {{-- Modal Create --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('create-kategori-klinis') }}" method="POST" id="modal-create-form"> 
                    @csrf 
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Tindakan</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="inputNama" class="form-label">Nama Tindakan*</label> 
                            <input type="text" class="form-control" id="inputNama" aria-describedby="namaHelp" name="nama" required>
                            <div id="namaHelp" class="form-text">Input nama tindakan di sini</div>
                            @error('nama')
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
        document.addEventListener('DOMContentLoaded', (e) => {
            const deleteButton = document.querySelectorAll('.btn-delete')
            const formDelete = document.getElementById('form-delete')
            const tindakanNama = document.getElementById('tindakanNama')
            
            deleteButton.forEach(btn => {
                btn.addEventListener('click', (e)=> {
                const id = e.currentTarget.dataset.id
                const nama = e.currentTarget.dataset.nama

                formDelete.action = `/delete-kategori-klinis/${id}`;
                tindakanNama.innerText = nama;
                })
            });
            
        })

        const changeIdStarred = (id, reset = false) => {
            const idNumber = document.getElementById('id-' + id);
            if (reset) {
                return idNumber.innerText = id;
            }
            idNumber.innerText = (idNumber.innerText.includes('*')) ? idNumber.innerText : idNumber.innerText + '*';
        }

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
            })
    </script>
@endsection