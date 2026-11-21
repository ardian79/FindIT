<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_temuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->string('nama_barang');
            $table->string('lokasi_ditemukan', 150);
            $table->date('tanggal_ditemukan');
            $table->text('deskripsi');
            $table->string('foto_barang');
            $table->enum('status', ['tersedia', 'diklaim', 'dikembalikan'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_temuan');
    }
};