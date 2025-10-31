<section class="min-h-screen">
    {{-- <h3>Opsi Dashboard</h3> --}}
    {{-- TODO Pilihan Dashboard --}}
    {{-- <a href=""></a> --}}


    {{-- Tampilkan semua data- data yang ada didatabase
        1. Daftar Jenis Hewan
        2. Daftar Ras Hewan
        3. Daftar Kategori
        4. Daftar Kategori klinis
        5. Daftar Kode Tindakan terapi
        6. Daftar pet
        7. Daftar Role
        8. Daftar User dengan Rolenya masing-masing
        --}}

    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-4">
        <x-dashboard.functionCard href="{{ route('user-data') }}" title="Data User" description="Edit Users data in here" />
        <x-dashboard.functionCard href="{{ route('jenis-hewan-data') }}" title="Jenis Hewan" description="View and Edit Jenis Hewan Here" />
        <x-dashboard.functionCard href="{{ route('ras-hewan-data') }}" title="Ras Hewan" description="View and Edit Ras Hewan" />
        <x-dashboard.functionCard href="{{ route('kategori-data') }}" title="Kategori" description="View and Edit Kategori" />
        <x-dashboard.functionCard href="{{ route('kategori-klinis-data') }}" title="Kategori Klinis" description="View and Edit Kategori Klinis" />
        <x-dashboard.functionCard href="{{ route('kategori-tindakan-terapi') }}" title="Kode Tindakan Terapi" description="View and Edit Kode Tindakan Terapi" />
        <x-dashboard.functionCard href="{{ route('pet') }}" title="Pet" description="Edit Pet data in here" />
        <x-dashboard.functionCard href="{{ route('role') }}" title="Role" description="Edit Role data in here" />
    </div>
    
</section>
