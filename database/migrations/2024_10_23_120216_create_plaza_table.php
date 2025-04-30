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
        Schema::create('plazas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('tipus_id')->constrained('tipusplaçes')->onDelete('cascade');;
            $table->boolean('estat');
            $table->foreignId('zona_id')->constrained();
            $table->foreignId('cotxe_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('entrada_timestamp')->nullable();
            $table->integer('sortida_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plazas');
    }
};
