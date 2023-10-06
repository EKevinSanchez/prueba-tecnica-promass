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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->date('fecha_encuesta');
            $table->integer('resultado');
            $table->unsignedBigInteger('id_folio_premio')->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_folio_premio')->references('id')->on('folio_premios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
