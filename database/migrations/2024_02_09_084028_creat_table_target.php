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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('heurs_depart');
            $table->time('heurs_arrive');
            $table->foreignId('taxi_id')->constrained('taxi' , 'id');
            $table->foreignId('road_id')->constrained('roads' , 'id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
