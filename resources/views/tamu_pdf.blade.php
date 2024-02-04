<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

    <h1>Daftar Tamu</h1>

    <table>
        <tr>
            <th>Nama Tamu</th>
            <th>Tanggal Lahir</th>
            <th>Nomer HP</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Di-input</th>
        </tr>

        @foreach ($tamuM as $data)
            <tr>
                <td>{{ $data->nama_tamu }}</td>
                <td>{{ $data->tgl_lahir }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>{{ $data->jk }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach

    </table>

</body>
</html>
