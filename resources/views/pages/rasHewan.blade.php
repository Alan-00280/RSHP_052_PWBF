@extends('layouts.skydash.index')

@section('title', 'Jenis Hewan')

@section('content')
    {{-- @dd($rasHewans); --}}
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a class="btn btn-primary !bg-gray-400 !border-0 !text-gray-900 hover:!bg-gray-600 transition-all ease-in mb-3"
                href="{{ route('dashboard') }}" role="button">Dashboard</a>
            <a name="" id="" class="btn btn-success mb-3 text-light" href="{{ route('create-jenishewan-page') }}"
                role="button">
                <span class="mdi mdi-plus"></span>
                Tambah Ras Hewan
            </a>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Ras Hewan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                    <th class="px-6 py-3 text-left">ID Ras Hewan</th>
                                    <th class="px-6 py-3 text-left">Jenis Hewan</th>
                                    <th class="px-6 py-3 text-left">Nama Ras</th>
                                    <th class="px-6 py-3 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($jenisHewans) --}}
                                @foreach ($jenisHewans as $jenisHewan)
                                    @if ($jenisHewan->RasHewan->count() > 0)
                                        <tr>
                                            <td class="px-6 py-4 font-medium">
                                                @foreach ($jenisHewan->RasHewan as $rasHewan)
                                                    <span class="btn p-2" id="idras-{{ $rasHewan->idras_hewan }}"
                                                        style="cursor: default">{{ $rasHewan->idras_hewan }}</span>
                                                    <hr class="m-2" />
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4">{{ $jenisHewan->nama_jenis_hewan }}</td>
                                            <td class="px-6 py-4">
                                                @foreach ($jenisHewan->RasHewan as $rasHewan)
                                                    <span class=" ms-2 p-0" style="cursor: default">
                                                        <input oninput="changeIdStarred('{{ $rasHewan->idras_hewan }}')" type="text"
                                                            style="padding: 5px" name="" value="{{ $rasHewan->nama_ras }}"
                                                            id="nama-{{ $rasHewan->idras_hewan }}">
                                                        <span class="mdi mdi-backup-restore" style="font-size: 25px; cursor: pointer"
                                                            onclick="resetNamaRas('{{$rasHewan->nama_ras}}', '{{ $rasHewan->idras_hewan }}'); changeIdStarred('{{ $rasHewan->idras_hewan }}', true)"></span>
                                                    </span>
                                                    <hr class="m-2" />
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 space-x-3">
                                                @foreach ($jenisHewan->RasHewan as $rasHewan)
                                                    <a href="#" class="btn btn-primary p-2">
                                                        <span class="mdi mdi-content-save-outline"></span> Update</a>
                                                    <a href="#" class="btn btn-danger p-2 text-light">
                                                        <span class="mdi mdi-delete-outline"></span> Delete</a>
                                                    <hr class="m-2" />
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        const changeIdStarred = (idRas, reset = false) => {
            const idNumber = document.getElementById('idras-' + idRas);
            if (reset) {
                return idNumber.innerText = idRas;
            }
            idNumber.innerText = (idNumber.innerText.includes('*')) ? idNumber.innerText : idNumber.innerText + '*';
            console.log('idNumber');
        }
        const resetNamaRas = (def, idRas) => {
            try {
                const inputNama = document.getElementById('nama-' + idRas);
                inputNama.value = def;
            } catch (error) {
                console.log(error)
            }
        }
    </script>
@endsection