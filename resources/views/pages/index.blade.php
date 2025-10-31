
    {{-- @dd(Session::all()) --}}


<x-template title="Dashboard">

    {{-- @dd(Session::get('role_name')) --}}
    @if ($role_id == '1' || $role_id == '2' || $role_id == '3' || $role_id == '4')
    <div class="flex justify-between">
        <div>
            <h1>Selamat Datang, {{ Auth::user()->nama }}</h1>
            <h2>Anda login sebagai: {{ Session::get('role_name') }}</h2>
        </div>
        <a href="/logout" class="px-3 py-1 max-h-fit bg-red-300 text-red-600 hover:bg-red-500 hover:text-red-700 rounded-md">logout</a>
    </div>
    @endif
    
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

</x-template>