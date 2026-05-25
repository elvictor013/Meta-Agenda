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
            Schema::create('notificacoes', function (Blueprint $table) {
                $table->id();

                $table->foreignId('turma_id')
                    ->constrained('turmas')
                    ->cascadeOnDelete();

                $table->string('titulo');
                $table->text('mensagem');
                $table->string('tipo')->nullable(); 

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('notificacoes');
        }
    };
