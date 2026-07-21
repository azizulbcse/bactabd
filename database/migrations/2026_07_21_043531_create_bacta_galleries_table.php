<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::create('bacta_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('category_type');
            $table->string('media_file')->nullable();
            $table->text('video_url')->nullable(); 
            $table->tinyInteger('status')->default(2)->comment('1=Draft, 2=Live');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bacta_galleries');
    }

};
