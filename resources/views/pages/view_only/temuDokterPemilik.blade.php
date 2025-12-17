@extends('layouts.skydash.index')

@section('title', 'Temu Dokter')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$temu_dokters" /> --}}
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm mb-3">
                <h2>Daftar Temu Dokter</h2>
            </div>
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pet</th>
                        <th>Tanggal Lahir</th>
                        <th>Warna Tanda</th>
                        <th>Jenis Kelamin</th>
                        <th>Temu Dokter</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($temu_dokters as $i => $pet)
                        <tr>
                            <td>{{ $i + 1 }}</td>

                            <td>{{ $pet->nama }}</td>

                            <td>{{ $pet->tanggal_lahir }}</td>

                            <td>{{ $pet->warna_tanda }}</td>

                            <td>
                                {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                            </td>

                            <td>
                                @if ($pet->TemuDokter)
                                    @php
                                        $status_txt = '';
                                        switch ($pet->TemuDokter->status) {
                                            case 'W':
                                                $status_txt = 'Waiting';
                                                break;
                                            case 'R':
                                                $status_txt = 'Terekam↗';
                                                break;
                                            case 'D':
                                                $status_txt = 'Selesai';
                                                break;
                                            default:
                                                $status_txt = 'err_undefined';
                                                break;
                                        }
                                    @endphp
                                    <div>
                                        <div class="mb-1"><strong>ID Reservasi:</strong> {{ $pet->TemuDokter->idreservasi_dokter }}</div>
                                        <div class="mb-1"><strong>No Urut:</strong> {{ $pet->TemuDokter->no_urut }}</div>
                                        <div class="mb-1"><strong>Waktu Daftar:</strong> {{ $pet->TemuDokter->waktu_daftar }}</div>
                                        <div class="mb-1"><strong>Status:</strong> @if ($pet->TemuDokter->status !== 'R')
                                            {{ $status_txt }}
                                        @else
                                            <a href="{{ route('detail-rekam-pemilik', ['id_temu_dokter' => $pet->TemuDokter->idreservasi_dokter]) }}" title="Pergi ke Rekam Medis↗">{{ $status_txt }}</a>
                                        @endif</div>
                                    </div>
                                @else
                                    <span class="badge bg-secondary">Belum Ada</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection