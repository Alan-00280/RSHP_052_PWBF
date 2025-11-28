@extends('layouts.skydash.index')

@section('title', 'Kategori Tindakan')
{{-- @dd($categories) --}}

@section('content')
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ route('create-jenishewan-page') }}"
                role="button">
                <span class="mdi mdi-plus"></span>
                Tambah Kategori
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Tindakan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                    <th class="px-6 py-3 text-left">ID</th>
                                    <th class="px-6 py-3 text-left">Kategori</th>
                                    <th class="px-6 py-3 text-left">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 font-medium">{{ $category->idkategori }}</td>
                                        <td class="px-6 py-4">{{ $category->nama_kategori }}</td>
                                        <td class="px-6 py-4 space-x-3">
                                            <a href="#" class="btn btn-primary p-2">
                                                <span class="mdi mdi-content-save-outline"></span> Update</a>
                                            <a href="#" class="btn btn-danger p-2 text-light">
                                                <span class="mdi mdi-delete-outline"></span> Delete</a>
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