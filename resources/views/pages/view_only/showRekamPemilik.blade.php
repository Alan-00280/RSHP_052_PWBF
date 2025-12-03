@extends('layouts.skydash.index')

@section('title', 'Detail Rekam Medis')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$detail_rekam_medises" /> --}}
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm mb-3">
                <h2>Detail Rekam Medis</h2>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    Informasi Rekam Medis
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4"><strong>ID Rekam Medis:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->idrekam_medis }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Tanggal Dibuat:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->created_at }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Anamnesa:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->anamnesa }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Temuan Klinis:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->temuan_klinis }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Diagnosa:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->diagnosa }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>ID Reservasi Dokter:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->idreservasi_dokter }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Dokter Pemeriksa:</strong></div>
                        <div class="col-md-8">{{ $detail_rekam_medises->dokter_pemeriksa }}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-dark text-white">
                    Detail Tindakan & Terapi
                </div>
                <div class="card-body p-0">

                    <table class="table table-bordered table-striped mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>ID Detail</th>
                            <th>Kode Tindakan</th>
                            <th>Nama Tindakan</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($detail_rekam_medises->DetailRekamMedis as $i => $detail)
                            @php
                                $kode = $detail->KodeTindakanTerapi ?? null;
                                $kategori = $kode->kategori ?? null;
                            @endphp

                            <tr>
                                <td>{{ $i + 1 }}</td>

                                <td>{{ $detail->iddetail_rekam_medis }}</td>

                                <td>
                                    {{ $kode?->kode ?? '-' }}
                                </td>

                                <td>
                                    {{ $kode?->deskripsi_tindakan_terapi ?? '-' }}
                                </td>

                                <td>
                                    {{ $kategori?->nama_kategori ?? '-' }}
                                </td>

                                <td class="text-wrap"
                                    style="white-space: normal; max-width: 350px; word-break: break-word;">
                                    {{ $detail->detail }}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tidak ada detail rekam medis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                </div>
            </div>

        </div>
    </div>
@endsection