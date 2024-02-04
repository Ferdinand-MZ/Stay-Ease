@extends('sbadmin')
@section('content')
<!-- Content Header (Page header) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

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
                
                @if (Auth::user()->role == 'admin')
                <a href="{{ route('kamar.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Kamar</a>
                @endif

                @if (in_array(Auth::user()->role, ['admin']))	
                    <a href="{{ url('kamar/pdf') }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Unduh Daftar Kamar
                    </a>
                    <br>
                    <br>
                @endif

                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="myTable">
                <thead>
                    <tr class="table-dark">
                        <th style="text-align: center; vertical-align: middle;">Nomer Kamar</th>
                        <th style="text-align: center; vertical-align: middle;">Foto Kamar</th>
                        
                        <th style="text-align: center; vertical-align: middle;">Tipe Kamar</th>
                        <th style="text-align: center; vertical-align: middle;">Harga per Malam</th>
                        <th style="text-align: center; vertical-align: middle;">Fasilitas</th>
                        <th style="text-align: center; vertical-align: middle;">Status Kamar</th>
                        {{-- <th style="text-align: center; vertical-align: middle;">Tanggal</th> --}}

                        @if (Auth::user()->role == 'admin')
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                    @if(count($kamarM) > 0)
                    @foreach ($kamarM as $data)
                    
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->no_kamar }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <img src="{{ asset('storage/' . $data->foto_kamar) }}" alt="Kamar Image" style="width: 200px; height: 150px;" loading="lazy">
                        </td>
                        
                        <td style="text-align: center; vertical-align: middle;">{{ $data->tipe_kamar }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->harga }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->fasilitas }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->status }}</td>
                        {{-- <td style="text-align: center; vertical-align: middle;">{{ $data->created_at }}</td> --}}
                        
                        @if (Auth::user()->role == 'admin')
                        <td style="text-align: center; vertical-align: middle;">
                        
                        <div class="btn-group">
                        <a href="{{ route('kamar.edit', $data->id) }}" class="btn btn-warning" style="border-radius: 10px; margin-right: 5px;">
                            <i class="fas fa-pencil-alt" style="color: white;"></i>
                        </a>

                        <form action="{{ route('kamar.destroy', $data->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Kamar ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" style="text-align: center; vertical-align: middle;">Data Tidak tersedia</td>
                    </tr>
                    
                    @endif
                </table>
            </div>
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
