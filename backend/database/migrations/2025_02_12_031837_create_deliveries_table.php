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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('nome_cliente', 55);
            $table->string('rua', 255);
            $table->string('numero', 10);
            $table->string('bairro', 55);
            $table->string('referencia', 255);
            $table->string('tipo_pagamento', strlen("Dinheiro"))->default("Dinheiro");
            $table->boolean('troco')->default(false);
            $table->decimal('troco_para', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
