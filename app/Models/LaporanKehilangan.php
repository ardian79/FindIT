<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKehilangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kehilangan';

    protected $fillable = [
        'pengguna_id',
        'kategori_id',
        'nama_barang',
        'lokasi_hilang',
        'tanggal_hilang',
        'deskripsi',
        'foto_barang',
        'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    protected function casts(): array
    {
        return [
            'tanggal_hilang' => 'date',
        ];
    }
}
