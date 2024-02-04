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
        <h3 class="card-title">Edit Data Kamar</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

  <form action="{{ route('kamar.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
          <label for="foto_kamar">Foto Kamar</label>
          <input name="foto_kamar" type="file" class="form-control" id="foto_kamar_input" accept="image/*" onchange="previewImage(this)">
          <img id="foto_kamar_preview" src="{{ asset('storage/' . $data->foto_kamar) }}" alt="Preview" style="max-width: 200px; max-height: 150px;">
          
          @error('foto_kamar')
              <p>{{ $message }}</p>
          @enderror
      </div>

        <div class="form-group">
            <label>No Kamar</label>
            <input name="no_kamar" type="text" class="form-control" placeholder="..."  value="{{ $data->no_kamar }}">
            @error('no_kamar')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
          <label>Tipe Kamar</label>
          <select name="tipe_kamar" class="form-control">
              <option value="standar">Standar</option>
              <option value="executive">Executive</option>
              <option value="luxury">Luxury</option>
          </select>
          @error('tipe_kamar')
              <p>{{ $message }}</p>
          @enderror

        <div class="form-group">
          <label>Harga</label>
          <input name="harga" type="number" class="form-control" placeholder="..." 
          value="{{ $data->harga }}">
          @error('harga')
              <p>{{ $message }}</p>
          @enderror
      </div>

      <div class="form-group">
        <label>Fasilitas</label>
        <input name="fasilitas" type="text" class="form-control" placeholder="..." 
        value="{{ $data->fasilitas }}">
        @error('fasilitas')
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

    <script>
      function previewImage(input) {
          var preview = document.getElementById('foto_kamar_preview');
          var file = input.files[0];
          var reader = new FileReader();
  
          reader.onloadend = function () {
              preview.src = reader.result;
          };
  
          if (file) {
              reader.readAsDataURL(file);
          } else {
              preview.src = "{{ asset('storage/' . $data->foto_kamar) }}";
          }
      }
  </script>

  </section>
  <!-- /.content -->
@endsection