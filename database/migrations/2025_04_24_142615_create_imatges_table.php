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
        Schema::create('imatges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_id');
            $table->string('path');
            $table->timestamps();
            $table->foreign('parking_id')->references('id')->on('parkings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imatges');
    }
};
