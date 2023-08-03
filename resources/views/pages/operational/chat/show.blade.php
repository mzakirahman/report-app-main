<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ isset($chat->user->name) ? $chat->user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Nama Kelas</th>
        <td>{{ isset($chat->kelas->name) ? $chat->kelas->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Dosen</th>
        <td>{{ isset($chat->dosen->name) ? $chat->dosen->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td>{{ isset($chat->deskripsi) ? $chat->deskripsi : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Pesan</th>
        <td>{{ isset($chat->pesan) ? $chat->pesan : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Balasan</th>
        <td>{{ isset($chat->balasan) ? $chat->balasan : 'N/A' }}</td>
    </tr>
    
</table>

