<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->double('latitude');
        $table->double('longitude');
        $table->string('image_path');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('bereals');
    }
};
