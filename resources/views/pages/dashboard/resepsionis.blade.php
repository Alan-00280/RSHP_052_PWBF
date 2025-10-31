<section class="min-h-screen">
    
    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-4">
        <x-dashboard.functionCard href="{{ route('ras-hewan-data-resepsionis') }}" title="Ras Hewan" description="View and Edit Ras Hewan" />
        <x-dashboard.functionCard href="{{ route('kategori-data-resepsionis') }}" title="Kategori" description="View and Edit Kategori" />
        <x-dashboard.functionCard href="{{ route('kategori-klinis-data-resepsionis') }}" title="Kategori Klinis" description="View and Edit Kategori Klinis" />
        <x-dashboard.functionCard href="{{ route('kategori-tindakan-terapi-resepsionis') }}" title="Kode Tindakan Terapi" description="View and Edit Kode Tindakan Terapi" />
        <x-dashboard.functionCard href="{{ route('pet-resepsionis') }}" title="Pet" description="Edit Pet data in here" />
    </div>
    
</section>
