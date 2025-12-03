@extends('layouts.skydash.index')

@section('title', 'Profil Dokter')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$perawat_data" /> --}}
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm mb-3">
                <h2>Daftar Pet Anda</h2>
            </div>

            {{-- json_encode($pets) --}}
            {{-- [
                {   
                    "idpet":9,
                    "nama":"Kuuro",
                    "tanggal_lahir":"2025-07-09",
                    "warna_tanda":"Cokelat Pink",
                    "jenis_kelamin":"J",
                    "idpemilik":3,
                    "nama_ras":"Kura-kura Sulcata (African spurred tortoise)","nama_jenis_hewan":"Reptil"
                }
                ] --}}

            {{-- Pet Cards --}}
            @if ($pets)
            @foreach ($pets as $pet)
            @php
                $birthdate = $pet->tanggal_lahir;

                $today = new DateTime();       
                $dob   = new DateTime($birthdate);

                $diff = $today->diff($dob);

                $umur_tahun = $diff->y;
                $umur_bulan = $diff->m;
            @endphp
            <div class="row gutters-sm">
                {{-- Left profile card --}}
                <div class="col-md-4 mb-3">
                    <div class="card" style="height: 100%">
                        <div class="card-body" style="height: 100%">
                            <div class="d-flex flex-column align-items-center text-center" style="height: 100%;justify-content: space-around;">
                                <img src="{{ asset('images/pet/round9d1c6e003e24190e3a19a2c5f2956c40.jpg') }}" alt="pet_img"
                                    class="rounded-circle" width="200">
                                <div class="mt-3">
                                    <h4>{{ $pet->nama }}</h4>
                                    <p class="text-secondary mb-1">{{ $pet->nama_ras }}</p>
                                    <p class="text-muted font-size-sm"> @if ($umur_bulan > 0)
                                    {{ $umur_bulan }} bulan 
                                    @endif @if ($umur_tahun > 0)
                                    {{ $umur_tahun }} tahun
                                    @endif | {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</p>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>

                {{-- Right Keterangan card --}}
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3>Keterangan Lengkap</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pet->nama }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Warna Tanda</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pet->warna_tanda }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Jenis - Ras</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pet->nama_jenis_hewan }} - {{ $pet->nama_ras }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Jenis Kelamin</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tanggal Lahir</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pet->tanggal_lahir }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Umur</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    @if ($umur_bulan > 0)
                                    {{ $umur_bulan }} bulan 
                                    @endif 
                                    @if ($umur_tahun > 0)
                                    {{ $umur_tahun }} tahun
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
            @endif
            

        </div>
    </div>
@endsection