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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kegiatan');
            $table->foreignId('id_anak');
            $table->integer('berat_badan');
            $table->integer('tinggi_badan');
            $table->integer('lingkar_kepala');
            $table->string('vitamin');
            $table->string('imunisasi');
            $table->string('stunting');
            $table->date('tgl_pemeriksaan');
            $table->string('keterangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
