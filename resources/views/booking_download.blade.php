<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stay Ease Invoice</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin: 0;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .hotel-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .hotel-logo img {
            max-width: 150px;
            height: auto;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>

    <h1>Stay Ease</h1>
    <p>Invoice<p>

    @if($bookings->isNotEmpty())
        @php
            $firstBooking = $bookings->first();
        @endphp

        <table>
            <tr>
                <th>Nomor Unik</th>
                <td>{{ $firstBooking->nomor_unik }}</td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $firstBooking->nama_tamu }}</td>
            </tr>
            <tr>
                <th>Total Transaksi</th>
                <td>{{ $firstBooking->total_transaksi }}</td>
            </tr>
            <tr>
                <th>Uang Bayar</th>
                <td>{{ $firstBooking->uang_bayar }}</td>
            </tr>
            <tr>
                <th>Uang Kembali</th>
                <td>{{ $firstBooking->uang_kembali }}</td>
            </tr>
        </table>

        <br>

        <h2>Details Setiap Booking</h2>
        <table>
            <tr>
                <th>Detail Kamar</th>
                <th>Total Harga</th>
                <th>Tanggal Check In</th>
                <th>Tanggal Check Out</th>
            </tr>
            @foreach ($bookings as $data)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        @if($data->kamar)
                          No :  {{ $data->no_kamar }} - Tipe {{ $data->kamar->tipe_kamar }} - {{ $data->kamar->harga }} per malam
                        @else
                            Informasi tidak tersedia
                        @endif
                    </td>
                    <td>{{ $data->total_harga }}</td>
                    <td>{{ $data->check_in }}</td>
                    <td>{{ $data->check_out }}</td>
                </tr>
            @endforeach
        </table>

        <div class="footer">
            Terima Kasih Karena Anda telah memilih Stay Ease. Untuk Kontak dan saran, bisa hubungi kami : 
            <br>
            Nomor Telepon : (123) 456-7890 | Email: info@stayease.com
        </div>
    @else
        <p>No booking data available.</p>
    @endif

</body>
</html>