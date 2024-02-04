<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

        .room-image {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Gaya khusus untuk media cetak (PDF) */
        @media print {
            body {
                padding: 10px;
            }

            h1 {
                text-align: left;
            }

            table {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

    <h1>Daftar Kamar</h1>

    <table>
        <tr>
            {{-- <th>Foto Kamar</th> --}}
            <th>Nomer Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga Per Malam</th>
            <th>Fasilitas</th>
        </tr>

        @foreach ($kamarM as $data)
            <tr>
                {{-- <td>
                    <img src="{{ asset('storage/' . $data->foto_kamar) }}" alt="Kamar Image" class="room-image" loading="lazy">
                </td> --}}
                <td>{{ $data->no_kamar }}</td>
                <td>{{ $data->tipe_kamar}}</td>
                <td>{{ $data->harga }}</td>
                <td>{{ $data->fasilitas }}</td>
            </tr>
        @endforeach

    </table>

</body>

</html>
