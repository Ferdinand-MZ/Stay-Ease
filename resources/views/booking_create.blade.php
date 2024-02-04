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
            <a href="{{ route('booking.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
            <br><br>

            <form action="{{ route('booking.store') }}" method="post">
                @csrf
                <div id="bookingContainer">
                    <!-- Initial booking input fields -->
                    <div class="bookingSet">
                        <div class="form-group">
                            <label>Nomer Unik</label>
                            <input name="nomor_unik[]" type="number" class="form-control" placeholder="..."
                                value="{{ random_int(1000000000, 9999999999) }}" readonly>
                            @error('nomor_unik')
                            <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_tamu">Nama Tamu : </label>
                            <select name="nama_tamu[]" class="form-control" required>
                                @foreach($tamulist as $tamu)
                                <option value="{{ $tamu }}">{{ $tamu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_kamar">Pilih kamar : </label>
                            <select name="no_kamar[]" class="form-control" required>
                                @foreach($kamarlist as $kamar)
                                <option value="{{ $kamar->no_kamar }}">
                                    {{ $kamar->no_kamar }} | Harga per malam : {{ $kamar->harga }} | Tipe Kamar :
                                    {{ $kamar->tipe_kamar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="check_in">Tanggal Check-In :</label>
                            <input type="date" name="check_in[]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="check_out">Tanggal Check-Out :</label>
                            <input type="date" name="check_out[]" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" onclick="addBooking()">Tambah Booking</button>
                <button type="submit" class="btn btn-primary" formaction="{{ route('booking.confirm') }}">Review
                    Booking</button>
            </form>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

document.querySelector('form').addEventListener('submit', function (event) {
    if (checkDuplicateNoKamar()) {
        alert('Transaksi tidak dibolehkan untuk Kamar yang sama !');
        event.preventDefault(); // Prevent form submission
    }   else if ( !checkSameNamaTamu()) {
        alert('Nama Tamu Harus Sama !');
        event.preventDefault();
    }
});

function checkDuplicateNoKamar() {
    var noKamarInputs = document.querySelectorAll('select[name="no_kamar[]"]');
    var noKamarValues = Array.from(noKamarInputs).map(function (input) {
        return input.value;
    });

    var uniqueValues = [...new Set(noKamarValues)]; // Use a Set to get unique values

    return noKamarValues.length !== uniqueValues.length;
}

function checkSameNamaTamu() {
    var bookingSets = document.querySelectorAll('.bookingSet');
    var firstSetNamaTamu = bookingSets[0].querySelector('select[name="nama_tamu[]"]').value;

    for (var i = 1; i < bookingSets.length; i++) {
        var namaTamuInput = bookingSets[i].querySelector('select[name="nama_tamu[]"]');
        var namaTamuValue = namaTamuInput.value;

        if (namaTamuValue !== firstSetNamaTamu) {
            return false; // Names are different
        }
    }

    return true; // All names are the same
}

    function addBooking() {
        // Clone the last booking set and append it to the container
        var lastBookingSet = document.querySelector('.bookingSet:last-child');
        var clonedBookingSet = lastBookingSet.cloneNode(true);
    
        // Clear input values in the cloned set
        clonedBookingSet.querySelectorAll('input:not([type="button"]), select').forEach(function (input) {
            input.value = '';
        });
    
        // Update the 'nomor_unik' input field in the cloned set
        clonedBookingSet.querySelector('input[name="nomor_unik[]"]').value = lastBookingSet.querySelector('input[name="nomor_unik[]"]').value;
    
        // Append the cloned set to the container
        document.getElementById('bookingContainer').appendChild(clonedBookingSet);
    }
    
    function generateRandomNomorUnik() {
        return Math.floor(Math.random() * (9999999999 - 1000000000 + 1)) + 1000000000;
    }
    </script>
@endsection
