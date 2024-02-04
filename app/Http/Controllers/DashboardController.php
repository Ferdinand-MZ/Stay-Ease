<?php

namespace App\Http\Controllers;

use App\Models\BookingM;
use App\Models\KamarM;
use App\Models\TamuM;
use App\Models\LogM;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{ // Assuming you have a Kamar model

public function show()
{

    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Berada di Halaman Dashboard'
    ]);

    $kamarCount = KamarM::count();
    $tamuCount = TamuM::count();
    $bookingCount = BookingM::count();
    $userCount = User::count();


    return view('dashboard', compact('kamarCount','tamuCount','bookingCount', 'userCount'));
}

}
