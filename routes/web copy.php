<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TransactionsDownload;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\UsersR;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\TransactionsPDF;
use App\Http\Controllers\ProductsPDF;

// Default route
Route::get('/', function () {
    return redirect('/login');
});

// routes/web.php

Route::get('/booking/pdfFilter', [BookingController::class, 'pdfFilter'])->name('booking.pdfFilter')->middleware('userAkses:admin');

// Dashboard route (protected by 'auth' middleware)
Route::get('/dashboard', function () {
$subtitle = 'Homepage';
return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'show']);


// Authentication routes
Route::get('logout', [LoginC::class, 'logout'])->name('logout')->middleware('auth');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action')->middleware('guest');
Route::get('login', [LoginC::class, 'login'])->name('login')->middleware('guest');

Route::get('profile', [UsersR::class, 'profile'])->name('profile')->middleware('auth');

// Booking (protected by 'userAkses:kasir' middleware)
Route::middleware(['userAkses:kasir,owner,admin'])->group(function () {
    Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::get('booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('booking/destroy/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    // web.php atau rute yang sesuai
    Route::post('/booking/{id}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::get('/booking/pdf/{nomor_unik}', [BookingController::class, 'download'])->name('booking.download');
    route::get('booking/pdf', [BookingController::class, 'pdf'])->middleware('auth');
    });

// Tamu routes
Route::middleware(['userAkses:kasir,owner,admin'])->group(function () {
    Route::get('tamu', [TamuController::class, 'index'])->name('tamu.index');
    Route::get('tamu/create', [TamuController::class, 'create'])->name('tamu.create');
    Route::post('tamu/store', [TamuController::class, 'store'])->name('tamu.store');
    Route::get('tamu/edit/{id}', [TamuController::class, 'edit'])->name('tamu.edit');
    Route::put('tamu/update/{id}', [TamuController::class, 'update'])->name('tamu.update');
    Route::delete('tamu/destroy/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');
    route::get('tamu/pdf', [TamuController::class, 'allpdf'])->middleware('auth');
    Route::get('tamu/downloadAll/{date}', [TamuController::class, 'downloadAll'])
    ->name('tamu.downloadAll');
    });

    // Kamar routes
Route::middleware(['userAkses:kasir,owner,admin'])->group(function () {
    Route::get('kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('kamar/create', [KamarController::class, 'create'])->name('kamar.create');
    Route::post('kamar/store', [KamarController::class, 'store'])->name('kamar.store');
    Route::get('kamar/edit/{id}', [KamarController::class, 'edit'])->name('kamar.edit');
    Route::put('kamar/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('kamar/destroy/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
    Route::get('kamar/downloadAll/{date}', [KamarController::class, 'downloadAll'])
    ->name('kamar.downloadAll');
    route::get('kamar/pdf', [KamarController::class, 'allpdf'])->middleware('auth');
    });

// Users routes (protected by 'userAkses:owner' middleware)
Route::middleware(['userAkses:owner,admin'])->group(function () {
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change');
Route::delete('users/destroy/{id}', [UsersR::class, 'destroy'])->name('users.destroy');
Route::resource('users', UsersR::class);
});

Route::resource('log', LogC::class);
// ->middleware('userAkses:admin, kasir')

route::get('transactions/pdf', [TransactionsPDF::class, 'pdf'])
->middleware('auth');
Route::get('transactions/download/{id}', [TransactionsDownload::class, 'pdf'])->middleware('auth');