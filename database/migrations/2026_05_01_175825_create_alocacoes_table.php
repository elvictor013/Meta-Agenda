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
        Schema::create('alocacoes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('professor_id')
                ->constrained('professores')
                ->cascadeOnDelete();

            $table->foreignId('disciplina_id')
                ->constrained('disciplinas')
                ->cascadeOnDelete();

            $table->foreignId('sala_id')
                ->constrained('salas')
                ->cascadeOnDelete();

            $table->string('dia_semana');

            $table->time('hora_inicio');

            $table->time('hora_fim');

            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alocacoes');
    }
};
