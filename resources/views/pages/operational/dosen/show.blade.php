<table class="table table-bordered">
    <tr>
        <th>User Account</th>
        <td>{{ isset($dosen->user->email) ? $dosen->user->email : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($dosen->name) ? $dosen->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>NIK/NIP</th>
        <td>{{ isset($dosen->nik_nip) ? $dosen->nik_nip : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Position</th>
        <td>{{ isset($dosen->position->name) ? $dosen->position->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Birth Place</th>
        <td>{{ isset($dosen->birth_place) ? $dosen->birth_place : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Birth Date</th>
        <td>{{ isset($dosen->birth_date) ? $dosen->birth_date : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Gender</th>
        <td>
            @if($dosen->gender == 1)
                <span>{{ 'Laki-laki' }}</span>
            @elseif($dosen->gender == 2)
                <span>{{ 'Perempuan' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Contact</th>
        <td>{{ isset($dosen->contact) ? $dosen->contact : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ isset($dosen->address) ? $dosen->address : 'N/A' }}</td>
    </tr>
</table>
