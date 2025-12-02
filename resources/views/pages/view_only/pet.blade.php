@extends('layouts.skydash.index')

@section('title', 'Pet Pemilik')

@section('content')

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                {{-- <x-logger :object="$pets" /> --}}
                <div class="card-body">
                    <h4 class="card-title">Data Ras Hewan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Pet</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Pemilik</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Pet</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis Ras</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Lahir</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Warna Tanda</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis Kelamin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($pets as $pet)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-2 text-gray-800">{{ $pet->idpet }}</td>
                                        <td class="px-4 py-2 text-gray-800">{{ $pet->Pemilik->User->nama }}</td>
                                        <td class="px-4 py-2 text-gray-800">{{ $pet->nama }}</td>
                                        <td class="px-4 py-2 text-gray-800">
                                            <span style="width: 15vw; display: block; white-space: normal; overflow-wrap: break-word;">
                                                {{ $pet->rasHewan->nama_ras }} - {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-gray-800">{{ $pet->tanggal_lahir }}</td>
                                        <td class="px-4 py-2 text-gray-800">{{ $pet->warna_tanda ?? '-' }}</td>
                                        <td class="px-4 py-2">
                                            @if ($pet->jenis_kelamin === 'J')
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                                    Jantan
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-pink-700 bg-pink-100 rounded-full">
                                                    Betina
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
