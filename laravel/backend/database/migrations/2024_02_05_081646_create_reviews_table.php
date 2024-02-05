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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('local_id');
            $table->integer('puntuacion')->default(0);
            $table->text('comentario')->nullable();
            //$table->boolean('aprobado')->default(false);
            $table->boolean('destacado')->default(false);
            $table->timestamp('fecha')->useCurrent();
            
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('local_id')->references('id')->on('discotecas')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
