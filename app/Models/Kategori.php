<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function barangTemuan()
    {
        return $this->hasMany(BarangTemuan::class, 'kategori_id');
    }

    public function laporanKehilangan()
    {
        return $this->hasMany(LaporanKehilangan::class, 'kategori_id');
    }
}