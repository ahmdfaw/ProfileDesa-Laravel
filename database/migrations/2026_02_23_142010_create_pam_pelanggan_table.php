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
        Schema::create('pam_pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_meteran')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('no_hp', 20)->nullable();
            $table->decimal('tarif_per_m3', 10, 2)->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pam_pelanggan');
    }
};
