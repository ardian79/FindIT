<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTemuan extends Model
{
    use HasFactory;

    protected $table = 'barang_temuan';

    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'lokasi_ditemukan',
        'tanggal_ditemukan',
        'deskripsi',
        'foto_barang',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function klaim()
    {
        return $this->hasMany(Klaim::class, 'barang_temuan_id');
    }

    protected function casts(): array
    {
        return [
            'tanggal_ditemukan' => 'date',
        ];
    }
}
