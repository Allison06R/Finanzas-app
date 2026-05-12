<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ahorros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->decimal('monto_meta', 10, 2);
            $table->decimal('monto_actual', 10, 2)->default(0);
            $table->enum('estado', ['en_progreso', 'completado', 'cancelado'])->default('en_progreso');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ahorros');
    }
};