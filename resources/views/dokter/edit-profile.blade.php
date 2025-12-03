@extends('layouts.skydash.index')

@section('title', 'Edit Profil Dokter')
{{-- @dd($categories) --}}

@section('content')
    <x-logger :object="$dokter_data" />
    <div class="container">
		<div class="main-body">
			<div class="row">
                
                {{-- Profile Card --}}
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="{{ asset('images/user/9e1b64a3a8797626e6a80b589c946e96.jpg') }}" alt="Admin" class="rounded-circle" width="150">
								<div class="mt-3">
									<h4>{{ $dokter_data->UserRshp->nama }}</h4>
									<p class="text-secondary mb-1">{{ $dokter_data->bidang_dokter }}</p>
									<p class="text-muted font-size-sm">{{ $dokter_data->alamat }}</p>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-twitter mr-2 icon-inline text-info">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg> Twitter</h6>
                                    <span class="text-secondary">{{ '@twitter-account-here' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg> Instagram</h6>
                                    <span class="text-secondary">{{ '@instagram-account-here' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook mr-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg> Facebook</h6>
                                    <span class="text-secondary">{{ '@Facebook-account-here' }}</span>
                                </li>
                            </ul>
						</div>
					</div>
				</div>
                {{-- Nama Lengkap
Dr. Andi Setiawan (Laki-laki)
Email
ea@email.com
No. Handphone
08123863402
Bidang Dokter
Dokter Bedah Minor
Alamat
Jl. Jayakarta No. 32, Perum Hasanuddin Indah, Ponorogo --}}
                {{-- Edit Card --}}
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
                            <div class="row mb-3">
                                <h3>Edit Profil</h3>
                            </div>
                            <form action="{{ route('update-profil-dokter', ['id' => $dokter_data->UserRshp->iduser ]) }}" method="post">
                            @csrf
                            @method('PATCH')
							<div class="row mb-3 align-items-center">
								<div class="col-sm-3" style="height: fit-content">
									<h6 class="mb-0" id="field-title-nama">Nama Lengkap</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="nama" data-field="nama" value="{{ $dokter_data->UserRshp->nama }}" requried>
								</div>
							</div>
							<div class="row mb-3 align-items-center">
								<div class="col-sm-3" style="height: fit-content">
									<h6 class="mb-0" id="field-title-email">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="email" class="form-control" name="email" value="{{ $dokter_data->UserRshp->email }}" data-field="email" required>
								</div>
							</div>
							<div class="row mb-3 align-items-center">
								<div class="col-sm-3" style="height: fit-content">
									<h6 class="mb-0" id="field-title-nomor">No. Handphone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="no_hp" data-field="nomor" value="{{ $dokter_data->no_hp }}" required>
								</div>
							</div>
							<div class="row mb-3 align-items-center">
								<div class="col-sm-3" style="height: fit-content">
									<h6 class="mb-0" id="field-title-bidang">Bidang Dokter</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="bidang" data-field="bidang" value="{{ $dokter_data->bidang_dokter }}" required>
								</div>
							</div>
							<div class="row mb-3 align-items-center">
								<div class="col-sm-3" style="height: fit-content">
									<h6 class="mb-0" id="field-title-alamat" >Alamat</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                                    <textarea class="form-control" name="alamat" rows="5" data-field="alamat" required>{{ $dokter_data->alamat }}</textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 d-flex gap-2 text-secondary justify-content-end">
                                    <a href="{{ route('profile-dokter') }}" class="btn btn-secondary text-white">Cancel</a>
                                    <button type="reset" class="btn btn-info text-white" onclick="changeFormTitleStarred('nama', true);changeFormTitleStarred('email', true);changeFormTitleStarred('nomor', true);changeFormTitleStarred('bidang', true);changeFormTitleStarred('alamat', true);">Reset</button>
									<button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
								</div>
							</div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('page-script')
    <script>
        const changeFormTitleStarred = (field, reset = false) => {
            const formTitle = document.getElementById(`field-title-${field}`);

            if (reset) {
                return formTitle.innerText = formTitle.innerText.replaceAll('*', '');
            }

            formTitle.innerText = (formTitle.innerText.includes('*')) ? formTitle.innerText : formTitle.innerText + '*';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input:not([disabled])').forEach(element=>element.addEventListener('input', (e) => changeFormTitleStarred(e.currentTarget.dataset.field)))

            const textareas = document.querySelectorAll('textarea:not([disabled])').forEach(element=>element.addEventListener('input', (e) => changeFormTitleStarred(e.currentTarget.dataset.field)))
        })
    </script>
@endsection