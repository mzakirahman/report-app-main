<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add any custom styling for your PDF here */
        body {
            font-size: 12px;
        }

        table {
            font-size: 12px;
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table td,
        table th {
            padding: 6px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    @foreach ($laporanGroups as $created_at => $laporans)
        <center>
            <h1>TEKNIK INFORMATIKA</h1>
        </center>
        <hr>
        <p>Kelas : {{ $laporan->kelas->name }}</p>
        <p>Dosen : {{ $laporan->dosen->name }}</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Agenda</th>
                    <th>Deskripsi</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->agenda }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->tindakan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/file-laporan/' . $item->lampiran) }}" alt="Lampiran">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    @endforeach
</body>

</html>
