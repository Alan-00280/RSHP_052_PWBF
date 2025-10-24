<x-template>

    @dd($therapies)

    <table>
        <tr>
            <th>ID Tindakan</th>
            <th>Kode Tindakan</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Kategori Klinis</th>
        </tr>

        @foreach ($therapies as $therapy)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </table>

</x-template>