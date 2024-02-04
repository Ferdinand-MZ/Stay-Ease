<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ProductsM extends Model
{
    use HasFactory, Searchable;
    protected $table = "products";
    protected $fillable = ["id", "nama_produk", "harga_produk"];

    public function searchableAs()
    {
        return 'products';
    }

    public function toSearchableArray()
    {
        return [
            'id'=>$this->id,
            'nama_produk'=> $this->nama_produk,
            'created_at'=> $this->created_at,
        ];
    }
    
}