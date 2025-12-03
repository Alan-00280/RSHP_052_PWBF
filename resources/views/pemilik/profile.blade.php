@extends('layouts.skydash.index')

@section('title', 'Profil Pemilik')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$pemilik_data" /> --}}
    <div class="container">
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    
                    {{-- Profile Foto Card --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('images/user/bathGemini_Generated_Image_a70mpka70mpka70m.png') }}" alt="profile_img"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $pemilik_data->UserRshp->nama }}</h4>
                                    <p class="text-muted font-size-sm">{{ $pemilik_data->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3>Profil Lengkap</h3>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pemilik_data->UserRshp->nama }} 
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pemilik_data->UserRshp->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. Whatsapp</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pemilik_data->no_wa }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-black">
                                    {{ $pemilik_data->alamat }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection