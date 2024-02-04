@extends('sbadmin')
@section('content')
<!-- Content Header (Page header) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
        <h3 class="card-title">Edit Data Tamu</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('tamu.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

  <form action="{{ route('tamu.update', $data->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama Tamu</label>
            <input name="nama_tamu" type="text" class="form-control" placeholder="..."  value="{{ $data->nama_tamu }}">
            @error('nama_produk')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Nomer KTP</label>
            <input name="no_ktp" type="number" class="form-control" placeholder="..." 
            value="{{ $data->no_ktp }}">
            @error('no_ktp')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
          <label>Tanggal Lahir</label>
          <input name="tgl_lahir" type="date" class="form-control" placeholder="..." 
          value="{{ $data->tgl_lahir }}">
          @error('tgl_lahir')
              <p>{{ $message }}</p>
          @enderror
      </div>

      <div class="form-group">
        <label>Nomer HP</label>
        <input name="no_hp" type="number" class="form-control" placeholder="..." 
        value="{{ $data->no_hp }}">
        @error('no_hp')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <select name="jk" class="form-control" placeholder="..." value="{{ $data->no_ktp }}">
          <option value="laki-laki">Laki-Laki</option>
          <option value="perempuan">Perempuan</option>
      </select>
      @error('jk')
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