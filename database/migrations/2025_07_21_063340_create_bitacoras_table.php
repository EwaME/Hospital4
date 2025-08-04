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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id('idBitacora');
            $table->foreignId('idUsuario')->constrained('users', 'id')->onDelete('cascade');
            $table->string('accion', 50);
            $table->string('descripcion', 255);
            $table->string('modelo')->nullable();
            $table->unsignedBigInteger('id_relacionado')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
