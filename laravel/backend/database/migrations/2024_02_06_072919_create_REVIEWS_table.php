<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('REVIEWS', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('USUARIOS')->onDelete('cascade');
            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id')->references('id')->on('LOCALES')->onDelete('cascade');
            $table->string('titulo');
            $table->text('content');
            $table->unsignedInteger('puntuacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('REVIEWS');

    }
};
