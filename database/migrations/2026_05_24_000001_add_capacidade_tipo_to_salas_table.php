<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->integer('capacidade')->nullable()->after('nome');
            $table->string('tipo')->nullable()->after('capacidade');
        });
    }

    public function down(): void
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->dropColumn(['capacidade', 'tipo']);
        });
    }
};
