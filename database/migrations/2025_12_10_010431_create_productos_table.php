<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();

            $table->foreignId('marca_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('estado');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
