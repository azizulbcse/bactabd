<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('valvular_surgery_records', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->integer('year');
            
            $table->integer('mvr_count')->default(0);
            $table->integer('avr_count')->default(0);
            $table->integer('dvr_count')->default(0); 
            $table->timestamps();
            
            $table->unique(['hospital_id', 'year'], 'hospital_year_valvular_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valvular_surgery_records');
    }
};
