<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">         
        <x-layout.navlinksingle icon="mdi mdi-grid-large" text="Dashboard" href="/{{ (Auth::user()) ? 'idashboard' : 'login' }}" />

        <x-layout.navlinksingle icon="mdi mdi-paw" text="Pet Anda" href="{{ route('show-pet-pemilik') }}" />

        <x-layout.navlinksingle icon="mdi mdi-calendar" text="Temu Dokter" href="{{ route('temu-dokter-pemilik') }}" />

        <x-layout.navlinksingle icon="mdi mdi-clipboard-list-outline" text="Rekam Medis" href="{{ route('rekam-medis-pemilik') }}"/>
        
        <x-layout.navlinksingle icon="mdi mdi-account-circle-outline" text="Profile" href="{{ route('profile-pemilik') }}"/>

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