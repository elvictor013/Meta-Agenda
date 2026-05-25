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
        Schema::create('alocacao_turma', function (Blueprint $table) {
    $table->id();

    $table->foreignId('alocacao_id')
        ->constrained('alocacoes')
        ->cascadeOnDelete();

    $table->foreignId('turma_id')
        ->constrained('turmas')
        ->cascadeOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alocacao_turma');
    }
};
