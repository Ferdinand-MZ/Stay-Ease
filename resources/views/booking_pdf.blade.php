<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Add this style to limit the width of the last cell */
        td:last-child {
            max-width: 150px; /* Adjust the width as needed */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <h1>Daftar Transaksi Booking</h1>

    <table>
        <tr>
            <th>Nomer Unik</th>
            <th>Nama Tamu</th>
            <th>Nomer Kamar</th>
            <th>Tanggal Check In</th>
            <th>Tanggal Check Out</th>
            <th>Uang Bayar</th>
            <th>Uang Kembali</th>
            <th>Total Harga</th>
            <th>Status</th>
            {{-- <th>Tanggal Dibuat</th> --}}
        </tr>

        @foreach ($bookingM as $data)
            <tr>
                <td>{{ $data->nomor_unik }}</td>
                <td>{{ $data->nama_tamu}}</td>
                <td>{{ $data->no_kamar }}</td>
                <td>{{ $data->check_in }}</td>
                <td>{{ $data->check_out }}</td>
                <td>{{ $data->uang_bayar }}</td>
                <td>{{ $data->uang_kembali }}</td>
                <td>{{ $data->total_harga }}</td>
                <td>{{ $data->status }}</td>
                {{-- <td>{{ $data->created_at }}</td> --}}
            </tr>
        @endforeach

    </table>

</body>
</html>
