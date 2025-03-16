<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
 class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; 
    protected $primaryKey = 'barang_id'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'barang_id',
        'kategori_id',
        'nama_barang',
        'harga',
        'stok',
    ];

   public function kategori()
{
    return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
}

}
