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
        Schema::create('consulta_medicamentos', function (Blueprint $table) {
            $table->id('idCMedicamento');
            $table->unsignedBigInteger('idConsulta');
            $table->unsignedBigInteger('idMedicamento');
            $table->integer('cantidad');
            $table->foreign('idConsulta')->references('idConsulta')->on('consultas');
            $table->foreign('idMedicamento')->references('idMedicamento')->on('medicamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consulta_medicamentos');
    }
};
