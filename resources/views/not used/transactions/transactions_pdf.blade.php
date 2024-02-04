<h1> Daftar Transaksi</h1>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
    <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
    <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
    <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
    <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
    <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
</tr>

@foreach ($transactionsM as $transactions)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nomor_unik }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_pelanggan }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_produk }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->harga_produk }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_bayar }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_kembali }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $transactions->created_at }}</td>
</tr>
@endforeach

       </table>