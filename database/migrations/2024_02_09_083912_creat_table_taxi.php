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
        Schema::create('taxi', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('type');
            $table->integer('capacity');
            $table->float('PPK');
            $table->foreignId('driver_id')->constrained('drivers' , 'driver_id');
            $table->integer('ratting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxi');
    }
};
