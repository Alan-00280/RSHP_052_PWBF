@extends('layouts.skydash.index')

@section('title', 'Detail Rekam Medis')

@section('content')
    
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard
            </a>
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('rekam-medis') }}" role="button">Back
            </a>
        </div>
        
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
                    <p class="mb-1"><strong>Nama:</strong> {{ $temu_dokter->pet->nama }}</p>
                    <p class="mb-1"><strong>Jenis Hewan:</strong> {{ $temu_dokter->pet->RasHewan->JenisHewan->nama_jenis_hewan }}</p>
                    <p class="mb-1"><strong>Ras:</strong> {{ $temu_dokter->pet->RasHewan->nama_ras }}</p>
                    <p class="mb-1"><strong>Warna:</strong> {{ $temu_dokter->pet->warna_tanda }}</p>
                </div>

                {{-- PEMILIK --}}
                <div class="col-md-6">
                    <h6 class="fw-bold">Pemilik</h6>
                    <p class="mb-1"><strong>Nama:</strong> {{ $temu_dokter->pet->pemilik->user->nama }}</p>
                    <p class="mb-1"><strong>No. WA:</strong> {{ $temu_dokter->pet->pemilik->no_wa }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $temu_dokter->pet->pemilik->alamat }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <strong>Rekam Medis</strong>
        </div>
        <div class="card-body">
                <div class="mb-3">
                    <h4 class="fw-bold">ID Temu Dokter <span style="color: rgb(255, 56, 56)">#{{ $temu_dokter['idreservasi_dokter'] }}</span></h4>
                </div>
            <form action="{{ route('create-rekam-medis') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="input-dokter" class="form-label">Dokter Pemeriksa</label> 
                    <select class="form-select text-black" id="input-dokter" name="iddokter" aria-label="Default select example" required>
                        <option class="text-black" value="" selected>-- Pilih Dokter Pemeriksa --</option>
                        @if ($dokters)
                        @foreach ($dokters as $dokter)
                            <option class="text-black" value="{{ $dokter->RoleUser[0]->idrole_user }}">{{ $dokter->nama }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <h4 class="fw-bold">Anamnesa<span style="color: rgb(255, 56, 56)">*</span></h4>
                    <textarea class="border rounded p-2 bg-light" style="white-space: pre-wrap; display: block; width: 100%;" name="anamnesa" rows="4" aria-describedby="anamnesaHelp" required></textarea>
                    <div id="anamnesaHelp" class="form-text">Tuliskan data anamnesa di atas</div>
                </div>

                <div class="mb-3">
                    <h4 class="fw-bold">Temuan Klinis<span style="color: rgb(255, 56, 56)">*</span></h4>
                    <textarea class="border rounded p-2 bg-light" style="white-space: pre-wrap; display: block; width: 100%;" name="temu_klinis" rows="4" aria-describedby="temuanHelp" required></textarea>
                    <div id="temuanHelp" class="form-text">Tuliskan temuan klinis di atas</div>
                </div>

                <div class="mb-3">
                    <h4 class="fw-bold">Diagnosa<span style="color: rgb(255, 56, 56)">*</span></h4>
                    <textarea class="border rounded p-2 bg-light" style="white-space: pre-wrap; display: block; width: 100%;" name="diagnosa" rows="4" aria-describedby="diagnosaHelp" required></textarea>
                    <div id="diagnosaHelp" class="form-text">Tuliskan diagnosa di atas</div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <input type="hidden" name="idreservasi_dokter" value="{{ $temu_dokter['idreservasi_dokter'] }}">
                    <button type="reset" class="btn btn-info px-4 text-white">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection