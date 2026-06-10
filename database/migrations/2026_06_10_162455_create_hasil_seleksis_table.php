<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_seleksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran_aslabs')->onDelete('cascade');
            $table->decimal('skor_akhir', 10, 4);
            $table->integer('ranking');
            $table->enum('status_kelulusan', ['lulus', 'cadangan', 'tidak_lulus']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_seleksis');
    }
};