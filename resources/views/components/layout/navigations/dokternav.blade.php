<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">         
        <x-layout.navlinksingle icon="mdi mdi-grid-large" text="Dashboard" href="/{{ (Auth::user()) ? 'idashboard' : 'login' }}" />

        <x-layout.navcollapsewrap icon="mdi mdi-account-heart" text="Pasien" id="pasien">
            <x-layout.navcollapseitem href="{{ route('view-pemilik') }}" text="Pemilik" />
            <x-layout.navcollapseitem href="{{ route('view-pet') }}" text="Pet" />
        </x-layout.navcollapsewrap>

        <x-layout.navlinksingle icon="mdi mdi-clipboard-list-outline" text="Rekam Medis" href="{{ route('rekam-medis') }}"/>
        
        <x-layout.navlinksingle icon="mdi mdi-account-circle-outline" text="Profile" href="#"/>

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