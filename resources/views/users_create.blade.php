@extends('sbadmin')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
        <h3 class="card-title">Tambah Data Pengguna</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

      <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
          <label>Profile Picture</label>
          <input name="pfp" type="file" class="form-control" id="pfp" onchange="previewImage()">
          @error('pfp')
              <p>{{ $message }}</p>
          @enderror
      </div>

      <div id="imagePreview" style="width: 132px; height: 132px;"></div>
      <br>
        <div class="form-group">
            <label>Username</label>
            <input name="username" type="text" class="form-control" placeholder="...">
            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input name="name" type="text" class="form-control" placeholder="...">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control" placeholder="...">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Ulangi Password</label>
            <input name="password_confirm" type="password" class="form-control" placeholder="...">
            @error('password_confirm')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option>-Pilih Role</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="submit" name="submit" class="btn btn-success" value="Tambah">
      </form>
    </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <script>
      function previewImage() {
          var input = document.getElementById('pfp');
          var previewContainer = document.getElementById('imagePreview');
          var previewImage = previewContainer.querySelector('img');
  
          // Clear previous preview
          previewContainer.innerHTML = '';
  
          if (input.files && input.files[0]) {
              var reader = new FileReader();
  
              reader.onload = function (e) {
                  var newImage = document.createElement('img');
                  newImage.src = e.target.result;
                  newImage.style.maxWidth = '200px';
                  newImage.style.maxHeight = '150px';
                  previewContainer.appendChild(newImage);
              }
  
              reader.readAsDataURL(input.files[0]);
          }
      }
  </script>

  </section>
  <!-- /.content -->
@endsection
