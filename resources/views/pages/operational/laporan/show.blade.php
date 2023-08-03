@foreach ($laporanGroups as $created_at => $laporans)
    <table class="table table-bordered">
        <tr>
            <th>Nama Dosen</th>
            <td>{{ isset($laporan->dosen->name) ? $laporan->dosen->name : 'N/A' }}</td>
        </tr>
        <tr>
            <th>Nama Kelas</th>
            <td>{{ isset($laporan->kelas->name) ? $laporan->kelas->name : 'N/A' }}</td>
        </tr>
        @foreach ($laporans as $item)
            <tr>
                <th>Agenda</th>
                <td>{{ isset($item->agenda) ? $item->agenda : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ isset($item->deskripsi) ? $item->deskripsi : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Tindakan</th>
                <td>{{ isset($item->tindakan) ? $item->tindakan : 'N/A' }}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
        @endforeach
    </table>
@endforeach
