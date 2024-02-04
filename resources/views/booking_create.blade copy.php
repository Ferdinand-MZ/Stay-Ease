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
        <h3 class="card-title">Tambah Data Booking</h3>
      </div>
      <div class="card-body">
      <a href="{{ route('booking.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>

    <form action="{{ route('booking.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label>Nomer Unik</label>
        <input name="nomor_unik" type="number" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
        @error('nomor_unik')
            <p>{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
          <label for="nama_tamu">Nama Tamu : </label>
          <select name="nama_tamu" class="form-control" required>
              @foreach($tamulist as $tamu)
                  <option value="{{ $tamu }}">{{ $tamu }}</option>
              @endforeach
          </select>
      </div>
      <div class="form-group">
        <label for="no_kamar">Nomer Kamar : </label>
        <select name="no_kamar" class="form-control" required>
            @foreach($kamarlist as $kamar)
                <option value="{{ $kamar->no_kamar }}">
                    {{ $kamar->no_kamar }} | Harga per malam : {{ $kamar->harga }} | Tipe Kamar : {{ $kamar->tipe_kamar }}
                </option>
            @endforeach
        </select>
    </div>
      <div class="form-group">
          <label for="check_in">Tanggal Check-In :</label>
          <input type="date" name="check_in" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="check_out">Tanggal Check-Out :</label>
          <input type="date" name="check_out" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary" formaction="{{ route('booking.confirm') }}">Review Booking</button>
  </form>
    </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection