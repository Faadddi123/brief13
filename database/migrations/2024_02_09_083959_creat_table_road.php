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
        Schema::create('roads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_start')->constrained('cities' , 'id');
            $table->foreignId('city_arrive')->constrained('cities' , 'id');
            $table->float('distance');
            
            $table->timestamps();
            $table->unique(['city_start', 'city_arrive']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roads');
    }
};
