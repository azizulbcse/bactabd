<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('media_file')->nullable(); 
            $table->string('video_url')->nullable(); 
            $table->string('venue')->nullable();
            $table->date('event_date')->nullable();
            $table->tinyInteger('type')->default(1); 
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(); 
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_galleries');
    }
};
