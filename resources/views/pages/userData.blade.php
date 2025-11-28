@extends('layouts.skydash.index')

@section('title', 'User Data')

@section('content')
    <div class="overflow-x-auto">
        <div class="flex w-full justify-end">
            <a name="" id="" class="btn btn-success mb-2 text-white" href="{{ route('create-user-page') }}" role="button">
                <span class="mdi mdi-plus"></span>
                Tambah User
            </a>
        </div>

        {{-- {{ dd($users) }} --}}

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data User</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                                <tr>
                                    <th class="px-6 py-3 text-left">ID User</th>
                                    <th class="px-6 py-3 text-left">Nama</th>
                                    <th class="px-6 py-3 text-left">Email</th>
                                    <th class="px-6 py-3 text-left">Role</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    @if (count($user->RoleUser) > 0)
                                        <tr class="hover:bg-gray-50 transition">
                                            <form action="" method="">
                                                @csrf
                                                {{-- @method('PUT') --}}

                                                <td class="px-6 py-3 text-gray-700" id="id-{{ $user->iduser }}">{{ $user->iduser }}</td>

                                                <td class="px-6 py-3">
                                                    <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                    <input 
                                                    type="text" 
                                                    name="nama" 
                                                    class="form-control p-2"
                                                    oninput="changeIdStarred('{{ $user->iduser }}')"
                                                    value="{{ $user->nama }}"
                                                    id="nama-{{ $user->iduser }}"
                                                    >
                                                    <span class="mdi mdi-pencil mx-2"></span>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-3">
                                                    <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                    <input 
                                                    type="email" 
                                                    name="email" 
                                                    class="form-control p-2"
                                                    oninput="changeIdStarred('{{ $user->iduser }}')"
                                                    id="email-{{ $user->iduser }}"
                                                    value="{{ $user->email }}"
                                                    >
                                                    <span class="mdi mdi-pencil mx-2"></span>
                                                    </div>
                                                </td>

                                                {{-- ROLE TETAP DROPDOWN (bukan input) --}}
                                                <td class="px-6 py-3">
                                                    <div class="input-group-prepend">
                                                        @foreach ($user->RoleUser as $role)
                                                            @if ($role->status == 1)
                                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle me-2"
                                                                    type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    {{ $role->Role->nama_role }} (Current)
                                                                </button>
                                                            @endif
                                                        @endforeach

                                                        <div class="dropdown-menu">
                                                            @if (count($user->RoleUser) == 1)
                                                                <span class="dropdown-item italic text-secondary">
                                                                    No Other Role
                                                                </span>
                                                            @else
                                                                @foreach ($user->RoleUser as $role)
                                                                    @if ($role->status != 1)
                                                                        <a class="dropdown-item" href="#" onchange="gantiRole({{ $role->id }})">
                                                                            {{ $role->Role->nama_role }}
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-3 text-center">
                                                    
                                                    <div class="d-flex align-items-center ms-2" style="cursor: default;">
                                                    <button type="submit" class="btn btn-primary">
                                                        <span class="mdi mdi-content-save-outline"></span> Update
                                                    </button>
                                                    <span 
                                                    class="mdi mdi-backup-restore ms-2"
                                                    style="font-size: 25px; cursor: pointer;"
                                                    onclick="resetInputs('email', '{{ $user->email }}', '{{ $user->iduser }}');resetInputs('nama', '{{ $user->nama }}', '{{ $user->iduser }}');changeIdStarred('{{ $user->iduser }}', true)"
                                                    >
                                                    </span>
                                                    </div>
                                                </td>

                                            </form>
                                        </tr>

                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <tr>
                            <td>Dave</td>
                            <td>53275535</td>
                            <td>20 May 2017</td>
                            <td><label class="badge badge-warning">In progress</label></td>
                        </tr> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script>
    const changeIdStarred = (id, reset = false) => {
            const idNumber = document.getElementById('id-' + id);
            if (reset) {
                return idNumber.innerText = id;
            }
            idNumber.innerText = (idNumber.innerText.includes('*')) ? idNumber.innerText : idNumber.innerText + '*';
        }
    const resetInputs = (inputField, def, id) => {
            try {
                const inputFieldDOM = document.getElementById(inputField+'-'+id);
                inputFieldDOM.value = def;
            } catch (error) {
                console.log(error)
            }
        }
</script>
@endsection