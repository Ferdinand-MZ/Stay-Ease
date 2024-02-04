<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Booking</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #fff;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin: 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
            
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Struk Booking</h1>

    <table>
        @foreach ($bookings as $data)
        <tr>
            <th>Nomor Unik</th>
            <td>{{ $data->nomor_unik}}</td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td>{{ $data->nama_tamu}}</td>
        </tr>
        <tr>
            <th>Detail Kamar</th>
            <td style="text-align: center; vertical-align: middle;">
                @if($data->kamar)
                    {{ $data->no_kamar }} - {{ $data->kamar->tipe_kamar }} - {{ $data->kamar->harga }}
                @else
                    Informasi tidak tersedia
                @endif
            </td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>{{ $data->total_harga}}</td>
        </tr>
        <tr>
            <th>Uang Bayar</th>
            <td>{{ $data->uang_bayar}}</td>
        </tr>
        <tr>
            <th>Uang Kembali</th>
            <td>{{ $data->uang_kembali}}</td>
        </tr>
        <tr>
            <th>Tanggal Check In</th>
            <td>{{ $data->check_in}}</td>
        </tr>
        <tr>
            <th>Tanggal Check Out</th>
            <td>{{ $data->check_out}}</td>
        </tr>
        @endforeach
    </table>

    <!-- Add additional information, totals, or footer here -->

</body>
</html>