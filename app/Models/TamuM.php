<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TamuM extends Model
{
    use HasFactory, Searchable;

    protected $table = "tamu";
    protected $fillable = ["id", "nama_tamu", "no_ktp", "tgl_lahir", "no_hp", "jk"];

    public function searchableAs()
    {
        return 'tamu';
    }

    // Define relationship with Booking model
    public function bookings()
    {
        return $this->hasMany(BookingM::class);
    }
}
