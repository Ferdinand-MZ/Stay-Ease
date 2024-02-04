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
        <h3 class="card-title">Edit Data Pengguna</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

      <form action="{{ route('users.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="form-group">
          <div id="imagePreview" class="form-group">
            @if(Auth::user()->pfp)
            <img src="{{ asset('storage/' . $data->pfp) }}" alt="Profile Picture" style="max-width: 200px; max-height: 150px;">
            @else
            <p>No image selected</p>
            @endif
        </div>
          <label>Profile Picture</label>
          <input name="pfp" type="file" class="form-control" id="pfp" onchange="previewImage()">
          @error('pfp')
              <p>{{ $message }}</p>
          @enderror
      </div>
      
        <div class="form-group">
            <label>Username</label>
            <input name="username" type="text" class="form-control" placeholder="..."
            value="{{ $data->username }}" readonly>
            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input name="name" type="text" class="form-control" placeholder="..."
            value="{{ $data->name }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" value="{{ $data->role }}">
              <option value="-1">-Pilih Role</option>
              <option value="kasir" @if($data->role == 'kasir') selected @endif>Kasir</option>
              <option value="owner" @if($data->role == 'owner') selected @endif>Owner</option>
              <option value="admin" @if($data->role == 'admin') selected @endif>Admin</option>
            </select>
            @error('role')
                <p>{{ $message }}</p>
            @enderror
        </div>
        
        @csrf
        @method('put')
        <button type="submit" class="btn btn-primary" style="margin-left: 3px;" onclick="return confirm('Konfirmasi  Data Pengguna !?')">
          Edit
        </button>
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
