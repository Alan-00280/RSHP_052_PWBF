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
    @endif

    <div class="row mt-5">
        <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
            <div class="card-people mt-auto">
            <img src="assets/images/dashboard/people.svg" alt="people">
            <div class="weather-info">
                <div class="d-flex">
                <div>
                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>31<sup>C</sup></h2>
                </div>
                <div class="ms-2">
                    <h4 class="location font-weight-normal">Chicago</h4>
                    <h6 class="font-weight-normal">Illinois</h6>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                <p class="mb-4">Today’s Bookings</p>
                <p class="fs-30 mb-2">4006</p>
                <p>10.00% (30 days)</p>
                </div>
            </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                <p class="mb-4">Total Bookings</p>
                <p class="fs-30 mb-2">61344</p>
                <p>22.00% (30 days)</p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
                <div class="card-body">
                <p class="mb-4">Number of Meetings</p>
                <p class="fs-30 mb-2">34040</p>
                <p>2.00% (30 days)</p>
                </div>
            </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
                <div class="card-body">
                <p class="mb-4">Number of Clients</p>
                <p class="fs-30 mb-2">47033</p>
                <p>0.22% (30 days)</p>
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