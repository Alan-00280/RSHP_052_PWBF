<section class="min-h-screen">
    
    <div class="row g-3 p-4">
        <x-dashboard.functionCard href="{{ route('view-pemilik') }}" title="Pemilik" description="View daftar Pemilik di sini" />
        <x-dashboard.functionCard href="{{ route('view-pet') }}" title="Pet" description="View daftar Pet di sini" />
        <x-dashboard.functionCard href="{{ route('rekam-medis') }}" title="Rekam Medis" description="View and Edit Rekam Medis di sini" />
        <x-dashboard.functionCard href="{{ '#' }}" title="Profile" description="View profile anda di sini" />
    </div>
    
</section>


