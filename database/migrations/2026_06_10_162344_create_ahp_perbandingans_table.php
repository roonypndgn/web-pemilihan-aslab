<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahp_perbandingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_1_id')->constrained('kriteria_penilaians')->onDelete('cascade');
            $table->foreignId('kriteria_2_id')->constrained('kriteria_penilaians')->onDelete('cascade');
            $table->decimal('nilai_perbandingan', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahp_perbandingans');
    }
};