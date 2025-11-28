

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">         <x-layout.navlinksingle icon="mdi mdi-grid-large" text="Dashboard" href="/{{ (Auth::user()) ? 'idashboard' : 'login' }}" />

        <x-layout.navcollapsewrap icon="mdi mdi-account-group" text="User" id="pengguna">
            <x-layout.navcollapseitem href="{{ route('user-data') }}" text="User Data" />
            <x-layout.navcollapseitem href="{{ route('role') }}" text="Manage Role User" />
        </x-layout.navcollapsewrap> 

        <x-layout.navcollapsewrap icon="mdi mdi-paw" text="Hewan" id="hewan">
            <x-layout.navcollapseitem href="{{ route('jenis-hewan-data') }}" text="Jenis Hewan" />
            <x-layout.navcollapseitem href="{{ route('ras-hewan-data') }}" text="Ras Hewan" />
        </x-layout.navcollapsewrap> 

        <x-layout.navcollapsewrap icon="mdi mdi-account-heart" text="Pasien" id="pasien">
            <x-layout.navcollapseitem href="{{ route('pemilik-resep') }}" text="Pemilik" />
            <x-layout.navcollapseitem href="{{ route('pet') }}" text="Pet" />
        </x-layout.navcollapsewrap>
        
        <x-layout.navcollapsewrap icon="mdi mdi-hospital-box-outline" text="Klinis" id="klinis">
            <x-layout.navcollapseitem href="{{ route('kategori-data') }}" text="Kategori Tindakan" />
            <x-layout.navcollapseitem href="{{ route('kategori-klinis-data') }}" text="Kategori Klinis" />
            <x-layout.navcollapseitem href="{{ route('kategori-tindakan-terapi') }}" text="Kode Tindakan Terapi" />
        </x-layout.navcollapsewrap> 

        <x-layout.navcollapsewrap icon="mdi mdi-stethoscope" text="Clinical Process" id="proses-klinis">
            <x-layout.navcollapseitem href="{{ route('temu-dokter') }}" text="Temu Dokter" />
            <x-layout.navcollapseitem href="{{ route('rekam-medis') }}" text="Rekam Medis" />
        </x-layout.navcollapsewrap> 

        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="../../../docs/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li> --}}
    </ul>
</nav>