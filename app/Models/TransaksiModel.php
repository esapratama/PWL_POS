<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use App\Models\BarangModel;

class TransaksiModel extends Model
{
    protected $table = 'transaksis'; 
protected $primaryKey = 'transaksi_id'; 

protected $fillable = [
    'barang_id', // Foreign key ke barang
    'jumlah'
];

// Relasi ke tabel barang
public function barang(): BelongsTo
{
    return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
}

}
