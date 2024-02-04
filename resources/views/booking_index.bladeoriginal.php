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
    @if (in_array(Auth::user()->role, ['owner']))
    <form action="{{ route('booking.pdfFilter') }}" method="GET" style="font-size: 12px;"> 
        <div class="form-group" id="dateRangePicker"> 
            <label for="dateRangePicker">Pilih Range Tanggal Unduh PDF:</label> 
            <div class="input-daterange input-group"> 
                <input type="date" class="input-sm form-control" name="check_in_start" style="font-size: 12px;" /> 
                <div class="input-group-prepend"> 
                    <span class="input-group-text" style="font-size: 12px;">Sampai</span> 
                </div> 
                <input type="date" class="input-sm form-control" name="check_in_end" style="font-size: 12px;" /> 
                <button type="submit" class="btn btn-primary" style=" margin-left: 10px; font-size: 12px;">
                    <i class="fas fa-download"></i> Unduh PDF
                </button> 
            </div> 
        </div> 
    </form>
    @endif
    <!-- Default box -->
        <div class="card">
            <div class="card">
                <div class="card-header" style="background-color:#36b9cc;">
                    <h3 class="card-title" style="color: white;">Daftar Tamu</h3>  
                </div>

            <div class="card-body">
                @if($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
                @endif

                @if (in_array(Auth::user()->role, ['owner']))
                    <a href="{{ url('booking/pdf') }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Unduh Daftar Booking
                    </a>
                    <br>
                    <br>
                    
                @endif

                @if (in_array(Auth::user()->role, ['kasir']))
                <a href="{{ route('booking.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data Booking</a>
                <br>
                <br>
                @endif
                <table class="table table-striped table-hover" id="myTable">
                    <thead>
                    <tr class="table-dark">
                        <th style="text-align: center; vertical-align: middle;">Nomer Unik</th>
                        <th style="text-align: center; vertical-align: middle;">Nama Tamu</th>
                        <th style="text-align: center; vertical-align: middle;">Detail Kamar</th>
                        <th style="text-align: center; vertical-align: middle;">Check In</th>
                        <th style="text-align: center; vertical-align: middle;">Check Out</th>
                        <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                        <th style="text-align: center; vertical-align: middle;">Total Transaksi</th>
                        <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
                        <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
                        <th style="text-align: center; vertical-align: middle;">Status</th>
                        {{-- <th style="text-align: center; vertical-align: middle;">Tanggal</th> --}}

                        @if (in_array(Auth::user()->role, ['kasir','admin']))
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    @if(count($booking) > 0)
                    @foreach ($booking as $data)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->nomor_unik }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->nama_tamu }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                            @if($data->kamar)
                                {{ $data->no_kamar }} - {{ $data->kamar->tipe_kamar }} - {{ $data->kamar->harga }}
                            @else
                                Informasi tidak tersedia
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->check_in }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->check_out }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->total_harga }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->total_transaksi }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->uang_bayar }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->uang_kembali }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $data->status }}</td>
                        {{-- <td style="text-align: center; vertical-align: middle;">{{ $data->created_at }}</td> --}}
                        
                        @if (in_array(Auth::user()->role, ['admin', 'kasir']))
                        <td style="text-align: center; vertical-align: middle;">
                        
                        @if (in_array(Auth::user()->role, ['admin']))

                        <div class="btn-group">
                        <a href="{{ route('booking.edit', $data->id) }}" class="btn btn-warning" style="border-radius: 10px; margin-right: 5px;">
                            <i class="fas fa-pencil-alt" style="color: white;"></i>
                        </a>

                        <form action="{{ route('booking.destroy', $data->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px; margin-left: 5px;" onclick="return confirm('Konfirmasi Hapus Kamar ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        @endif

                        @if (in_array(Auth::user()->role, ['kasir']))
                        <a class="btn btn-primary" style="border-radius: 10px; margin-left: 10px;" data-toggle="modal" data-target="#detailModal{{ $data->id }}">
                            <i class="fas fa-eye" style="color: white;"></i>
                        </a>

                        <a href="{{ route('booking.download', $data->nomor_unik) }}" class="btn btn-info" style="border-radius: 10px; margin-left: 10px;">
                            <i class="fas fa-download" style="color: white;"></i>
                        </a>
                        
                    </div>

                    <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #06A77D;">
                                    <h5 class="modal-title" style="color: white;" id="detailModalLabel{{ $data->id }}">Detail Booking Hotel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Isi modal dengan informasi pemesanan, sesuaikan sesuai kebutuhan -->
                                    <p>Nomer Unik : {{ $data->nomor_unik }}</p>
                                    <p>Nama Tamu : {{ $data->nama_tamu }}</p>
                                    <p>Nomor Kamar : {{ $data->no_kamar }}</p>
                                    <p>Check In : {{ $data->check_in }}</p>
                                    <p>Check Out : {{ $data->check_out }}</p>
                                    <p>Total Harga : {{ $data->total_harga }}</p>
                                    <p>Uang Bayar : {{ $data->uang_bayar }}</p>
                                    <p>Uang Kembali : {{ $data->uang_kembali }}</p>
                                    <p>Status : {{ $data->status }}</p>
                                    <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
                                </div>
                                <div class="modal-footer">
                                    @if ($data->status == 'Checked in')
                                        <form action="{{ route('booking.checkout', $data->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Check Out</button>
                                        </form>
                                    @else
                                        <p>Maaf, sudah Check Out</p>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>

                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9" style="text-align: center; vertical-align: middle;">Data Tidak tersedia</td>
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
