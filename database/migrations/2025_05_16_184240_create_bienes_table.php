<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('categoria');
            $table->string('ubicacion');
            $table->integer('cantidad')->default(1);
            $table->date('fecha_adquisicion')->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('requiere_mantenimiento')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};

