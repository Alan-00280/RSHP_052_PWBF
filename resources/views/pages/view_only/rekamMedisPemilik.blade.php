@extends('layouts.skydash.index')

@section('title', 'Rekam Medis')
{{-- @dd($categories) --}}

@section('content')
    {{-- <x-logger :object="$rekam_medises" /> --}}
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm mb-3">
                <h2>Daftar Rekam Medis</h2>
            </div>

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pet</th>
                        <th>Jenis Kelamin</th>
                        <th>Rekam Medis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rekam_medises as $i => $pet)
                        <tr>
                            <td>{{ $i + 1 }}</td>

                            <td>{{ $pet->nama }}</td>

                            <td>
                                {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                            </td>

                            <td>
                                @if ($pet->TemuDokter && $pet->TemuDokter->RekamMedis)
                                    @php $rm = $pet->TemuDokter->RekamMedis; @endphp

                                    <div>
                                        <div class="mb-2"><strong>ID RM:</strong> {{ $rm->idrekam_medis }}</div>
                                        <div class="mb-2"><strong>Tanggal:</strong> {{ $rm->created_at }}</div>
                                        <div class="mb-2"><strong>Diagnosa:</strong>
                                            <span title="{{ $rm->diagnosa }}">
                                                {{ Str::limit($rm->diagnosa, 30) }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge bg-secondary">Tidak Ada</span>
                                @endif
                            </td>

                            <td>
                                @if ($pet->TemuDokter && $pet->TemuDokter->RekamMedis)
                                    @php $tm = $pet->TemuDokter; @endphp
                                    <a href="{{ route('detail-rekam-pemilik', ['id_temu_dokter' => $tm->idreservasi_dokter]) }}"
                                    class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>
                                        Detail
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection