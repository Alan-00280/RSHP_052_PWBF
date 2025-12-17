@extends('layouts.skydash.index', ['role_id'=>$role_id])

@section('title', 'Dashboard')

{{-- Styling for this Page --}}
<style>
    a.hover-bg-danger:hover {
        background-color: #dc3545 !important; /* red-500 */
    }
    a.hover-text-white:hover {
        color: white !important;
    }
    .custom-card {
        border-radius: 1rem;          /* mirip rounded-2xl */
        transition: all 0.25s ease;
    }

    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15); /* efek hover */
    }
</style>

@section('content')

    {{-- @dd(Session::get('role_name')) --}}
    @if ($role_id == '1' || $role_id == '2' || $role_id == '3' || $role_id == '4')
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h1>Selamat Datang, {{ Auth::user()->nama }}</h1>
            <h2>
                Anda login sebagai: 
                <span class="text-primary">{{ Session::get('role_name') }}</span>
            </h2>
        </div>

        <a href="/logout" 
        class="text-danger bg-danger bg-opacity-25 px-3 py-1 rounded text-decoration-none 
                fw-semibold h-fit align-self-start hover-bg-danger hover-text-white">
            Logout
        </a>
    </div>
    @else
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h1>Selamat Datang, {{ Auth::user()->nama }}</h1>
        </div>

        <a href="/logout" 
        class="text-danger bg-danger bg-opacity-25 px-3 py-1 rounded text-decoration-none 
                fw-semibold h-fit align-self-start hover-bg-danger hover-text-white">
            Logout
        </a>
    </div>
    @endif

    <div class="row mt-5" style="">
        <div class="col-md-6 grid-margin stretch-card">
        {{-- Weather Cardd --}}
        <div class="card tale-bg" style="display: block" id="weather-card">
            <div class="card-people">
            <img src="assets/images/dashboard/croped_people.png" alt="people" style="margin-top: 120px">
            <div class="weather-info">
                <div class="d-flex flex-column" id="temp-info">
                    <div class="ms-2">
                        <h4 class="location font-weight-normal">Surabaya</h4>
                        <h6 class="font-weight-normal">Mulyorejo</h6>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>

        {{-- {{ print_r($total_pemilik) }} --}}
        
        <div class="col-md-6 grid-margin transparent">
        <div class="row">
            @if (!\in_array($role_id, ['5']))
                <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <h3 class="mb-4">Total Pemilik</h3>
                        <p class="fs-30 mb-2"><span class="mdi mdi-account-tie" style="font-size: 2.5rem; margin-right: 5px;"></span>{{ $total_pemilik[0]->jumlah }}</p>
                    </div>
                </div>
                </div>     
            @endif

            <div class="col-md-6 mb-4 stretch-card transparent" style="{{ !\in_array($role_id, ['5']) ? '' : 'width: 100%' }}">
            <div class="card card-dark-blue">
                <div class="card-body">
                <p class="mb-4">Total Pet</p>
                <p class="fs-30 mb-2"><span class="mdi mdi-paw" style="font-size: 2.5rem; margin-right: 5px;"></span>{{ $total_pet[0]->jumlah }}</p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
                <div class="card-body">
                <p class="mb-4">Total Temu Dokter</p>
                <p class="fs-30 mb-2"><span class="mdi mdi-doctor" style="font-size: 2.5rem; margin-right: 5px;"></span>{{ $total_temu_dokter[0]->jumlah }}</p>
                </div>
            </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
                <div class="card-body">
                <p class="mb-4">Total Rekam Medis</p>
                <p class="fs-30 mb-2"><span class="mdi mdi-clipboard-list-outline" style="font-size: 2.5rem; margin-right: 5px;"></span>{{ $total_rekam_medis[0]->jumlah }}</p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <h3>Quick Access</h3>
    
    @switch($role_id)
        @case('1')
            @include('pages.dashboard.administrator')
            @break
        @case('2')
            @include('pages.dashboard.dokter')
            @break
        @case('3')
            @include('pages.dashboard.perawat')
            @break
        @case('4')
            @include('pages.dashboard.resepsionis')
            @break
        @case('5')
            @include('pages.dashboard.pemilik')
            @break
        @default
            <h1>401 - Unauthorized</h1>
    @endswitch

@endsection
@section('page-script')
<script>
    const weatherCodeMap = {
        0: "Cerah",
        1: "Sebagian berawan",
        2: "Berawan",
        3: "Mendung",
        45: "Berkabut",
        48: "Kabut rime",
        51: "Gerimis ringan",
        53: "Gerimis sedang",
        55: "Gerimis lebat",
        61: "Hujan ringan",
        63: "Hujan sedang",
        65: "Hujan lebat",
        71: "Salju ringan",
        73: "Salju sedang",
        75: "Salju lebat",
        80: "Hujan shower ringan",
        81: "Hujan shower sedang",
        82: "Hujan shower lebat",
        95: "Badai petir",
        96: "Badai petir dengan hujan es ringan",
        99: "Badai petir dengan hujan es lebat"
    };
    const temp_info = document.getElementById('temp-info')
    const weather_card = document.getElementById('weather-card')
    const loadWeatherInfo = async () => {
        temp_info.innerHTML = `<em>Loading . . .</em>`
        try {
            const response = await fetch('https://api.open-meteo.com/v1/forecast?latitude=-7.2704166667&longitude=112.7875&current=temperature_2m,precipitation,weather_code,is_day&timezone=Asia%2FSingapore&forecast_days=1');
            const data = await response.json();

            const {
            temperature_2m,
            precipitation,
            weather_code,
            is_day,
            time,
            interval
            } = data.current;

            weather_card.style.background = is_day ? '#96cbff' : '#000114'
            weather_card.style.color = is_day ? '#ffffff' : '#e7e7e7'

            const units = data.current_units;
            const is_day_icon = is_day ? `<span class="mdi mdi-weather-sunny" style="font-size: 2.5rem"></span>` : `<span class="mdi mdi-weather-night" style="font-size: 2.5rem"></span>`

            temp_info.innerHTML = `
            <div style="display: flex; justify-content: space-between">
                <h2 style="width: fit-content">
                    ${is_day_icon}
                    <a href="https://open-meteo.com" target="__blank" style="text-decoration: none; color: ${weather_card.style.color}" title="Sumber Cuaca↗　">${temperature_2m}${units.temperature_2m}</a>
                </h2>
                <div class="ms-2">
                    <h4 class="location font-weight-normal" style="width: fit-content">Surabaya</h4>
                    <h6 class="font-weight-normal" style="width: fit-content">Mulyorejo</h6>
                </div>
            </div>
            
            
            <div class="weather-details">
                <div><strong>Precipitation:</strong> ${precipitation} ${units.precipitation}</div>
                <div style="max-width: 250px; overflow-wrap: break-word; white-space: normal;"><strong>Cuaca:</strong> ${weatherCodeMap[weather_code]}</div>
            </div>
            `;
        } catch (error) {
            console.log(error);
            temp_info.innerHTML = `<em>Err: ${error}</em>`
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        loadWeatherInfo();
    })
</script>
@endsection