@extends('layouts.skydash.index')

@section('title', 'Pet Pemilik')

@section('content')

    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ '#' }}" role="button" data-bs-toggle="modal"
                data-bs-target="#createModal">
                <span class="mdi mdi-plus"></span>
                Tambah Pet
            </a>
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
                                    <th class="px-4 py-3 text-center font-semibold text-gray-700">Action</th>
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
                                        <td class="px-4 py-2 flex justify-center gap-2">
                                            <a href="{{ route('edit-pet', ['id'=>$pet->idpet]) }}" class="btn btn-primary p-2">
                                                <span class="mdi mdi-pencil"></span> Edit</a>
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

@section('modal')

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('create-pet') }}" method="POST" id="modal-create-form"> 
                    @csrf 
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Pet</h1> <button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="inputPemilik" class="form-label">Pilih Pemilik*</label> 
                            {{-- <x-logger :object="$pemiliks" /> --}}
                            <select class="form-select text-black" id="inputPemilik" name="idPemilik" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Pemilik --</option>
                                {{-- <option class="text-black" value="1">One</option> --}}
                                @if ($pemiliks)
                                    @foreach ($pemiliks as $pemilik)
                                        <option class="text-black" value="{{ $pemilik->idpemilik }}">{{ $pemilik->User->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3"> <label for="inputNama" class="form-label">Nama Pet*</label> 
                            <input type="text" class="form-control" id="inputNama" aria-describedby="petHelp" name="nama_pet" min="3" required>
                            <div id="petHelp" class="form-text">Input Nama Pet pemilik di sini</div>
                            @error('nama_pet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="input-jenis" class="form-label">Jenis Pet*</label>
                            {{-- <x-logger :object="$jeniss" />  --}}
                            <select class="form-select text-black" id="input-jenis" name="idJenis" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Jenis Hewan --</option>
                                @if($jeniss)
                                    @foreach ($jeniss as $jenis)
                                        <option class="text-black" value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('idJenis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="input-ras" class="form-label">Ras Hewan*</label> 
                            <select class="form-select text-black" id="input-ras" name="idRas" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Jenis Hewan Dahulu --</option>
                            </select>
                            @error('idRas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="input-kelamin" class="form-label">Jenis Kelamin*</label> 
                            <select class="form-select text-black" id="input-kelamin" name="kelamin" aria-label="Default select example" required>
                                <option class="text-black" value="" selected>-- Pilih Jenis Kelamin --</option>
                                <option class="text-black" value="J">Jantan</option>
                                <option class="text-black" value="B">Betina</option>
                            </select>
                            @error('idRas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="inputLahir" class="form-label">Tanggal Lahir*</label> 
                            <br><input type="text" name="datepick" id="inputLahir" aria-describedby="lahirHelp">
                            <div id="lahirHelp" class="form-text">Input tanggal lahir Pet</div>
                            @error('datepick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3"> <label for="inputWarna" class="form-label">Warna Tanda*</label> 
                            <input type="text" class="form-control" id="inputWarna" aria-describedby="warnaHelp" name="warna_jenis" min="3" required>
                            <div id="warnaHelp" class="form-text">Input Warna Tanda Pet di sini</div>
                            @error('warna_jenis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal" id="close-modal">Close</button> 
                        <button type="submit"
                            class="btn btn-primary">Simpan</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('vite-additional')
    @vite('resources/js/datepicker.js')
@endsection
@section('page-script')
    <script>        
        setTimeout(() => {
            const el = document.getElementById('pop-message');
            if (el) {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = 0;
                setTimeout(() => el.remove(), 500);
            }
        }, 1500);

        // Reset form saat nutup modal
        const modalForm = document.getElementById('modal-create-form')
        document.getElementById('createModal')
            .addEventListener('hidden.bs.modal', () => {
                modalForm.reset()
        })
            
        const selectJenis = document.getElementById('input-jenis')
        const selectRas = document.getElementById('input-ras')
        selectJenis.addEventListener('change', async (e) => {
            let idjenis = e.target.value
            selectRas.innerHTML = `<option class="text-black" value="" selected>Loading . . .</option>`

            const fetchRas = await fetch(`/get-ras/${idjenis}`)
            const fetchedRas = await fetchRas.json()
            
            // [{"idras_hewan":35,"nama_ras":"Kura-kura Sulcata (African spurred tortoise)",. . .]
            // console.log(fetchedRas.length > 0)

            if (fetchedRas.length > 0) {
                selectRas.innerHTML = `<option class="text-black" value="${fetchedRas[0].idras_hewan}" selected>${fetchedRas[0].nama_ras}</option>`
                fetchedRas.forEach(ras => {
                    selectRas.innerHTML += `<option class="text-black" value="${ras.idras_hewan}">${ras.nama_ras}</option>`
                });
            } else {
                selectRas.innerHTML = `<option class="text-black" value="" selected>-- No Data --</option>`
            }

        })
    </script>
@endsection
