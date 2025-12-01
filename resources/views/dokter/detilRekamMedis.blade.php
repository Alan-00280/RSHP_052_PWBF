@extends('layouts.skydash.index')

@section('title', 'Detail Rekam Medis')

@section('content')

    <x-successAlert :message="session('success')" />

    @if(session('error')){
        <x-error-alert :errors="session('error')" type="global" />
    }
    @endif

    <x-error-alert :errors="$errors" />

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard
            </a>
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                onclick="window.history.back()" role="button">Back
            </a>
        </div>
        {{-- <x-logger :object="$rekam" /> --}}
        {{-- <x-logger :object="$detil_rekam_medis" /> --}}
        
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Informasi Pasien</strong>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- PET --}}
                <div class="col-md-6">
                    <h6 class="fw-bold">Data Hewan</h6>
                    <p class="mb-1"><strong>Nama:</strong> {{ $rekam->TemuDokter->pet->nama }}</p>
                    <p class="mb-1"><strong>Jenis Hewan:</strong> {{ $rekam->TemuDokter->pet->RasHewan->JenisHewan->nama_jenis_hewan }}</p>
                    <p class="mb-1"><strong>Ras:</strong> {{ $rekam->TemuDokter->pet->RasHewan->nama_ras }}</p>
                    <p class="mb-1"><strong>Warna:</strong> {{ $rekam->TemuDokter->pet->warna_tanda }}</p>
                </div>

                {{-- PEMILIK --}}
                <div class="col-md-6">
                    <h6 class="fw-bold">Pemilik</h6>
                    <p class="mb-1"><strong>Nama:</strong> {{ $rekam->TemuDokter->pet->pemilik->user->nama }}</p>
                    <p class="mb-1"><strong>No. WA:</strong> {{ $rekam->TemuDokter->pet->pemilik->no_wa }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $rekam->TemuDokter->pet->pemilik->alamat }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekam mwedis --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <strong id="edit-rekam-form" style="display: inline-block">[Edit] Rekam Medis #{{ $rekam->idrekam_medis }}</strong>
            [
            <div>
                <button 
                    class="btn btn-danger text-white btn-delete p-2"
                    role="button" 
                    data-bs-toggle="modal"
                    data-bs-target="#confirm-delete-rekam"
                    ><span class="mdi mdi-delete-outline"></span> Delete
                </button>
            </div>
            ]
        </div>
        <div class="card-body">
            <p><strong>Tanggal Pemeriksaan:</strong> {{ $rekam->created_at }}</p>
            <form action="{{ route('update-rekam-medis', ['id'=>$rekam->idrekam_medis]) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="fw-bold">Anamnesa:</label>
                <textarea class="border rounded p-2 bg-light textarea-rekam" style="white-space: pre-wrap; display: block; width: 100%;" name="anamnesa" rows="8" aria-describedby="anamnesaHelp" required>{{ $rekam->anamnesa }}</textarea>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Temuan Klinis:</label>
                <textarea class="border rounded p-2 bg-light textarea-rekam" style="white-space: pre-wrap; display: block; width: 100%;" name="temu_klinis" rows="4" aria-describedby="temuanHelp" required>{{ $rekam->temuan_klinis }}</textarea>
            </div>

            <div>
                <label class="fw-bold">Diagnosa:</label>
                <textarea class="border rounded p-2 bg-light textarea-rekam" style="white-space: pre-wrap; display: block; width: 100%;" name="diagnosa" rows="4" aria-describedby="diagnosaHelp" required>{{ $rekam->diagnosa }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                [<button type="reset" class="btn btn-info px-4 text-white" onclick="changeFormTitleStarredRekam(true)">Reset</button>
                <button type="submit" class="btn btn-primary px-4">Simpan</button>]
            </div>
            </form>
        </div>
    </div>

    {{-- Detil Rekam Medis --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <strong>Detail Tindakan Terapi</strong>

            {{-- Tambah Tindakan --}}
            (<button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDetilRekam">
                + Tambah Tindakan
            </button>)
        </div>

        {{-- Createdetil-Modal --}}
        <div class="modal fade" id="modalTambahDetilRekam">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('create-detil-rekam-medis', ['id_rekam' => $rekam->idrekam_medis]) }}" method="POST" id="form-create-detil-rekam">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Detail Tindakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Kode Tindakan</label>
                                <select name="idkode_tindakan_terapi" class="form-select text-black"  required>
                                    <option class="text-black" value="" selected>-- Pilih Tindakan --</option>
                                    @if ($tindakans)
                                    @foreach ($tindakans as $tindakan)
                                        <option class="text-black" value="{{$tindakan->idkode_tindakan_terapi}}">{{ $tindakan->kode }} - {{ $tindakan->deskripsi_tindakan_terapi }} - {{ $tindakan->nama_kategori_klinis }} {{ $tindakan->nama_kategori }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Detail</label>
                                <textarea name="detail" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Kode</th>
                        <th>Deskripsi Tindakan</th>
                        <th>Detail</th>
                        <th style="width: 130px;">(Aksi)</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($detil_rekam_medis as $idx => $d)
                    <tr>
                        <td>{{ \intval($idx) + 1 }}</td>
                        <td>{{ $d->KodeTindakanTerapi->kode }}</td>
                        <td>{{ $d->KodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                        <td>{{ $d->detail }}</td>

                        <td>
                            <div class="btn-group">
                                {{-- Edit --}}
                                (<button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $d->iddetail_rekam_medis }}">
                                    Edit
                                </button>

                                {{-- Delete --}}
                                <button class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $d->iddetail_rekam_medis }}">
                                    Hapus
                                </button>)
                            </div>
                        </td>
                    </tr>

                    {{-- Edit-Modal --}}
                    <div class="modal fade modal-edit" id="modalEdit{{ $d->iddetail_rekam_medis }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('update-detil-rekam', ['id'=>$d->iddetail_rekam_medis]) }}" method="POST" class="form-edit">
                                    @csrf
                                    @method('PATCH')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="form-title">Edit Detail Tindakan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Kode Tindakan</label>
                                            {{-- <x-logger :object="$tindakans" /> --}}
                                            <select name="idkode_tindakan_terapi" class="form-select text-black">
                                                @if ($tindakans)
                                                @foreach ($tindakans as $tindakan)
                                                    <option class="text-black" value="{{$tindakan->idkode_tindakan_terapi}}" {{ $tindakan->idkode_tindakan_terapi == $d->KodeTindakanTerapi->idkode_tindakan_terapi ? 'selected' : '' }}>{{ $tindakan->kode }} - {{ $tindakan->deskripsi_tindakan_terapi }} - {{ $tindakan->nama_kategori_klinis }} {{ $tindakan->nama_kategori }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Detail</label>
                                            <textarea name="detail" class="form-control" rows="3">{{ $d->detail }}</textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete-Modal --}}
                    <div class="modal fade" id="modalDelete{{ $d->iddetail_rekam_medis }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('delete-detil-rekam', ['id' => $d->iddetail_rekam_medis]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger">Hapus Tindakan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus tindakan <strong>{{ $d->KodeTindakanTerapi->kode }}</strong>?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('modal')
    {{-- Modal Confirm Delete Rekam  --}}
    <div class="modal fade" id="confirm-delete-rekam" tabindex="-1" aria-labelledby="confirm-delete-rekam" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirm-delete-rekam">Hapus kategori</h1> <button type="button"
                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Yakin menghapus Rekam Medis #<strong id="idRekamMedis">{{ $rekam->idrekam_medis }}</strong>? 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal" id="close-modal">Batal</button>
                    <form action="{{ route('delete-rekam-medis', ['id'=>$rekam->idrekam_medis]) }}" method="post" id="form-delete">
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
    // Reset form saat nutup modal create detil rekam
    const modalForm = document.getElementById('form-create-detil-rekam')
    document.getElementById('modalTambahDetilRekam')
        .addEventListener('hidden.bs.modal', () => {
            modalForm.reset()
        })

    // ubah judul form edit detil
    const changeFormTitleStarred = (modal, reset = false) => {
        const formTitle = modal.querySelector('#form-title');
        if (reset) {
            return formTitle.innerText = 'Edit Detail Tindakan';
        }
        formTitle.innerText = (formTitle.innerText.includes('*')) ? formTitle.innerText : formTitle.innerText + '*';
    }

    // setting modal edit detil rekam
    document.querySelectorAll('.modal-edit')
        .forEach(modal=>{
            modal.addEventListener('hidden.bs.modal', () => {
                changeFormTitleStarred(modal, true);
                modal.querySelector('.form-edit').reset()
            })
            modal.querySelectorAll('textarea:not([disabled])').forEach(field=>{field.addEventListener('input', () => changeFormTitleStarred(modal))})
            document.querySelectorAll('select').forEach(field=>{field.addEventListener('change', () => changeFormTitleStarred(modal))})
        })

    //setting edit form rekam
    const changeFormTitleStarredRekam = (reset = false) => {
        const formTitle = document.getElementById('edit-rekam-form');
        if (reset) {
            window.location.href = '#';
            return formTitle.innerText = 'Edit Rekam Medis';
        }
        formTitle.innerText = (formTitle.innerText.includes('*')) ? formTitle.innerText : formTitle.innerText + '*';
    }
    const textareaFieldsRekam = document.querySelectorAll('textarea:not([disabled]).textarea-rekam').forEach(field=>{field.addEventListener('input', () => changeFormTitleStarredRekam())})


</script>
@endsection