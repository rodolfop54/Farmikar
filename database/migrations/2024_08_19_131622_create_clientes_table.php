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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social', 80);
            $table->string('direccion', 80);
            $table->string('tipo_persona', 20);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('documento_id')->unique()->constrained('documentos')->onDelete('cascade');
            $table->string('numero_documento', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
