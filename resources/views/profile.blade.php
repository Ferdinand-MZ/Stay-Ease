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
            <h3 class="card-title">Profile</h3>
        </div>
        <div class="card-body">
            <div class="form-group d-flex justify-content-between">
                <a href="{{url('dashboard')}}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
            
                <form action="{{ route('users.delete',  ['id' => Auth::user()->id]) }}" method="POST" style="border-radius: 10px; margin-left: 10px;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Akun mu !?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            <!-- Konten lainnya -->

            <div id="imagePreview" class="form-group">
                @if(Auth::user()->pfp)
                <img src="{{ asset('storage/' . Auth::user()->pfp) }}" alt="Profile Picture" style="max-width: 200px; max-height: 150px;">
                @else
                <p>No image selected</p>
                @endif
            </div>
            

            <form action="{{ route('users.custom', Auth::user()->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>Ganti Profile Picture</label>
                    <input name="pfp" type="file" class="form-control" id="pfp" onchange="previewImage()">
                    @error('pfp')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" placeholder="..." value="{{ Auth::user()->username }}" readonly>
                    @error('username')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="name" type="text" class="form-control" placeholder="..." value="{{ Auth::user()->name }}">
                    @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                
                <div class="form-group d-flex">
                    <button type="submit" class="btn btn-success mr-2" onclick="return confirm('Konfirmasi Data Pengguna !?!')">
                        Submit
                    </button>
                </form>
                
                    <form method="GET" action="{{ route('users.profilepassword', ['id' => Auth::user()->id]) }}">
                        <button type="submit" class="btn btn-success" style="background-color: blue; color: white;">
                             Ganti Kata Sandi
                        </button>
                    </form>
                </div>
                
           
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
