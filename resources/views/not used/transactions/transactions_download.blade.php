<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
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

    <h1>Struk Transaksi</h1>

    <table>
        @foreach ($transactionsM as $data)
        <tr>
            <th>Nomor Unik</th>
            <td>{{ $data->nomor_unik}}</td>
        </tr>
        <tr>
            <th>Nama Pelanggan</th>
            <td>{{ $data->nama_pelanggan}}</td>
        </tr>
        <tr>
            <th>Nama Produk</th>
            <td>{{ $data->nama_produk}}</td>
        </tr>
        <tr>
            <th>Harga Produk</th>
            <td>{{ $data->harga_produk}}</td>
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
            <th>Tanggal</th>
            <td>{{ $data->created_at}}</td>
        </tr>
        @endforeach
    </table>

    <!-- Add additional information, totals, or footer here -->

</body>
</html>