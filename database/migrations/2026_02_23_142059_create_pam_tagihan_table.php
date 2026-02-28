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
        Schema::create('pam_tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pam_pelanggan')->cascadeOnDelete();
            $table->tinyInteger('bulan');
            $table->smallInteger('tahun');
            $table->decimal('angka_awal', 10, 2);
            $table->decimal('angka_akhir', 10, 2);
            $table->decimal('pemakaian', 10, 2);
            $table->decimal('tarif_saat_catat', 10, 2);
            $table->decimal('total_tagihan', 10, 2);
            $table->enum('status', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
            $table->date('tanggal_bayar')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->timestamps();

            $table->unique(['pelanggan_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pam_tagihan');
    }
};
