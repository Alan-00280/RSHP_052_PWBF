@extends('layouts.skydash.index')

@section('title', 'Profil Dokter')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$perawat_data" /> --}}
    <div class="container">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    
                    {{-- Profile Foto Card --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('images/user/9e1b64a3a8797626e6a80b589c946e96.jpg') }}" alt="Admin"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $perawat_data->UserRshp->nama }}</h4>
                                    <p class="text-secondary mb-1">Perawat - {{ $perawat_data->pendidikan }}</p>
                                    <p class="text-muted font-size-sm">{{ $perawat_data->alamat }}</p>
                                </div>
                            </div>
                            <hr class="my-4">
                            {{-- Sosmed Links --}}
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-twitter mr-2 icon-inline text-info">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg> Twitter</h6>
                                    <span class="text-secondary">{{ '@twitter-account-here' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg> Instagram</h6>
                                    <span class="text-secondary">{{ '@instagram-account-here' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook mr-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg> Facebook</h6>
                                    <span class="text-secondary">{{ '@Facebook-account-here' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3>Profil Lengkap</h3>
                            </div>
                            {{-- {
                                "id_perawat": 1,
                                "alamat": "Jl Kertajaya Bagus no. 88, Perumahan Gebang Indah",
                                "no_hp": "0892112452",
                                "jenis_kelamin": "P",
                                "pendidikan": "D4 Veteriner",
                                "id_user": 59,
                                "user_rshp": {
                                    "iduser": 59,
                                    "nama": "Yuni Julianti",
                                    "email": "perawat@mail.com",
                                    "remember_token": null
                                }
                            } --}}
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $perawat_data->UserRshp->nama }} {{ $perawat_data->jenis_kelamin == 'L' ? '(Laki-laki)' : '(Perempuan)' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $perawat_data->UserRshp->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. Handphone</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $perawat_data->no_hp }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Pendidikan</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $perawat_data->pendidikan }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $perawat_data->alamat }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <a 
                                    class="btn btn-primary text-white" 
                                    href="{{ route('edit-profile-perawat') }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection