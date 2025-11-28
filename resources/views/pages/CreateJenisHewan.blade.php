@extends('layouts.skydash.index')

@section('title', 'Jenis Hewan')

@section('content')
    <div>
        @if (session('success'))
            <div class="top-0 left-0 position-fixed w-screen z-50 flex justify-center p-15" id="pop-message">
                <div class="alert alert-primary" role="alert">
                    <strong>{{ session('success') }}</strong>
                </div>
            </div>
        @endif
        <form method="POST" action="{{ route('create-jenis-hewan') }}">
            @csrf
            <h2>Tambah Jenis Hewan</h2>
            <div class="mb-3">
                <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                <input type="text" class="form-control" id="nama_jenis_hewan" name="nama_jenis_hewan"
                    placeholder="Masukkan nama jenis hewan" value="">
                @error('nama_jenis_hewan')
                    <x-error-box message="{{ $message }}" />
                @enderror
            </div>
            <div class="flex justify-between">
                <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in"
                    href="{{ route('jenis-hewan-data') }}" role="button">Kembali</a>

                <button type="submit" class="btn btn-success text-light">
<span class="mdi mdi-plus"></span> Tambah</button>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const popMessage = document.getElementById('pop-message');
        if (popMessage) {
            setTimeout(() => {
                popMessage.style.transition = 'opacity 0.3s ease';
                popMessage.style.opacity = '0';
                setTimeout(() => popMessage.remove(), 300);
            }, 1500);
        }
    });
</script>