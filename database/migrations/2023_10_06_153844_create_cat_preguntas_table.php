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
        Schema::create('cat_preguntas', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->string('respuesta_correcta');
            $table->string('respuesta_incorrecta_1');   
            $table->string('respuesta_incorrecta_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_preguntas');
    }
};
