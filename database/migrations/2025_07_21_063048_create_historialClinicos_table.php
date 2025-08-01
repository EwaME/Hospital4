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
        Schema::create('historialClinico', function (Blueprint $table) {
            $table->id('idHistorial');
            $table->unsignedBigInteger('idPaciente');
            $table->string('resumen', 1000);
            $table->foreign('idPaciente')->references('idPaciente')->on('pacientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinicos');
    }
};
