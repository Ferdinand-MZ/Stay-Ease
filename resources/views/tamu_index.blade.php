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

                @if (in_array(Auth::user()->role, ['owner']))	
                    <a href="{{ url('tamu/pdf') }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Unduh Daftar Tamu
                    </a>
                    <br>
                    <br>
                @endif

                @if (in_array(Auth::user()->role, ['kasir']))
                <a href="{{ route('tamu.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Tamu</a>
                <br>
                <br>
                @endif
                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                    <tr class="table-dark">
                        <th style="text-align: center; vertical-align: middle;">ID Tamu</th>
                        <th style="text-align: center; vertical-align: middle;">Nama Tamu</th>
                        <th style="text-align: center; vertical-align: middle;">Nomer KTP</th>
                        <th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
                        <th style="text-align: center; vertical-align: middle;">Nomer HP</th>
                        <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                        <th style="text-align: center; vertical-align: middle;">Tanggal</th>

                        @if (in_array(Auth::user()->role, ['admin']))
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                    @if(count($tamuM) > 0)
                    @foreach ($tamuM as $data)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->id }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->nama_tamu }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->no_ktp }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->tgl_lahir }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->no_hp }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->jk }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->created_at }}</td>
                        
                        @if (in_array(Auth::user()->role, ['admin']))
                        <td style="text-align: center; vertical-align: middle;">
                        
                        <div class="btn-group">
                            @if (in_array(Auth::user()->role, ['admin']))
                            <a href="{{ route('tamu.edit', $data->id) }}" class="btn btn-warning" style="border-radius: 10px; margin-right: 5px;">
                            <i class="fas fa-pencil-alt" style="color: white;"></i>
                        </a>

                        <form action="{{ route('tamu.destroy', $data->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Tamu ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" style="text-align: center; vertical-align: middle;">Tamu Tidak Ditemukan</td>
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

    <script type= "text/javascript">
        let table = new DataTable('#myTable');
    </script>

</section>
<!-- /.content -->
@endsection
