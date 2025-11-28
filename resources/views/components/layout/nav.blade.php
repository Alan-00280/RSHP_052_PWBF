<nav class=" bg-primary-blue-500 shadow-md ">
    <ul class="flex flex-wrap justify-center items-center gap-6 py-4 text-gray-700 font-medium">
        <li>
            <x-layout.navLink href="{{ route('home') }}">Home</x-layout.navLink>
        </li>
        <li>
            <x-layout.nav-link href="#">Dokter Jaga</x-layout.nav-link>
        </li>
        <li>
            <x-layout.navLink href="{{ route('layanan') }}">Layanan Umum</x-layout.navLink>
        </li>
        <li>
            <x-layout.navLink href="#">Instalasi Pendukung</x-layout.navLink>
        </li>
        <li>
            <x-layout.navLink href="{{ route('organisasi') }}">Struktur Organisasi</x-layout.navLink>
        </li>
        <li>
            <x-layout.navLink href="{{ route('visi-misi') }}">Visi Misi dan Tujuan</x-layout.navLink>
        </li>
        <li>
            <x-layout.navLink href="#">Pelatihan</x-layout.navLink>
        </li>
        <li> {{-- todo Ubah Teks Tombol Login Saat sudah Login usernya --}}
            <x-layout.navLink href="/{{ (Auth::user()) ? 'idashboard' : 'login' }}">{{ (Auth::user()) ? 'Dashboard' : 'Login' }}</x-layout.navLink>
        </li>
    </ul>
</nav>
