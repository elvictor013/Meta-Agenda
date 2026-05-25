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
        Schema::create('coordenador_curso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coordenador_id')->constrained('coordenadores')->cascadeOnDelete();
            $table->foreignId('curso_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordenador_cursos');
    }
};
