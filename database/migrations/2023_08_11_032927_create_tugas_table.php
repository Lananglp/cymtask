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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('pembuat_tugas');
            $table->string('nama_tugas');
            $table->string('penanggung_jawab');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->datetime('batas_waktu')->nullable();
            $table->boolean('tenggat')->default(false);
            $table->string('status')->nullable();
            $table->string('disetujui')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
