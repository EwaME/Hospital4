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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('idConsulta');
            $table->unsignedBigInteger('idCita');
            $table->unsignedBigInteger('idEnfermedad');
            $table->string('diagnostico', 255);
            $table->date('fecha');
            $table->foreign('idCita')->references('idCita')->on('citas');
            $table->foreign('idEnfermedad')->references('idEnfermedad')->on('enfermedades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
