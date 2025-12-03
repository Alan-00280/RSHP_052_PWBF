<section class="min-h-screen">
    
    <div class="row g-3 p-4">
        <x-dashboard.functionCard href="{{ route('pemilik-resep') }}" title="Pemilik" description="View and Edit ddata Pemilik" />
        <x-dashboard.functionCard href="{{ route('pet') }}" title="Pet" description="View and Edit Ras Hewan" />
        <x-dashboard.functionCard href="{{ route('temu-dokter') }}" title="Temu Dokter" description="View and Edit Kategori" />
    </div>
    
</section>
