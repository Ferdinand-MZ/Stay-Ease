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
        <h3 class="card-title">Edit Transaksi</h3>
      </div>
      <div class="card-body">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
        <br><br>

        <form action="{{ route('transactions.update', $transactions->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengedit transaksi ini?');">
        @csrf
        @method('put')

        <div class="form-group">
        <label>Nomor Unik</label>
        <input name="nomor_unik" type="text" class="form-control" placeholder="..."
        value="{{ $transactions->nomor_unik }}" readonly>
        @error('nomor_unik')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
      <label>Nama Pelanggan</label>
      <input name="nama_pelanggan" type="text" class="form-control" placeholder="..."
      value="{{ $transactions->nama_pelanggan }}">
      @error('nama_pelanggan')
          <p>{{ $message }}</p>
      @enderror
  </div>

  <div class="form-group">
      <label>Nama Produk + Harga</label>
      <select name="id_produk" class="form-control">
          <option value="">- Pilih Produk -</option>
          @foreach ($productsM as  $products)
          
          <?php
          if ($products->id == $transactions->id_produk):
            $selected = "selected";
          else:
            $selected = "";
          endif;
          ?>

          <option {{ $selected }} value="{{ $products -> id}}">
              {{ $products->nama_produk }} - {{ $products->harga_produk }}
          </option>
          @endforeach
      </select>
      @error('id_produk')
      <p>{{ $message }}</p>
  @enderror
   </div>

   <div class="form-group">
      <label>Uang Bayar</label>
      <input name="uang_bayar" type="text"
      class="form-control" placeholder="...">
      @error('uang_bayar')
          <p>{{ $message }}</p>
      @enderror
  </div>

          <input type="submit" name="submit" class="btn btn-success" onclick="return confirm('Konfirmasi Edit Data !?') value="Edit">
      </form>
    </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection