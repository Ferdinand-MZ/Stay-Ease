<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class BookingM extends Model
{
    use HasFactory, Searchable;
    protected $table = 'booking';
    protected $fillable = 
    ['nomor_unik', 
    'nama_tamu', 
    'no_kamar', 
    'check_in', 
    'check_out', 
    'total_harga',
    'total_transaksi', 
    'uang_bayar',
    'status'];

    public function searchableAs()
    {
        return 'booking';
    }

    public function toSearchableArray()
    {
        return [
            'check_in'=> $this->check_in,
            'created_at'=> $this->created_at,
        ];
    }

    public function tamu()
    {
        return $this->belongsTo(TamuM::class, 'nama_tamu', 'nama_tamu');
    }

    public function kamar()
    {
        return $this->belongsTo(KamarM::class, 'no_kamar', 'no_kamar');
    }
}
