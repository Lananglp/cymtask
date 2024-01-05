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
        Schema::create('waktu_absensi', function (Blueprint $table) {
            $table->id();
            $table->time('awalMasuk');
            $table->time('akhirMasuk');
            $table->time('awalKeluar');
            $table->time('akhirKeluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_absensi');
    }
};
