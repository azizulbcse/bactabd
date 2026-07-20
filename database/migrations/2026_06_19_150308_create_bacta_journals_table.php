<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bacta_journals', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('volume_issue');
            $table->string('publishing_date');
            $table->string('issn_code')->default('2312-8178');
            $table->string('cover_image')->nullable(); 
            $table->integer('status')->default(2);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bacta_journals');
    }
};
