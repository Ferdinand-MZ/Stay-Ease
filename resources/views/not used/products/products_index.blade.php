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
                <h3 class="card-title">Daftar Kamar Hotel</h3>
            </div>

            <div class="card-body">
                @if($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
                @endif
            
                {{-- search form --}}
                <form action="{{ route('products.index') }}" method="get">
                    <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Masukan Nama Kamar Hotel" value="{{ $vcari }}">
                    
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ url('products') }}"><button type="button" class="btn btn-danger">Reset</button></a>
                    </div>
                    </form>
                    <br>
                

                @if (in_array(Auth::user()->role, ['admin']))	
                    <a href="{{ url('products/pdf') }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Unduh Daftar Produk
                    </a>
                @endif

                    @if (Auth::user()->role == 'admin')
                <a href="{{ route('products.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                <br>
                <br>
                @endif
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
                        <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
                        <th style="text-align: center; vertical-align: middle;">Tanggal</th>

                        @if (Auth::user()->role == 'admin')
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif
                    </tr>
                    @if(count($productsM) > 0)
                    @foreach ($productsM as $products)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $products->nama_produk }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $products->harga_produk }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
                        
                        @if (Auth::user()->role == 'admin')
                        <td style="text-align: center; vertical-align: middle;">
                        
                        <div class="btn-group">
                        <a href="{{ route('products.edit', $products->id) }}" class="btn btn-warning" style="border-radius: 10px; margin-right: 5px;">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>

                        <form action="{{ route('products.destroy', $products->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Data !?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3" style="text-align: center; vertical-align: middle;">Data Tidak Ditemukan</td>
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
