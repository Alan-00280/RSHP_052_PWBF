@extends('layouts.skydash.index')

@section('title', 'Kategori Kode Tindakan')

@section('content')
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ route('create-jenishewan-page') }}"
                role="button">
                <span class="mdi mdi-plus"></span>
                Tambah Kode Tindakan Terapi
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Klinis</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">ID Tindakan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kode Tindakan</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori Klinis</th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach ($therapies as $therapy)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->idkode_tindakan_terapi }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->kode }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->deskripsi_tindakan_terapi }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->Kategori->nama_kategori }}</td>
                        <td class="px-4 py-2 text-gray-800">{{ $therapy->KategoriKlinis->nama_kategori_klinis }}</td>
                        <td class="px-4 py-2 flex justify-center gap-2">
                            <button href="#" class="btn btn-primary p-2">
                                <span class="mdi mdi-content-save-outline"></span> Update</button>
                            <button href="#" class="btn btn-danger p-2 text-light">
                                <span class="mdi mdi-delete-outline"></span> Delete</button>
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
    {{-- @dd($therapies) --}}
