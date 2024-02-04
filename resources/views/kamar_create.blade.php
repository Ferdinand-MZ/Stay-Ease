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
        <h3 class="card-title">Tambah Data Kamar</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('kamar.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

      <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
      <label>Foto Kamar</label>
      <input name="foto_kamar" type="file" class="form-control" id="foto_kamar_input" onchange="previewImage()">
      @error('foto_kamar')
          <p>{{ $message }}</p>
      @enderror
  </div>
  
  <!-- Image preview container -->
  <div id="imagePreview" style="width: 200px; height: 150px;"></div>

  <br>

        <div class="form-group">
            <label>Nomer Kamar</label>
            <input name="no_kamar" type="number" class="form-control" placeholder="..." required>
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
      </div>
      <div class="form-group">
        <label>Harga per malam</label>
        <input name="harga" type="number" class="form-control" placeholder="..." required>
        @error('harga')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
      <label>Fasilitas</label>
      <input name="fasilitas" type="text" class="form-control" placeholder="..." required>
      @error('fasilitas')
          <p>{{ $message }}</p>
      @enderror
  </div>
  {{-- <div class="form-group">
      <label>status</label>
      <select name="status" class="form-control">
        <option value="free">Free</option>
        <option value="reserved">Reserved</option>
    </select>
      @error('status')
          <p>{{ $message }}</p>
      @enderror
  </div> --}}
    
        <input type="submit" name="submit" class="btn btn-success" value="Tambah">
      </form>
    </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <script>
      function previewImage() {
          var input = document.getElementById('foto_kamar_input');
          var previewContainer = document.getElementById('imagePreview');
          var previewImage = previewContainer.querySelector('img');
  
          if (previewImage) {
              // If there's already an image, remove it
              previewImage.remove();
          }
  
          var file = input.files[0];
  
          if (file) {
              var reader = new FileReader();
  
              reader.onload = function (e) {
                  var newImage = document.createElement('img');
                  newImage.setAttribute('src', e.target.result);
                  newImage.setAttribute('style', 'max-width: 200px; max-height: 150px;');
                  previewContainer.appendChild(newImage);
              }
  
              reader.readAsDataURL(file);
          } else {
              // If no file is selected, display a default message or leave it empty
              var defaultText = document.createElement('p');
              defaultText.textContent = 'No image selected';
              previewContainer.appendChild(defaultText);
          }
      }
  </script>

  </section>
  <!-- /.content -->
@endsection