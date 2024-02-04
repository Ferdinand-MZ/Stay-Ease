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
        <h3 class="card-title">Edit Data Produk</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>

  <form action="{{ route('products.update', $data->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama Produk</label>
            <input name="nama_produk" type="text" class="form-control" placeholder="..."  value="{{ $data->nama_produk }}">
            @error('nama_produk')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Harga Produk</label>
            <input name="harga_produk" type="number" class="form-control" placeholder="..." 
            value="{{ $data->harga_produk }}">
            @error('harga_produk')
                <p>{{ $message }}</p>
            @enderror
        </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Edit">
      </form>
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