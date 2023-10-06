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
        Schema::create('respuestas_preguntas_premios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_encuesta');
            $table->unsignedBigInteger('id_pregunta');
            $table->boolean('respuesta');
            $table->foreign('id_encuesta')->references('id')->on('encuestas');
            $table->foreign('id_pregunta')->references('id')->on('cat_preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_preguntas_premios');
    }
};
