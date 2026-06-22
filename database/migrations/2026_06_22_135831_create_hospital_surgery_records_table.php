<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospital_surgery_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id'); 
            $table->unsignedBigInteger('surgery_type_id');
            $table->integer('year'); 
            $table->integer('data_count')->default(0);
            $table->timestamps();

            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('surgery_type_id')->references('id')->on('surgery_types')->onDelete('cascade');
            
            $table->index(['hospital_id', 'surgery_type_id', 'year'], 'hospital_surgery_year_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospital_surgery_records');
    }
};
