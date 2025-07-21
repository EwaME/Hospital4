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
        Schema::create('citas', function (Blueprint $table) {
            $table->id('idCita');
            $table->unsignedBigInteger('idPaciente');
            $table->unsignedBigInteger('idDoctor');
            $table->date('fechaCita');
            $table->dateTime('horaCita');
            $table->string('estadoCita', 30);
            $table->foreign('idPaciente')->references('idPaciente')->on('pacientes');
            $table->foreign('idDoctor')->references('idDoctor')->on('doctores');
            $table->unique(['idDoctor', 'fechaCita', 'horaCita']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
