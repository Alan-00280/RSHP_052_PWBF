@extends('layouts.skydash.index')

@section('title', 'Kategori Kode Tindakan')

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
                Tambah Kode Tindakan Terapi
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kode Tindakan Terapi</h4>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Tindakan</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Kode Tindakan</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Deskripsi</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori Klinis</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($therapies as $therapy)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-2 text-gray-800">{{ $therapy->idkode_tindakan_terapi }}</td>
                                    <td class="px-4 py-2 text-gray-800">{{ $therapy->kode }}</td>
                                    <td class="px-4 py-2 text-gray-800">{{ $therapy->deskripsi_tindakan_terapi }}</td>
                                    <td class="px-4 py-2 text-gray-800">{{ $therapy->Kategori->nama_kategori }}</td>
                                    <td class="px-4 py-2 text-gray-800">{{ $therapy->KategoriKlinis->nama_kategori_klinis }}</td>
                                    <td class="px-4 py-2 flex justify-center gap-2">
                                        <a href="{{ route('edit-kode-tindakan', ['id' => $therapy->idkode_tindakan_terapi]) }}" class="btn btn-primary p-2">
                                            <span class="mdi mdi-pencil"></span> Update</a>
                                        <button 
                                            data-id="{{ $therapy->idkode_tindakan_terapi }}"
                                            data-kode="{{ $therapy->kode }}"
                                            class="btn btn-danger text-white btn-delete p-2"
                                            role="button" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirm-delete-model"
                                        >
                                            <span class="mdi mdi-delete-outline"></span> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <div style="width: 45vw">
                            {{ $therapies->links() }}
                        </div>
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
                        Yakin menghapus kode tindakan <strong id="kodeTindakan"></strong>? 
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
                <form action="{{ route('create-kode-tindakan') }}" method="POST" id="modal-create-form"> 
                    @csrf 
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Kategori</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="inputKategori" class="form-label">Kategori*</label> 
                            <select name="idkategori" class="form-select text-black" id="inputKategori" required>
                                <option value="" class="text-black" selected>-- Pilih Kategori --</option>
                                @foreach ($kategories as $kategori)
                                    <option value="{{ $kategori->idkategori }}" class="text-black">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div id="kategoriHelp" class="form-text">Pilih Kategori Tindakan di sini</div>
                        </div>
                        <div class="mb-3"> <label for="inputKategoriKlinis" class="form-label">Kategori Klinis*</label> 
                            <select name="idkategori_klinis" class="form-select text-black" id="inputKategoriKlinis" required>
                                <option value="" class="text-black" selected>-- Pilih Kategori Klinis--</option>
                                @foreach ($kategori_klinises as $kategori_klinis)
                                    <option value="{{ $kategori_klinis->idkategori_klinis }}" class="text-black">{{ $kategori_klinis->nama_kategori_klinis }}</option>
                                @endforeach
                            </select>
                            <div id="kategoriHelp" class="form-text">Pilih Kategori Klinis Tindakan di sini</div>
                        </div>
                        <div class="mb-3"> <label for="inputDeskripsi" class="form-label">Deskripsi*</label> 
                            <textarea class="form-control" id="inputDeskripsi" aria-describedby="deskripsiHelp" rows="3" name="deskripsi_tindakan_terapi" required></textarea>
                            <div id="deskripsiHelp" class="form-text">Input Deskripsi Tindakan di sini</div>
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
            const kodeTindakan= document.getElementById('kodeTindakan')
            
            deleteButton.forEach(btn => {
                btn.addEventListener('click', (e)=> {
                const id = e.currentTarget.dataset.id
                const kode = e.currentTarget.dataset.kode

                formDelete.action = `/delete-kode-tindakan/${id}`;
                kodeTindakan.innerText = kode;
                })
            });
            
        })

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
            })
    </script>
@endsection
