@extends('sbadmin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Transaksi Produk</h3>
        </div>
        

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            {{-- search form --}}
            @if (in_array(Auth::user()->role, ['kasir','owner','admin']))
            <form action="{{ route('transactions.index') }}" method="get">
                <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Masukan Nama Produk" value="{{ $vcari }}">
                
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ url('transactions') }}"><button type="button" class="btn btn-danger">Reset</button></a>
                </div>
                </form>
                <br>
            @endif

            @if (in_array(Auth::user()->role, ['kasir']))	
            <a href="{{ route('transactions.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Tambah Transaksi
              </a>
            @endif
              
            @if (in_array(Auth::user()->role, ['kasir','owner','admin']))	
              <a href="{{ url('transactions/pdf') }}" class="btn btn-warning">
                <i class="fas fa-file-pdf"></i> Unduh Daftar Transaksi
              </a>

              @if (in_array(Auth::user()->role, ['kasir','owner','admin']))	
              @if (isset($vcari))
                <a href="{{ route('transactions.downloadAll', ['date' => $vcari]) }}" class="btn btn-info">
                    <i class="fas fa-download"></i> Unduh Semua Transaksi untuk Tanggal Ini
                </a>
                <br><br>
                @endif
              <br><br>
            @endif
            @endif
           
            <div class="card-body">
                @if($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
            @endif
            <table class="table table-striped table-bordered">
                <tr>
                    <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
                    <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
                    <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
                    <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                    @if (in_array(Auth::user()->role, ['kasir','admin']))	
                    <th style="text-align: center; vertical-align: middle;">Aksi</th>
                    @endif
                </tr>
                @if(count($transactionsM) > 0)
                @foreach ($transactionsM as $transactions)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nomor_unik }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_pelanggan }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->harga_produk }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_bayar }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_kembali }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $transactions->created_at }}</td>
                    
                    {{-- @if (Auth::user()->role == 'admin') --}}
                    <td style="text-align: center; vertical-align: middle;">

                        @if (in_array(Auth::user()->role, ['kasir','admin']))	
                        <a href="{{ route('transactions.edit', $transactions->id_trans) }}" class="btn btn-warning" style="width: 100px; margin-right: 5px;">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        
                        <form action="{{ route('transactions.destroy', $transactions->id_trans) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="width: 100px; margin-right: 5px;" onclick="return confirm('Konfirmasi Hapus Transaksi !?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                        <br>
                        {{-- @endif --}}
                        {{-- @if (in_array(Auth::user()->role, ['kasir'])) --}}
                        <a href="{{ url('transactions/download/' . $transactions->id_trans) }}" class="btn btn-info" style="width: 100px;">
                            <i class="fas fa-download"></i> Unduh Struk
                        </a>
                        
                </form>
                @endif
                {{-- @endif --}}
               
            </td>
        </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" style="text-align: center; vertical-align: middle;">Transaksi Tidak Ditemukan</td>
                </tr>
                @endif
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
