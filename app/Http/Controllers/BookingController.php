<?php

namespace App\Http\Controllers;

use App\Models\BookingM;
use App\Models\KamarM;
use App\Models\LogM;
use App\Models\TamuM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class BookingController extends Controller
{

    public function index()
    {
        // $booking = BookingM::all();
        $booking = BookingM::search(request('search'))->paginate(10);
        $vcari = request('search');
        return view('booking_index', compact('booking','vcari'));
    }

    public function create()
    {
        $subtitle = "Tambah Booking";
        $tamulist = TamuM::pluck('nama_tamu', 'nama_tamu');
        $kamarlist = KamarM::where('status', 'FREE')->get();
        return view('booking_create', compact('subtitle', 'kamarlist', 'tamulist'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Booking'
        ]);
    
        $request->validate([
            'bookings.*.nomor_unik' => 'required|unique:booking,nomor_unik',
            'bookings.*.nama_tamu' => 'required',
            'bookings.*.no_kamar' => 'required',
            'bookings.*.check_in' => 'required|date',
            'bookings.*.check_out' => 'required|date|after:bookings.*.check_in',
            'uang_bayar' => 'required|numeric|min:0',
            // Add more validation rules as needed
        ]);
    
        // Process each booking
        foreach ($request->bookings as $bookingData) {
            $booking = new BookingM($bookingData);

            $booking->uang_bayar = $request->uang_bayar;
    
            // Calculate uang_kembali
            $booking->uang_kembali = $booking->uang_bayar - $booking->total_transaksi;
    
            // Save the booking
            $booking->save();
            $LogM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Menambahkan Booking'
            ]);
    
            // Update status to 'booked'
            KamarM::where('no_kamar', $booking->no_kamar)->update(['status' => 'booked']);

        }
    
        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan');
    }
    
    
    public function confirm(Request $request)
{
    $totalBayar = 0;
    $tamulist = TamuM::pluck('nama_tamu', 'nama_tamu');
    $kamarlist = KamarM::where('status', 'free')->pluck('no_kamar', 'no_kamar');

    // Validasi data formulir
    $request->validate([
        'nomor_unik.*' => 'required',
        'nama_tamu.*' => 'required',
        'no_kamar.*' => 'required',
        'check_in.*' => 'required|date',
        'check_out.*' => 'required|date|after:check_in.*',
        // Additional validation for other fields
    ]);

    // Loop through the arrays to create BookingM instances
    $bookings = [];
    $totalTransaction = 0;
    foreach ($request->input('nama_tamu') as $key => $value) {
        $booking = new BookingM([
            'nomor_unik' => $request->input('nomor_unik')[$key],
            'nama_tamu' => $request->input('nama_tamu')[$key],
            'no_kamar' => $request->input('no_kamar')[$key],
            'check_in' => $request->input('check_in')[$key],
            'check_out' => $request->input('check_out')[$key],
            // Add other fields as needed
        ]);

        // Calculate total harga for each booking
        $booking->total_harga = $this->calculateTotalHarga($booking->check_in, $booking->check_out, $booking->no_kamar);

        $totalTransaction += $booking->total_harga;
        $totalBayar += $booking->uang_bayar;
        $bookings[] = $booking;
    }
     // Save total transaction in session
     $request->session()->put('totalBayar', $totalBayar);
     $request->session()->put('totalTransaction', $totalTransaction);

    return view('booking_confirm', compact('bookings', 'tamulist', 'kamarlist', 'totalTransaction', 'totalBayar'));
}

     protected function calculateTotalHarga($checkIn, $checkOut, $noKamar)
{
    // Retrieve room price from the Kamar model
    $roomPricePerNight = KamarM::where('no_kamar', $noKamar)->value('harga');

    // Calculate the duration of stay in days
    $duration = strtotime($checkOut) - strtotime($checkIn);
    $totalDays = floor($duration / (60 * 60 * 24));

    // Calculate total_harga
    $totalHarga = $totalDays * $roomPricePerNight;

    return $totalHarga;
}

public function pdf(){

    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Mengunduh Daftar Booking'
    ]);
    
    $bookingM = BookingM::all();
    
    // return view('transaksi_pdf', compact('transaksiM'));
   
    $pdf = PDF::loadview('booking_pdf', ['bookingM' => $bookingM]);
    return $pdf->stream('Daftar Transaksi Booking.pdf');
}

public function download($nomor_unik) {
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Mengunduh detail Booking'
    ]);

    $bookings = BookingM::where('nomor_unik', $nomor_unik)->get(); // Fetch all bookings with the specified nomor_unik

    if ($bookings->isEmpty()) {
        // Handle if data is not found
        return redirect()->back()->with('error', 'Data booking tidak ditemukan');
    }

    $pdf = PDF::loadview('booking_download', ['bookings' => $bookings]);
    return $pdf->stream('Detail Booking ' . $nomor_unik . '.pdf');
}

    public function edit($id)
    {

        $subtitle = "Edit data Booking";
        $data = BookingM::find($id);
        $tamulist = TamuM::pluck('nama_tamu', 'nama_tamu');
        $kamarlist = KamarM::pluck('no_kamar', 'no_kamar');
        return view('booking_edit', compact('subtitle', 'data', 'kamarlist', 'tamulist'));
    }

    public function update(Request $request, $id)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Mengedit Booking'
    ]);

    $request->validate([
        'nama_tamu' => 'required',
        'no_kamar' => 'required',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'uang_bayar' => 'required|integer|min:0',
        'nomor_unik' => 'required'
    ]);

    $booking = BookingM::findOrFail($id);

    // Check if the status is updated to 'Checked out'
    if ($request->status === 'Checked out') {
        KamarM::where('no_kamar', $booking->no_kamar)->update(['status' => 'free']);
    }

    // Update check_in and check_out
    $booking->update([
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
    ]);

    // Calculate total_harga based on the duration of stay and room price
    $booking->total_harga = $this->calculateTotalHarga($request->check_in, $request->check_out, $request->no_kamar);

    // // Update 'uang_bayar'
    // $booking->update([
    //     'uang_bayar' => $request->uang_bayar,
    // ]);

    // Update total_transaksi for all bookings with the same 'nomor_unik'
    $total_transaksi = BookingM::where('nomor_unik', $booking->nomor_unik)->sum('total_harga');
    BookingM::where('nomor_unik', $booking->nomor_unik)->update([
        'total_transaksi' => $total_transaksi,
        'uang_kembali' => $request->uang_bayar - $total_transaksi,
        'uang_bayar' => $request->uang_bayar,
        'nama_tamu' => $request->nama_tamu
    ]);

    // Save the booking
    $booking->save();

    return redirect()->route('booking.index')->with('success', 'Booking berhasil diperbarui !');
}


    public function checkout($id)
    {

        $booking = BookingM::findOrFail($id);

        // Ubah status menjadi 'Checked out'
        $booking->status = 'Checked out';
        
        $booking->save();

        // Update status kamar jika diperlukan
        KamarM::where('no_kamar', $booking->no_kamar)->update(['status' => 'free']);

        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Meng-Check out Booking'
        ]);

        return redirect()->route('booking.index')->with('success', 'Check Out Booking berhasil !');
        
    }

    public function destroy($id)
    {

        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Booking'
        ]);

        BookingM::where('id', $id)->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus !');
    }

    public function pdfFilter(Request $request)
    {
        // Validate the form data
        $request->validate([
            'check_in_start' => 'required|date',
            'check_in_end' => 'required|date|after_or_equal:check_in_start',
        ]);
    
        // Retrieve the input data
        $checkInStart = $request->input('check_in_start');
        $checkInEnd = $request->input('check_in_end');
    
        // Retrieve bookings where check_in is within the specified range
        $bookings = BookingM::whereBetween('check_in', [$checkInStart, $checkInEnd])->get();
    
        // Your PDF generation logic goes here
        // Example using barryvdh/laravel-dompdf:
        $pdf = PDF::loadView('booking_filter', compact('checkInStart', 'checkInEnd', 'bookings'));
    
        // Return the PDF as a response or save it to a file
        return $pdf->download('booking_report.pdf');
    }
}