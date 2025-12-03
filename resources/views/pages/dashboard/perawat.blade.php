<section class="min-h-screen">

    <div class="row g-3 p-4">
        <x-dashboard.functionCard href="{{ route('view-pemilik') }}" title="Pemilik" description="View data pemilik" />
        <x-dashboard.functionCard href="{{ route('view-pet') }}" title="Pet" description="View data pet" />
        <x-dashboard.functionCard href="{{ route('rekam-medis') }}" title="Rekam Medis" description="View and Edit data rekam medis" />
    </div>
    
</section>
