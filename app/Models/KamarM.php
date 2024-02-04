<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class KamarM extends Model
{
    use HasFactory, Searchable;
    protected $table = "kamar";
    protected $fillable = ["id", "foto_kamar", "no_kamar", "tipe_kamar", "harga", "fasilitas", "status"];

    public function searchableAs()
    {
        return 'kamar';
    }

    public function bookings()
    {
        return $this->hasMany(BookingM::class, 'no_kamar', 'no_kamar');
    }
}
