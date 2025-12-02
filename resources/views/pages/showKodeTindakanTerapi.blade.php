@extends('layouts.skydash.index')

@section('title', 'Detail Rekam Medis')

@section('content')

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard
            </a>
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
               href="{{ route('kategori-tindakan-terapi') }}" role="button">Back
            </a>
        </div>
    </div>

    {{-- <x-logger :object="$tindakan_detail" /> --}}
        {{-- {
        "idkode_tindakan_terapi": 37,
        "kode": "T37",
        "deskripsi_tindakan_terapi": "Vaksinasi Rumah Kaca",
        "idkategori": 2,
        "idkategori_klinis": 1,
        "kategori": {
            "idkategori": 2,
            "nama_kategori": "Bedah \/ Operasi"
        },
        "kategori_klinis": {
            "idkategori_klinis": 1,
            "nama_kategori_klinis": "Terapi"
        }
    } --}}

    {{-- <x-logger :object="$kategories" /> --}}
    {{-- <x-logger :object="$kategori_klinises" /> --}}
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <strong id="form-title">Edit Kode Tindakan #{{ $tindakan_detail->idkode_tindakan_terapi }}</strong>
        </div>
        <div class="card-body">

            <form action="{{ route('update-kode-tindakan', ['id' => $tindakan_detail->idkode_tindakan_terapi]) }}" method="POST">
                @csrf
                @method('PATCH')

                {{-- Kode --}}
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" 
                        name="kode" 
                        class="form-control" 
                        value="{{ $tindakan_detail['kode'] }}" 
                        disabled
                    >
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Tindakan Terapi</label>
                    <textarea name="deskripsi_tindakan_terapi" 
                            class="form-control" 
                            rows="3" 
                            required>{{ $tindakan_detail['deskripsi_tindakan_terapi'] }}</textarea>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="idkategori" class="form-select text-black"  required>
                        @if ($kategories)
                        @foreach ($kategories as $kategori)
                            <option value="{{ $kategori->idkategori }}" class="text-black" selected="{{ $kategori->idkategori == $tindakan_detail->Kategori->idkategori ? 'true' : 'false' }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                {{-- Kategori Klinis --}}
                <div class="mb-4">
                    <label class="form-label">Kategori Klinis</label>
                    <select name="idkategori_klinis" class="form-select text-black" required>
                        @if ($kategori_klinises)
                        @foreach ($kategori_klinises as $kategori_klinis)
                            <option value="{{ $kategori_klinis->idkategori_klinis }}" class="text-black" selected="{{ $tindakan_detail->KategoriKlinis->idkategori_klinis == $kategori_klinis->idkategori_klinis ? 'true' : 'false' }}">{{ $kategori_klinis->nama_kategori_klinis }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary px-4" onclick="changeFormTitleStarred(true)">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('page-script')
<script>
    const changeFormTitleStarred = (reset = false) => {
        const formTitle = document.getElementById('form-title');
        if (reset) {
            return formTitle.innerText = 'Edit Kode Tindakan';
        }
        formTitle.innerText = (formTitle.innerText.includes('*')) ? formTitle.innerText : formTitle.innerText + '*';
    }

    const inputFields = document.querySelectorAll('input:not([disabled])').forEach(field=>{field.addEventListener('input', () => changeFormTitleStarred())})

    const textAreas = document.querySelectorAll('textarea:not([disabled])').forEach(field=>{field.addEventListener('input', () => changeFormTitleStarred())})

    const selectFields = document.querySelectorAll('select').forEach(field=>{field.addEventListener('change', () => changeFormTitleStarred())})
</script>
@endsection