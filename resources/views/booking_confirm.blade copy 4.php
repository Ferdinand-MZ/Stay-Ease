@extends('sbadmin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi Booking</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('booking.store') }}" method="post" id="bookingForm">
                @csrf
                @foreach($bookings as $booking)
                <div class="bookingForm">
                    <input type="hidden" name="bookings[{{ $loop->index }}][nomor_unik]" value="{{ $booking->nomor_unik }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][nama_tamu]" value="{{ $booking->nama_tamu }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][no_kamar]" value="{{ $booking->no_kamar }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][check_in]" value="{{ $booking->check_in }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][check_out]" value="{{ $booking->check_out }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][total_harga]" value="{{ $booking->total_harga}}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][total_transaksi]" value="{{ $totalTransaction }}">
                    <input type="hidden" name="bookings[{{ $loop->index }}][uang_bayar]" value="{{ $booking->uang_bayar }}">

                    <h5>Detail Booking</h5>
                    <p>Nomor Unik : {{ $booking->nomor_unik }}</p>
                    <p>Nama Tamu: {{ $booking->nama_tamu }}</p>
                    <p>Nomor Kamar: {{ $booking->no_kamar }}</p>
                    <p>Tanggal Check-In: {{ $booking->check_in }}</p>
                    <p>Tanggal Check-Out: {{ $booking->check_out }}</p>
                    <p>Total Harga: {{ $booking->total_harga }}</p>

                    <div class="form-group">
                        <label for="uang_bayar">Uang Bayar :</label>
                        <input type="number" name="bookings[{{ $loop->index }}][uang_bayar]" class="form-control" required>
                        @error('bookings.' . $loop->index . '.uang_bayar')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @endforeach

                

                <p id="kaf"> Total Transaksi : {{$totalTransaction}}</p>

                <button type="submit" class="btn btn-primary" id="submitBtn">Konfirmasi Semua Booking</button>
            </form>
            <a href="{{ route('booking.create') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</section>

<script>
  $(document).ready(function () {
    calculateTotalTransaction(); 
    $('#bookingForm').submit(function (event) {
        // Iterate through each booking form
        var allValid = true;
        $('.bookingForm').each(function () {
            var form = $(this);

            // Calculate total_harga for each booking
            var totalHarga = parseFloat(form.find('input[name^="bookings["][name$="][total_harga]"]').val());
            var uangBayar = parseFloat(form.find('input[name^="bookings["][name$="][uang_bayar]"]').val());

            // Check if 'uang_bayar' is sufficient to cover 'total_harga'
            if (uangBayar < totalHarga) {
                alert('Uang Bayar Tidak Cukup');
                event.preventDefault(); // Prevent form submission
                allValid = false;
                return false; // Stop further processing
            }

            calculateTotalTransaction();
        });

        if (allValid) {
            calculateTotalTransaction(); // Calculate total transaction if all validations pass
        }

        // Continue with form submission if all validations pass
        var formData = $(this).serialize();
        console.log(formData);
        // Now you can submit the form or send it via Ajax as needed.
    });

        function calculateTotalTransaction() {
            var totalTransaction = 0;

            // Iterate through each booking form
            $('.bookingForm').each(function () {
                var totalHarga = parseFloat($(this).find('input[name^="bookings["][name$="][total_harga]"]').val());
                totalTransaction += totalHarga;
            });

            // Update the total transaction displayed on the page
            $('#totalTransaction').text('Rp. ' + totalTransaction.toLocaleString('id-ID'));
        }

        // Continue with form submission if all validations pass
        var formData = $(this).serialize();
        console.log(formData);
        // Now you can submit the form or send it via Ajax as needed.
    });


</script>

@endsection