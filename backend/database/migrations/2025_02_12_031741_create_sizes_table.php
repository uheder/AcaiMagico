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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 55);
            $table->decimal('valor', 5, 2);
            $table->integer('max_cremes')->default(1)->nullable();
            $table->integer('max_recheios')->default(3)->nullable();
            $table->integer('max_acompanhamentos')->default(1)->nullable();
            $table->integer('max_coberturas')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
