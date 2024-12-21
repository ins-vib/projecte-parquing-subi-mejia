<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('address');
            $table->String('ciutat');
            $table->integer('capacitat');
            $table->float('latitud');
            $table->float('longitud');
            $table->time('horaObertura');
            $table->time('horaTancament');
            $table->integer('num_plantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking');
    }
};
