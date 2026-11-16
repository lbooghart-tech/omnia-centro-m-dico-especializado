<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->date('fecha');
            $table->string('hora', 5); // formato HH:MM, por ejemplo 08:00
            $table->timestamps();

            // Evitan el double booking a nivel de base de datos
            $table->unique(['doctor_id', 'fecha', 'hora']);
            $table->unique(['paciente_id', 'fecha', 'hora']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};