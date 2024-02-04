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
      <a href="{{ route('booking.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
      </a>
    <br><br>

  <form action="{{ route('booking.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
          <div class="form-group">
            <label>Nomer Unik</label>
            <input name="nomor_unik" type="number" class="form-control" placeholder="..." value="{{ $data->nomor_unik}}" readonly>
            @error('nomor_unik')
                <p>{{ $message }}</p>
            @enderror
          </div>
          
          <div class="form-group">
              <label for="nama_tamu">Nama Tamu : </label>
              <select name="nama_tamu" class="form-control" value="{{ $data->nama_tamu }}" required>
                  @foreach($tamulist as $tamu)
                  <option value="{{ $tamu }}" {{ $data->nama_tamu == $tamu ? 'selected' : '' }}>
                    {{ $tamu }}
                  </option>
                  @endforeach
              </select>
          </div>
          
          <div class="form-group">
              <label for="no_kamar">Nomer Kamar : </label>
              <select name="no_kamar" class="form-control" value="{{ $data->no_kamar }}" required>
                  @foreach($kamarlist as $kamar)
                      <option value="{{ $kamar }}">{{ $kamar }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="check_in">Tanggal Check-In :</label>
              <input type="date" name="check_in" class="form-control" value="{{ $data->check_in }}" required>
          </div>
          <div class="form-group">
              <label for="check_out">Tanggal Check-Out :</label>
              <input type="date" name="check_out" class="form-control" value="{{ $data->check_out }}" required>
          </div>
          {{-- You may need to adjust the total_harga calculation based on your business logic --}}
          <div class="form-group">
              <label for="uang_bayar">Uang Bayar :</label>
              <input type="number" name="uang_bayar" class="form-control" value="{{ $data->uang_bayar }}" required>
          </div>

          <button type="submit" class="btn btn-primary">Create Booking</button>
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