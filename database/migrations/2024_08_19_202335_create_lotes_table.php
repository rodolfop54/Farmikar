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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_lote', 50);
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('stock');
            $table->date('fecha_vencimiento')->nullable();
            $table->foreignId('proveedore_id')->constrained('proveedores')->onDelete('cascade');
            $table->dateTime('fecha_compra');
            $table->tinyInteger('es_medicamento')->default(0);
            $table->tinyInteger('estado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
