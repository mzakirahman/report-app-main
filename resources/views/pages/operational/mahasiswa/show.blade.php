<table class="table table-bordered">
    <tr>
        <th>User Account</th>
        <td>{{ isset($mahasiswa->user->email) ? $mahasiswa->user->email : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($mahasiswa->name) ? $mahasiswa->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>NIM</th>
        <td>{{ isset($mahasiswa->nim) ? $mahasiswa->nim : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kelas</th>
        <td>{{ isset($mahasiswa->kelas->name) ? $mahasiswa->kelas->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Birth Place</th>
        <td>{{ isset($mahasiswa->birth_place) ? $mahasiswa->birth_place : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Birth Date</th>
        <td>{{ isset($mahasiswa->birth_date) ? $mahasiswa->birth_date : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Gender</th>
        <td>
            @if($mahasiswa->gender == 1)
                <span>{{ 'Laki-laki' }}</span>
            @elseif($mahasiswa->gender == 2)
                <span>{{ 'Perempuan' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Contact</th>
        <td>{{ isset($mahasiswa->contact) ? $mahasiswa->contact : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ isset($mahasiswa->address) ? $mahasiswa->address : 'N/A' }}</td>
    </tr>
</table>
