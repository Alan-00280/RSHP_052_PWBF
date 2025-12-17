@extends('layouts.skydash.index')

@section('title', 'Edit Pet')

@section('content')
    
    <h1>Edit Pet #{{ $id }}</h1>
    <a href="{{ route('pet') }}" class="btn btn-primary mb-2">Back</a>

    {{-- <x-logger :object="$pet_detail" /> --}}

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-header bg-primary text-white py-3">
            <h6 class="m-0">Informasi Pemilik</h6>
        </div>

        <div class="card-body">
            <div class="mb-2">
                <span class="text-muted d-block small">Nama Pemilik</span>
                <span class="fw-semibold">{{ $pet_detail->pemilik->user->nama }}</span>
            </div>

            <div class="mb-2">
                <span class="text-muted d-block small">Email</span>
                <span class="fw-semibold">{{ $pet_detail->pemilik->user->email }}</span>
            </div>

            <div class="mb-2">
                <span class="text-muted d-block small">Nomor WA</span>
                <span class="fw-semibold">{{ $pet_detail->pemilik->no_wa }}</span>
            </div>

            <div class="mb-2">
                <span class="text-muted d-block small">Alamat</span>
                <span class="fw-semibold">{{ $pet_detail->pemilik->alamat }}</span>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="position-fixed start-50 translate-middle-x mt-3 z-3" id="pop-message" style="top: 50px">
            <div class="alert alert-success shadow">
                <strong>{{ session('success') }}</strong>
            </div>
        </div>
    @endif

    <form action="{{ route('update-pet', ['id'=>$id]) }}" method="POST">

        @csrf
        @method('PATCH')

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-header bg-primary text-white py-3">
                <h6 class="m-0" id="form-title">Edit Pet</h6>
            </div>

            <div class="card-body">

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama <span class="mdi mdi-pencil"></span></label>
                    <input 
                        type="text" 
                        name="nama" 
                        class="form-control"
                        value="{{ $pet_detail->nama }}"
                    >
                    @error('nama')
                        <x-error-box message="{{ $message }}" />
                    @enderror
                </div>

                {{-- Jenis Ras (disabled) --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Ras</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="{{ $pet_detail->rasHewan->jenisHewan->nama_jenis_hewan }} - {{ $pet_detail->rasHewan->nama_ras }}"
                        disabled
                    >
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir <span class="mdi mdi-pencil"></span></label>
                    <input 
                        type="date" 
                        name="tanggal_lahir" 
                        class="form-control"
                        value="{{ $pet_detail->tanggal_lahir }}"
                    >
                    @error('tanggal_lahir')
                        <x-error-box message="{{ $message }}" />
                    @enderror
                </div>

                {{-- Warna Tanda --}}
                <div class="mb-3">
                    <label class="form-label">Warna Tanda <span class="mdi mdi-pencil"></span></label>
                    <input 
                        type="text" 
                        name="warna_tanda" 
                        class="form-control"
                        value="{{ $pet_detail->warna_tanda }}"
                    >
                    @error('warna_tanda')
                        <x-error-box message="{{ $message }}" />
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin <span class="mdi mdi-pencil"></span></label>
                    <select name="jenis_kelamin" class="form-select text-black">
                        <option value="J" {{ $pet_detail->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ $pet_detail->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <x-error-box message="{{ $message }}" />
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-info px-4 text-white" onclick="changeFormTitleStarred(true)">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>

            </div>
        </div>

    </form>


    {{-- {
        "idpet": 5,
        "nama": "Wyuufi",
        "tanggal_lahir": "2025-03-06",
        "warna_tanda": "Coklat",
        "jenis_kelamin": "J",
        "idpemilik": 14,
        "idras_hewan": 33,
        "pemilik": {
            "idpemilik": 14,
            "no_wa": "08571442562",
            "alamat": "Jl. Adem Ayem Gg VII 10 No. 90, Kec. Kertagung, Kab. Jember",
            "iduser": 54,
            "user": {
                "iduser": 54,
                "nama": "Herman Firmansyah",
                "email": "firmansyah@mail.com",
                "remember_token": null
            }
        },
        "ras_hewan": {
            "idras_hewan": 33,
            "nama_ras": "Parkit (Budgerigar \/ Melopsittacus undulatus)",
            "idjenis_hewan": 4,
            "jenis_hewan": {
                "idjenis_hewan": 4,
                "nama_jenis_hewan": "Burung"
            }
        }
    } --}}

@endsection

@section('page-script')
<script>
    setTimeout(() => {
        const el = document.getElementById('pop-message');
        if (el) {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = 0;
            setTimeout(() => el.remove(), 500);
        }
    }, 500);

    const changeFormTitleStarred = (reset = false) => {

        const formTitle = document.getElementById('form-title');
        if (reset) {
            return formTitle.innerText = 'Edit Pet';
        }
        formTitle.innerText = (formTitle.innerText.includes('*')) ? formTitle.innerText : formTitle.innerText + '*';
    }

    const inputFields = document.querySelectorAll('input:not([disabled])').forEach(field=>{field.addEventListener('input', () => changeFormTitleStarred())})

    const selectFields = document.querySelectorAll('select').forEach(field=>{field.addEventListener('change', () => changeFormTitleStarred())})
</script>
@endsection