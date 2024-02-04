<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TransactionsM extends Model
{
    use HasFactory, Searchable;
    protected $table = "transactions";
    protected $fillable = ["id", "id_produk", "nama_pelanggan", "nomor_unik", "uang_bayar", "uang_kembali"];

    public function searchableAs()
    {
        return 'transactions';
    }

    public function toSearchableArray()
    {
        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')->join('products', 'products.id', '=', 'transactions.id_produk')->get();
        return [
            'nama_produk'     => $this->nama_produk,
            'nama_pelanggan' => $this->nama_pelanggan,
            'created_at'    => $this->created_at,
        ];
    }

}