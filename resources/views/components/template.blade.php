@props(['title'=>'null'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    {{-- Tambahkan Tailwind --}}
    @vite('resources/css/app.css')

    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/6/65/Logo-Branding-UNAIR-biru.png" type="image/png">
</head>
<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900">

    {{-- Navbar --}}
    <x-layout.nav />

    {{-- Konten utama --}}
    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <hr class="border-gray-300 my-8">
    <x-layout.footer />

</body>
</html>
