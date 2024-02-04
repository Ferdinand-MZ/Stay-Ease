@extends('sbadmin')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


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
        <div class="card-header" style="background-color:#36b9cc;">
            <h3 class="card-title" style="color: white;">Daftar Tamu</h3>  
        </div>
        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif

            @if (in_array(Auth::user()->role, ['admin']))
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Tambah User</a>

            @endif

            @if (in_array(Auth::user()->role, ['admin']))	
                    <a href="{{ url('users/pdf') }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Unduh Daftar User
                    </a>
                    <br>
                    <br>
                @endif

            <table class="table table-striped table-bordered" id="myTable">
                <thead>
                <tr class="table-dark">
                    <th style="text-align: center">Profile Picture</th>
                    <th style="text-align: center">Nama Lengkap</th>
                    <th style="text-align: center">Username</th>
                    <th style="text-align: center">Role</th>
                    @if (in_array(Auth::user()->role, ['admin','owner']))
                    <th style="text-align: center">Aksi</th>
                    @endif
                </tr>
                </thead>
                @if(count($usersM) > 0)
                @foreach ($usersM as $data)
                 @if($data->id != Auth::user()->id)
                <tr>
                    <td style="text-align: center">
                        <img src="{{ asset('storage/' . $data->pfp) }}" alt="Profile Picture" style="width: 132px; height: 132px;">
                    </td>
                    <td style="text-align: center">{{ $data->name }}</td>
                    <td style="text-align: center">{{ $data->username }}</td>
                    <td style="text-align: center">{{ $data->role }}</td>

                    @if (in_array(Auth::user()->role, ['admin','owner']))
                    <td style="text-align: center">

                        <div class="btn-group" style="margin-right: 1px;">
                            <a href="{{ route('users.edit', $data->id) }}" class="btn btn-warning" style="border-radius: 10px; margin-right: 5px;">
                                <i class="fas fa-pencil-alt" style="color: white;"></i>
                            </a>
                            
                            <a href="{{ route('users.changepassword', $data->id) }}" class="btn btn-info" style="border-radius: 10px; margin-left: 5px;">
                                <i class="fas fa-key" style="color: white;"></i>
                            </a>
                            
                            <form action="{{ route('users.destroy', $data->id) }}" method="POST" style="border-radius: 10px; margin-left: 10px;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data Pengguna !?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                @endif

                    </td>
                </tr>
                @endif
                @endforeach
                @else
                <tr>
                    <td colspan="4" style="text-align: center">Data Tidak Ditemukan</td>
                </tr>
                @endif
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <script type= "text/javascript">
        let table = new DataTable('#myTable');
    </script>
</section>
<!-- /.content -->
@endsection
