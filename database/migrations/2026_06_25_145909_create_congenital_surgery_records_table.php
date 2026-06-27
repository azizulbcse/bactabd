<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('congenital_surgery_records', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->integer('year');
            
            $table->integer('asd_count')->default(0);
            $table->integer('vsd_count')->default(0);
            $table->integer('tof_count')->default(0);
            $table->integer('pda_count')->default(0);
            
            $table->timestamps();
            
            $table->unique(['hospital_id', 'year'], 'hospital_year_congenital_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('congenital_surgery_records');
    }
};
