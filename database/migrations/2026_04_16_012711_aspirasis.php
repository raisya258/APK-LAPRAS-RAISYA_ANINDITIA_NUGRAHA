<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')->constrained('users')->cascadeonDelete();
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDeleteonDelete();

            $table->string('judul_sarana');
            $table->string('lokasi');
            $table->text('keterangan');
            $table->string('foto')->nullable();

          //status
            $table->enum('status', [
                'menunggu',
                'proses',
                'selesai',
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};


