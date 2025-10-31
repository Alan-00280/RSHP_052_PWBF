<section class="min-h-screen">
    
    <div class="grid gap-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-4">
        <x-dashboard.functionCard href="{{ route('user-data') }}" title="Data User" description="Edit Users data in here" />
        <x-dashboard.functionCard href="{{ route('jenis-hewan-data') }}" title="Jenis Hewan" description="View and Edit Jenis Hewan Here" />
        <x-dashboard.functionCard href="{{ route('ras-hewan-data') }}" title="Ras Hewan" description="View and Edit Ras Hewan" />
        <x-dashboard.functionCard href="{{ route('pet') }}" title="Pet" description="Edit Pet data in here" />
    </div>
    
</section>
