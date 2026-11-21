<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    use HasFactory;

    protected $table = 'klaim';

    protected $fillable = [
        'barang_temuan_id',
        'pengguna_id',
        'keterangan_klaim',
        'status',
        'catatan_petugas',
        'foto_serah_terima',
        'tanggal_diambil',
    ];

    public function barangTemuan()
    {
        return $this->belongsTo(BarangTemuan::class, 'barang_temuan_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    protected function casts(): array
    {
        return [
            'tanggal_diambil' => 'datetime',
        ];
    }
}
