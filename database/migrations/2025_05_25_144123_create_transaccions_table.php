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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plaza_id')->constrained()->onDelete('cascade');
            $table->foreignId('cotxe_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('hora_entrada');
            $table->timestamp('hora_sortida')->nullable();
            $table->decimal('import', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccions');
    }
};
