<x-template title="RSHP - UNAIR - HEBAT">
    <section class="flex flex-col items-center text-center py-8 bg-gray-50">
        <a href="#" class="w-full flex justify-center">
            <div class="w-4/5">
                <img src="{{ asset('images/UNIVERSITAS-AIRLANGGA-scaled.webp') }}"
                     alt="Gambar Hero Unair"
                     class="w-full h-auto rounded-lg shadow-md">
            </div>
        </a>

    <div class="mt-4 bg-amber-400 w-full">
        <ul class="flex justify-center space-x-6 text-white text-sm font-medium">
            <li>
                <a href="#" class="block px-3 py-2 hover:bg-amber-500 transition-colors">
                    UNAIR
                </a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 hover:bg-amber-500 transition-colors">
                    FKH UNAIR
                </a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 hover:bg-amber-500 transition-colors">
                    Cyber Campus
                </a>
            </li>
        </ul>
    </div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center px-6">
            <div class="flex flex-col space-y-6 text-center md:text-left">
                <a href="#" class="bg-amber-400 text-white px-6 py-3 rounded-lg shadow hover:bg-amber-500 transition w-fit mx-auto md:mx-0 font-semibold">
                    PENDAFTARAN ONLINE
                </a>

                <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                    Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan anda.
                </p>

                <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition w-fit mx-auto md:mx-0 font-semibold">
                    INFORMASI DOKTER JAGA
                </a>
            </div>

            <div class="aspect-video w-full">
                <iframe class="w-full h-full rounded-lg shadow-md"
                        src="https://www.youtube.com/embed/rCfvZPECZvE?si=---FvFu7DLn0efGq&mute=1&autoplay=1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-8">Berita Terkini</h2>

        <div class="max-w-6xl mx-auto overflow-x-auto snap-x snap-mandatory scroll-smooth px-6">
        <div class="flex space-x-6">
            @for ($i = 0; $i < 6; $i++)
                <div class="snap-center flex-shrink-0 w-80 bg-white rounded-lg shadow hover:shadow-md transition p-4 flex flex-col">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/11/cat-e1700721273288-150x150.jpg"
                        alt="News Thumbnail"
                        class="w-full h-40 object-cover rounded-md mb-3">

                    <p class="font-semibold text-gray-800 leading-snug mb-1">
                        Ampicillin dan Amoxycilin, Resisten Terhadap Penyakit Sistem Respirasi di RSHP
                    </p>
                    <p class="text-xs text-gray-500 mb-2">23 November 2023</p>
                    <p class="text-sm text-gray-600 flex-grow">
                        Resistensi antibiotika masih menjadi perhatian berbagai pihak. Penelitian di Rumah Sakit Hewan Pendidikan Universitas Airlangga (RSHP Unair)...
                    </p>
                    <a href="#" class="mt-3 text-blue-600 text-sm font-medium hover:underline">Read more...</a>
                </div>
            @endfor
        </div>
    </div>

    </section>

    <section class="py-10 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="aspect-video w-full rounded-lg overflow-hidden shadow">
                <iframe loading="lazy"
                        src="https://maps.google.com/maps?q=Rumah%20Sakit%20Hewan%20Pendidikan%20Universitas%20Airlangga&amp;t=m&amp;z=16&amp;output=embed&amp;iwloc=near"
                        title="Rumah Sakit Hewan Pendidikan Universitas Airlangga"
                        class="w-full h-full border-0"
                        allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section class="py-8 bg-amber-400 text-white">
        <div class="max-w-md mx-auto">
            <table class="w-full text-center text-lg font-semibold">
                <tr class="border-b border-white/50">
                    <td class="py-2">Agenda</td>
                    <td class="py-2">Edukasi</td>
                </tr>
                <tr>
                    <td class="py-2">Riset</td>
                    <td class="py-2">Case Report</td>
                </tr>
            </table>
        </div>
    </section>
</x-template>
